<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/database.php';
$logos = getLogos();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">
    <div class="page-header">
        <h1>Client & Partner Logos</h1>
        <a href="add.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Logo
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logos)): ?>
                            <?php foreach ($logos as $logo): ?>
                                <tr>
                                    <td>
                                        <img src="../uploads/logos/<?php echo htmlspecialchars($logo['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($logo['name']); ?>" 
                                             style="width: 80px; height: 50px; object-fit: contain; border-radius: 4px; background: #f8f9fa; padding: 5px;">
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($logo['name']); ?></strong>
                                        <?php if (!empty($logo['description'])): ?>
                                            <br><small class="text-muted"><?php echo substr(htmlspecialchars($logo['description']), 0, 80); ?>...</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?php echo getBadgeColor($logo['category']); ?>">
                                            <?php echo ucfirst(htmlspecialchars($logo['category'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Active</span>
                                    </td>
                                    <td>
                                        <small><?php echo date('M d, Y', strtotime($logo['created_at'])); ?></small>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="edit.php?id=<?php echo $logo['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $logo['id']; ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Are you sure you want to delete this logo?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                    <h5>No Logos Added</h5>
                                    <p class="text-muted">Start by adding your first client or partner logo.</p>
                                    <a href="add.php" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Logo
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
include '../includes/footer.php';

function getBadgeColor($category) {
    switch($category) {
        case 'publisher':
            return 'info';
        case 'creative':
            return 'warning';
        case 'techno':
            return 'success';
        case 'client':
            return 'primary';
        default:
            return 'secondary';
    }
}
?>

<style>
.table-responsive {
    overflow-x: auto;
}

.table img {
    transition: transform 0.2s;
}

.table img:hover {
    transform: scale(1.1);
}

.btn-group .btn {
    margin-right: 5px;
}

.badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.text-center {
    padding: 3rem 1rem;
}

.text-center i {
    opacity: 0.3;
}
</style>
