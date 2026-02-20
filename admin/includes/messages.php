<?php
// Display success and error messages
if (isset($_SESSION['success_message'])) {
    echo '<div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 flex items-start gap-3">';
    echo '<i class="fas fa-check-circle mt-0.5"></i>';
    echo '<div class="text-sm font-medium">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
    echo '</div>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo '<div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 flex items-start gap-3">';
    echo '<i class="fas fa-exclamation-circle mt-0.5"></i>';
    echo '<div class="text-sm font-medium">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
    echo '</div>';
    unset($_SESSION['error_message']);
}
?>
