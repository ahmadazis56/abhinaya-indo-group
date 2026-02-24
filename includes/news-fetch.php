<?php
/**
 * Fetches and caches the latest news articles from the Abhinaya RSS feed.
 * Cache expires every 30 minutes so articles update automatically.
 */

/**
 * Attempt to get the og:image from an article URL (fast, first 10KB only).
 */
function _fetchOgImage(string $url): string {
    $ctx = stream_context_create([
        'http' => [
            'timeout'     => 5,
            'user_agent'  => 'Mozilla/5.0 (compatible; AbhinayaFetcher/1.0)',
            'header'      => "Range: bytes=0-30000\r\n", // grab only the headers/meta area
        ]
    ]);
    $html = @file_get_contents($url, false, $ctx);
    if (!$html) return '';

    // og:image
    if (preg_match('/<meta[^>]+property=["\']og:image["\'][^>]+content=["\']([^"\']+)["\']/', $html, $m)) {
        return $m[1];
    }
    // content before property (some themes swap attribute order)
    if (preg_match('/<meta[^>]+content=["\']([^"\']+)["\'][^>]+property=["\']og:image["\']/', $html, $m)) {
        return $m[1];
    }
    return '';
}

function getLatestAbhinayaNews(int $limit = 3): array {
    $cacheFile = __DIR__ . '/../uploads/news_cache.json';
    $cacheDuration = 30 * 60; // 30 minutes in seconds

    // Use cached data if still fresh
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheDuration) {
        $cached = json_decode(file_get_contents($cacheFile), true);
        if (is_array($cached) && count($cached) > 0) {
            return array_slice($cached, 0, $limit);
        }
    }

    // Fetch via RSS feed
    $feedUrl = 'https://news.abhinaya.co.id/category/abhinaya/feed/';
    $articles = [];

    $ctx = stream_context_create([
        'http' => [
            'timeout'    => 10,
            'user_agent' => 'Mozilla/5.0 (compatible; AbhinayaNewsFetcher/1.0)'
        ]
    ]);

    $xml = @file_get_contents($feedUrl, false, $ctx);

    if ($xml) {
        libxml_use_internal_errors(true);
        $rss = simplexml_load_string($xml);
        libxml_clear_errors();

        if ($rss && isset($rss->channel->item)) {
            foreach ($rss->channel->item as $item) {
                $imageUrl = '';

                // 1. Try media:content (Yahoo Media RSS namespace)
                $media = $item->children('http://search.yahoo.com/mrss/');
                if (!empty($media->content)) {
                    $imageUrl = (string)$media->content->attributes()['url'];
                }

                // 2. Try media:thumbnail
                if (empty($imageUrl) && !empty($media->thumbnail)) {
                    $imageUrl = (string)$media->thumbnail->attributes()['url'];
                }

                // 3. Try 'media' shorthand namespace
                if (empty($imageUrl)) {
                    $media2 = $item->children('media', true);
                    if (!empty($media2->content)) {
                        $imageUrl = (string)$media2->content->attributes()['url'];
                    }
                    if (empty($imageUrl) && !empty($media2->thumbnail)) {
                        $imageUrl = (string)$media2->thumbnail->attributes()['url'];
                    }
                }

                // 4. Try <enclosure>
                if (empty($imageUrl) && !empty($item->enclosure)) {
                    $enc = $item->enclosure->attributes();
                    $type = (string)($enc['type'] ?? '');
                    if (strpos($type, 'image') !== false && !empty($enc['url'])) {
                        $imageUrl = (string)$enc['url'];
                    }
                }

                // 5. Try content:encoded (full post body) for first <img>
                if (empty($imageUrl)) {
                    $content = $item->children('http://purl.org/rss/1.0/modules/content/');
                    if (!empty($content->encoded)) {
                        $encoded = (string)$content->encoded;
                        if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $encoded, $m)) {
                            $imageUrl = $m[1];
                        }
                        // Also try wp-post-thumbnail
                        if (empty($imageUrl) && preg_match('/class=["\'][^"\']*size-full[^"\']*["\'][^>]+src=["\']([^"\']+)["\']/', $encoded, $m)) {
                            $imageUrl = $m[1];
                        }
                    }
                }

                // 6. Try description for <img>
                if (empty($imageUrl)) {
                    $desc = (string)$item->description;
                    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $desc, $m)) {
                        $imageUrl = $m[1];
                    }
                }

                // 7. Fallback: scrape og:image from article page (adds ~2s first load, cached after)
                $link = (string)$item->link;
                if (empty($imageUrl) && !empty($link)) {
                    $imageUrl = _fetchOgImage($link);
                }

                // Clean excerpt
                $description = strip_tags((string)$item->description);
                $description = html_entity_decode($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $description = preg_replace('/\s+/', ' ', trim($description));
                if (mb_strlen($description) > 160) {
                    $description = mb_substr($description, 0, 157) . '...';
                }

                $articles[] = [
                    'title'          => html_entity_decode((string)$item->title, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                    'link'           => $link,
                    'date'           => (string)$item->pubDate,
                    'date_formatted' => date('d M Y', strtotime((string)$item->pubDate)),
                    'excerpt'        => $description,
                    'image'          => $imageUrl,
                    'category'       => html_entity_decode((string)($item->category ?? 'Abhinaya News'), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                ];

                if (count($articles) >= 10) break;
            }
        }
    }

    // Save to cache
    if (!empty($articles)) {
        file_put_contents($cacheFile, json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    } elseif (file_exists($cacheFile)) {
        // Fetch failed — return stale cache
        $cached = json_decode(file_get_contents($cacheFile), true);
        if (is_array($cached)) {
            return array_slice($cached, 0, $limit);
        }
    }

    return array_slice($articles, 0, $limit);
}
?>
