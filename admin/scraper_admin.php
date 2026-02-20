<?php
require_once '../scraper/news_scraper.php';

// Initialize scraper
$scraper = new NewsScraper();

// Handle actions
$action = $_GET['action'] ?? 'view';
$message = '';

if ($action === 'clear_cache') {
    $scraper->clearCache();
    $message = 'Cache cleared successfully!';
} elseif ($action === 'scrape_now') {
    $scraper->clearCache();
    $news = $scraper->getLatestNews(10);
    $message = 'Scraping completed! Found ' . count($news) . ' news items.';
}

// Get current cache status
$cacheStatus = $scraper->getCacheStatus();
$latestNews = $scraper->getLatestNews(10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Scraper Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .header {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .status-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .status-item {
            padding: 1rem;
            background: #f1f5f9;
            border-radius: 8px;
            text-align: center;
        }
        
        .status-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #14aecf;
        }
        
        .status-label {
            font-size: 0.9rem;
            color: #64748b;
            margin-top: 0.5rem;
        }
        
        .actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: #14aecf;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0f8c9f;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #e2e8f0;
            color: #475569;
        }
        
        .btn-secondary:hover {
            background: #cbd5e1;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            background: #10b981;
            color: white;
        }
        
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .news-item {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .news-item:hover {
            transform: translateY(-4px);
        }
        
        .news-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .news-content {
            padding: 1.5rem;
        }
        
        .news-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }
        
        .news-date {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        
        .news-excerpt {
            font-size: 0.9rem;
            color: #475569;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        
        .news-link {
            color: #14aecf;
            text-decoration: none;
            font-weight: 500;
        }
        
        .news-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📰 News Scraper Admin</h1>
            <p style="margin-top: 0.5rem; color: #64748b;">Manage automatic news scraping from WordPress sites</p>
        </div>
        
        <?php if ($message): ?>
            <div class="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <div class="status-card">
            <h2>Cache Status</h2>
            <div class="status-grid">
                <div class="status-item">
                    <div class="status-value">
                        <?php echo is_array($cacheStatus) ? $cacheStatus['is_valid'] ? 'Valid' : 'Expired' : 'No Cache'; ?>
                    </div>
                    <div class="status-label">Cache Status</div>
                </div>
                <div class="status-item">
                    <div class="status-value">
                        <?php echo is_array($cacheStatus) ? gmdate('i:s', $cacheStatus['age']) : '00:00'; ?>
                    </div>
                    <div class="status-label">Cache Age</div>
                </div>
                <div class="status-item">
                    <div class="status-value">
                        <?php echo is_array($cacheStatus) ? gmdate('i:s', $cacheStatus['remaining']) : '00:00'; ?>
                    </div>
                    <div class="status-label">Time Until Refresh</div>
                </div>
                <div class="status-item">
                    <div class="status-value"><?php echo count($latestNews); ?></div>
                    <div class="status-label">News Items</div>
                </div>
            </div>
            
            <div class="actions">
                <a href="?action=scrape_now" class="btn btn-primary">
                    🔄 Scrape Now
                </a>
                <a href="?action=clear_cache" class="btn btn-secondary">
                    🗑️ Clear Cache
                </a>
                <a href="index.php" class="btn btn-secondary">
                    🏠 Back to Admin
                </a>
            </div>
        </div>
        
        <div class="status-card">
            <h2>Latest News (<?php echo count($latestNews); ?> items)</h2>
            <div class="news-grid">
                <?php if (!empty($latestNews)): ?>
                    <?php foreach ($latestNews as $news): ?>
                        <div class="news-item">
                            <?php if (!empty($news['image'])): ?>
                                <img src="<?php echo htmlspecialchars($news['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($news['image_alt'] ?? $news['title']); ?>" 
                                     class="news-image"
                                     onerror="this.src='../assets/img/team management/abdul.png'">
                            <?php else: ?>
                                <img src="../assets/img/team management/abdul.png" 
                                     alt="<?php echo htmlspecialchars($news['title']); ?>" 
                                     class="news-image">
                            <?php endif; ?>
                            <div class="news-content">
                                <div class="news-date">
                                    <?php echo date('F j, Y', strtotime($news['date'] ?? 'now')); ?>
                                </div>
                                <h3 class="news-title">
                                    <?php echo htmlspecialchars($news['title']); ?>
                                </h3>
                                <?php if (!empty($news['excerpt'])): ?>
                                    <p class="news-excerpt">
                                        <?php echo htmlspecialchars($news['excerpt']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($news['link'])): ?>
                                    <a href="<?php echo htmlspecialchars($news['link']); ?>" 
                                       class="news-link" 
                                       target="_blank">
                                        Read More →
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No news items found. Try scraping now.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
