<?php
require_once 'config/database.php';

// Ambil data team
$team_query = "SELECT * FROM team ORDER BY COALESCE(division, 'general'), name ASC";
$team_result = $conn->query($team_query);
$teams_by_division = [];
if ($team_result) {
    while ($row = $team_result->fetch_assoc()) {
        $division = $row['division'] ?? 'general';
        if (!isset($teams_by_division[$division])) {
            $teams_by_division[$division] = [];
        }
        $teams_by_division[$division][] = $row;
    }
}

$division_names = [
    'techno' => 'Techno Division',
    'creative' => 'Creative Division',
    'publisher' => 'Publisher Division',
    'general' => 'Executive Management'
];

$pageTitle = "Our Team - Abhinaya Indo Group";
$pageDesc = "Meet the talented team behind Abhinaya Indo Group - experts in IT solutions, creative services, and scientific publishing.";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative w-full min-h-[50vh] flex items-center justify-center overflow-hidden pt-20 bg-secondary-50 border-b border-secondary-100 text-center">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiMwZjk0ODgiIGZpbGwtb3BhY2l0eT0iMC4wNSIvPjwvc3ZnPg==')] z-0"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-secondary-50 via-transparent to-transparent z-0"></div>

    <div class="relative z-10 w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-heading font-extrabold mb-6 leading-tight text-secondary-900 tracking-tight">
            Meet the <span class="text-primary-600">Team</span>
        </h1>
        <p class="text-lg md:text-xl text-secondary-500 font-light max-w-2xl mx-auto">
            The distinct talent driving innovation across our divisions.
        </p>
    </div>
</section>

<!-- Team Roster -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (!empty($teams_by_division)): ?>
            <?php foreach ($teams_by_division as $division => $members): ?>
                <div class="mb-20 last:mb-0" data-aos="fade-up">
                    <div class="mb-10 text-center md:text-left flex flex-col md:flex-row items-center border-b border-secondary-100 pb-4">
                        <h2 class="text-3xl font-heading font-bold text-secondary-900">
                            <?php echo htmlspecialchars($division_names[$division] ?? ucfirst($division)); ?>
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <?php foreach ($members as $member): ?>
                            <div class="group">
                                <div class="relative bg-secondary-100 rounded-3xl aspect-[4/5] overflow-hidden mb-6 border border-secondary-200">
                                    <?php if (!empty($member['image'])): ?>
                                        <img src="admin/uploads/team/<?php echo htmlspecialchars($member['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($member['name']); ?>" 
                                             class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-secondary-50">
                                            <svg class="w-16 h-16 text-secondary-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="absolute inset-0 bg-gradient-to-t from-secondary-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                        <div class="flex space-x-3">
                                            <?php if (!empty($member['linkedin'])): ?>
                                            <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center hover:bg-white text-white hover:text-secondary-900 transition-colors">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                            </a>
                                            <?php endif; ?>
                                            <?php if (!empty($member['email'])): ?>
                                            <a href="mailto:<?php echo htmlspecialchars($member['email']); ?>" class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center hover:bg-white text-white hover:text-secondary-900 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h3 class="text-lg font-bold text-secondary-900"><?php echo htmlspecialchars($member['name']); ?></h3>
                                    <p class="text-primary-600 text-sm font-medium"><?php echo htmlspecialchars($member['role']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-20 px-4 bg-secondary-50 rounded-3xl border border-secondary-100 border-dashed">
                <p class="text-secondary-500">Team members are currently being curated. Please check back soon.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA -->
<section class="py-24 bg-secondary-900 text-center text-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-heading font-bold mb-6">Join the Team</h2>
        <p class="text-lg text-secondary-400 mb-10 font-light">We are always looking for exceptional talent to join our ranks.</p>
        <a href="contact.php" class="inline-flex items-center justify-center px-8 py-3.5 text-secondary-900 font-medium transition-all bg-white rounded-xl hover:bg-secondary-100">
            View Roles
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
