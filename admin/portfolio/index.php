<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/database.php';
$portfolioItems = getPortfolio();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">
    <div class="page-header">
        <h1>Portfolio Management</h1>
        <a href="add.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Portfolio
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($portfolioItems)): ?>
                            <?php foreach ($portfolioItems as $item): ?>
                                <tr>
                                    <td>
                                        <img src="../uploads/portfolio/<?php echo htmlspecialchars($item['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($item['title']); ?>" 
                                             style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($item['title']); ?></strong>
                                        <?php if (!empty($item['description'])): ?>
                                            <br><small class="text-muted"><?php echo substr(htmlspecialchars($item['description']), 0, 100); ?>...</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($item['category'])): ?>
                                            <span class="badge badge-info"><?php echo htmlspecialchars($item['category']); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?php echo $item['status'] == 'active' ? 'success' : 'secondary'; ?>">
                                            <?php echo ucfirst($item['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small><?php echo date('M d, Y', strtotime($item['created_at'])); ?></small>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $item['id']; ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Are you sure you want to delete this portfolio item?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                    <h5>No Portfolio Items</h5>
                                    <p class="text-muted">Start by adding your first portfolio item.</p>
                                    <a href="add.php" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Portfolio
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

<?php include '../includes/footer.php'; ?>

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
