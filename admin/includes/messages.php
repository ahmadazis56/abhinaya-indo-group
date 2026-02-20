<?php
// Display success and error messages
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">';
    echo '<i class="fas fa-check-circle"></i>';
    echo htmlspecialchars($_SESSION['success_message']);
    echo '</div>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-error">';
    echo '<i class="fas fa-exclamation-circle"></i>';
    echo htmlspecialchars($_SESSION['error_message']);
    echo '</div>';
    unset($_SESSION['error_message']);
}
?>

<style>
.alert {
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    animation: slideIn 0.3s ease;
}

.alert-success {
    background: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.alert-error {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.alert i {
    font-size: 1.2rem;
}

@keyframes slideIn {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
