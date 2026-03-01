<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/messages.php';

// Database connection
require_once '../config/database.php';

$success = '';
$error = '';

$user_id = $_SESSION['admin_id'] ?? 1;

// Fetch current user details initially
$current_admin_username = '';
if(isset($_SESSION['admin_username']) && !isset($_SESSION['admin_id'])) {
    $u_stmt = $conn->prepare("SELECT id, username FROM admin_users WHERE username = ?");
    if($u_stmt) {
        $u_stmt->bind_param("s", $_SESSION['admin_username']);
        $u_stmt->execute();
        $u_res = $u_stmt->get_result();
        if($u_row = $u_res->fetch_assoc()) {
            $user_id = $u_row['id'];
            $current_admin_username = $u_row['username'];
        }
        $u_stmt->close();
    }
} else {
    $u_stmt = $conn->prepare("SELECT username FROM admin_users WHERE id = ?");
    if($u_stmt) {
        $u_stmt->bind_param("i", $user_id);
        $u_stmt->execute();
        $u_res = $u_stmt->get_result();
        if($u_row = $u_res->fetch_assoc()) {
            $current_admin_username = $u_row['username'];
        }
        $u_stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['username'] ?? '';
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($current_password)) {
        $error = "Password saat ini diperlukan untuk menyimpan perubahan.";
    } elseif (!empty($new_password) && $new_password !== $confirm_password) {
        $error = "Konfirmasi password baru tidak cocok.";
    } elseif (!empty($new_password) && strlen($new_password) < 6) {
        $error = "Password baru minimal 6 karakter.";
    } elseif (empty($new_username)) {
        $error = "Username tidak boleh kosong.";
    } else {
        $stmt = $conn->prepare("SELECT password FROM admin_users WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                if (password_verify($current_password, $row['password'])) {
                    // Password matches, update it
                    if (!empty($new_password)) {
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $update_stmt = $conn->prepare("UPDATE admin_users SET username = ?, password = ? WHERE id = ?");
                        if ($update_stmt) {
                            $update_stmt->bind_param("ssi", $new_username, $hashed_password, $user_id);
                            if ($update_stmt->execute()) {
                                $success = "Profil dan password berhasil diperbarui.";
                                $_SESSION['admin_username'] = $new_username;
                                $current_admin_username = $new_username;
                            } else {
                                $error = "Gagal memperbarui profil. Username mungkin sudah digunakan.";
                            }
                            $update_stmt->close();
                        }
                    } else {
                        $update_stmt = $conn->prepare("UPDATE admin_users SET username = ? WHERE id = ?");
                        if ($update_stmt) {
                            $update_stmt->bind_param("si", $new_username, $user_id);
                            if ($update_stmt->execute()) {
                                $success = "Profil berhasil diperbarui.";
                                $_SESSION['admin_username'] = $new_username;
                                $current_admin_username = $new_username;
                            } else {
                                $error = "Gagal memperbarui profil. Username mungkin sudah digunakan.";
                            }
                            $update_stmt->close();
                        }
                    }
                } else {
                    $error = "Password saat ini salah.";
                }
            } else {
                $error = "Data admin tidak ditemukan.";
            }
            $stmt->close();
        }
    }
}
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-3xl mx-auto">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Pengaturan Profil</h1>
            <p class="text-slate-500 mt-1 text-sm">Ubah profil dan password untuk akun admin Anda.</p>
        </div>

        <?php if (!empty($success)): ?>
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                <p class="text-sm font-medium"><?php echo htmlspecialchars($success); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl flex items-center">
                <i class="fas fa-exclamation-circle text-rose-500 mr-3"></i>
                <p class="text-sm font-medium"><?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                    <i class="fas fa-user-shield text-lg"></i>
                </div>
                <h2 class="text-lg font-semibold text-slate-900">Ubah Profil & Password</h2>
            </div>
            
            <form action="" method="POST" class="p-6 space-y-6">
                <div>
                    <label for="username" class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($current_admin_username); ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all text-sm outline-none">
                </div>
                
                <div>
                    <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-2">Password Saat Ini (Wajib untuk menyimpan perubahan)</label>
                    <input type="password" id="current_password" name="current_password" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all text-sm outline-none">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="new_password" class="block text-sm font-semibold text-slate-700 mb-2">Password Baru (Opsional)</label>
                        <input type="password" id="new_password" name="new_password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all text-sm outline-none" placeholder="Kosongkan jika tidak ubah password">
                    </div>
                    
                    <div>
                        <label for="confirm_password" class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all text-sm outline-none" placeholder="Isi jika ganti password">
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm focus:ring-4 focus:ring-brand-500/20 outline-none">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</main>

<?php include 'includes/footer.php'; ?>
<?php if(isset($conn)) { $conn->close(); } ?>
