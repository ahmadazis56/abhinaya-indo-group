<?php
session_start();

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit();
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    // Database connection
    require_once '../config/database.php';

    // Authentication
    if (!$conn->connect_error) {
        $stmt = $conn->prepare("SELECT id, username, password FROM admin_users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_username'] = $row['username'];
                    $_SESSION['admin_id'] = $row['id'];
                    header('Location: index.php');
                    exit();
                }
            }
            $stmt->close();
        }
        $conn->close();
    }
    
    // Autentikasi default dihapus demi keamanan
    // Tidak ada lagi akses backdoor (admin/admin123)
    
    $error = 'Username atau password salah!';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel Abhinaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased text-slate-600 bg-slate-50 min-h-screen flex flex-col justify-center relative overflow-hidden">
    
    <!-- Abstract Background -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -right-[10%] w-[50%] h-[50%] rounded-full bg-brand-400/10 blur-[100px]"></div>
        <div class="absolute bottom-[20%] -left-[10%] w-[40%] h-[40%] rounded-full bg-purple-400/10 blur-[100px]"></div>
    </div>

    <div class="relative z-10 sm:mx-auto sm:w-full sm:max-w-md px-4">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-white rounded-2xl shadow-sm border border-slate-200 flex items-center justify-center mx-auto mb-4 relative">
                <div class="absolute inset-0 bg-brand-500 rounded-2xl rotate-3 opacity-20"></div>
                <i class="fas fa-building text-2xl text-brand-600 relative z-10"></i>
            </div>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900">Admin Panel</h2>
            <p class="mt-2 text-sm text-slate-500">Abhinaya Indo Group</p>
        </div>

        <div class="bg-white py-8 px-4 shadow-xl shadow-slate-200/50 sm:rounded-3xl sm:px-10 border border-slate-100 relative overflow-hidden">
            <!-- Decorative Top Border -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-brand-500 to-indigo-500"></div>

            <?php if (isset($error)): ?>
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 flex items-start gap-3">
                    <i class="fas fa-exclamation-circle text-rose-500 mt-0.5"></i>
                    <div class="text-sm font-medium text-rose-800"><?php echo htmlspecialchars($error); ?></div>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="" method="POST" id="loginForm">
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-slate-400"></i>
                        </div>
                        <input id="username" name="username" type="text" required class="block w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm transition-shadow shadow-sm" placeholder="Masukkan username">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-slate-400"></i>
                        </div>
                        <input id="password" name="password" type="password" required class="block w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm transition-shadow shadow-sm" placeholder="Masukkan password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-brand-600 focus:ring-brand-500 border-slate-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-slate-700">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-semibold text-brand-600 hover:text-brand-500 transition-colors">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" id="loginBtn" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-colors">
                        <i class="fas fa-sign-in-alt"></i> Sign in
                    </button>
                </div>
            </form>
            
            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <a href="../index.php" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Website
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const usernameInput = document.getElementById('username');
            
            form.addEventListener('submit', function() {
                const originalContent = loginBtn.innerHTML;
                loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
                loginBtn.classList.add('opacity-75', 'cursor-not-allowed');
                // We shouldn't disable the button completely to ensure form submits, 
                // but just add visual cues.
            });
            
            // Auto-focus username field
            if (usernameInput) {
                usernameInput.focus();
            }
        });
    </script>
</body>
</html>
