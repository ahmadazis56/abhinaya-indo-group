<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/database.php';
$teamMembers = getTeam();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">
    <div class="page-header">
        <h1>Team Management</h1>
        <a href="add.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Team Member
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
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($teamMembers)): ?>
                            <?php foreach ($teamMembers as $member): ?>
                                <tr>
                                    <td>
                                        <img src="../uploads/team/<?php echo htmlspecialchars($member['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($member['name']); ?>" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%; border: 2px solid #dee2e6;">
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($member['name']); ?></strong>
                                        <?php if (!empty($member['description'])): ?>
                                            <br><small class="text-muted"><?php echo substr(htmlspecialchars($member['description']), 0, 80); ?>...</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-info"><?php echo htmlspecialchars($member['role']); ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($member['email'])): ?>
                                            <a href="mailto:<?php echo htmlspecialchars($member['email']); ?>" class="text-muted" title="Email">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (!empty($member['linkedin'])): ?>
                                            <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" class="text-muted ml-2" title="LinkedIn">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (empty($member['email']) && empty($member['linkedin'])): ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?php echo $member['status'] == 'active' ? 'success' : 'secondary'; ?>">
                                            <?php echo ucfirst($member['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light"><?php echo $member['sort_order']; ?></span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="edit.php?id=<?php echo $member['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $member['id']; ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Are you sure you want to delete this team member?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5>No Team Members</h5>
                                    <p class="text-muted">Start by adding your first team member.</p>
                                    <a href="add.php" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Team Member
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

.ml-2 {
    margin-left: 0.5rem;
}

.text-muted {
    color: #6c757d !important;
}

.text-muted:hover {
    color: #007bff !important;
}
</style>
