<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);
    $division = trim($_POST['division']);
    $description = trim($_POST['description']);
    $email = trim($_POST['email']);
    $linkedin = trim($_POST['linkedin']);
    $status = $_POST['status'] ?? 'active';
    $sort_order = 0;

    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $_SESSION['error'] = 'Invalid file type. Please upload JPG, PNG, GIF, or WebP images.';
            header('Location: add.php');
            exit;
        }

        if ($_FILES['image']['size'] > $maxSize) {
            $_SESSION['error'] = 'File size too large. Maximum size is 5MB.';
            header('Location: add.php');
            exit;
        }

        $uploadDir = '../uploads/team/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $fileName;
        } else {
            $_SESSION['error'] = 'Failed to upload image. Please try again.';
            header('Location: add.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please select a photo to upload.';
        header('Location: add.php');
        exit;
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO team (name, role, division, description, image, email, linkedin, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssi", $name, $role, $division, $description, $image, $email, $linkedin, $status, $sort_order);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Team member added successfully!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to add team member. Please try again.';
        header('Location: add.php');
        exit;
    }

    $stmt->close();
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Anggota Tim</h1>
                <p class="text-slate-500 mt-1 text-sm">Buat profil anggota tim baru Abhinaya.</p>
            </div>
            <a href="index.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 flex items-start gap-3">
                <i class="fas fa-exclamation-circle mt-0.5"></i>
                <div class="text-sm font-medium"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <form method="POST" enctype="multipart/form-data" class="divide-y divide-slate-100">
                
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-user-circle text-brand-500"></i> Informasi Personal
                    </h3>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap *</label>
                                <input type="text" id="name" name="name" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                            </div>
                            <div>
                                <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">Peran / Jabatan *</label>
                                <input type="text" id="role" name="role" required placeholder="e.g., CEO, Developer, Designer" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="division" class="block text-sm font-semibold text-slate-700 mb-2">Divisi *</label>
                                <select id="division" name="division" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                    <option value="">Pilih Divisi</option>
                                    <option value="techno">Techno</option>
                                    <option value="creative">Creative</option>
                                    <option value="publisher">Publisher</option>
                                    <option value="general">General (Management/Admin)</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Anggota</label>
                                <select id="status" name="status" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                    <option value="active">Active (Ditampilkan)</option>
                                    <option value="inactive">Inactive (Disembunyikan)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Biografi Singkat</label>
                            <textarea id="description" name="description" rows="4" placeholder="Keterangan singkat mengenai peran atau pengalaman" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400 resize-y"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Publik</label>
                                <input type="email" id="email" name="email" placeholder="name@abhinaya.com" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                            </div>
                            <div>
                                <label for="linkedin" class="block text-sm font-semibold text-slate-700 mb-2">LinkedIn Profile</label>
                                <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-camera text-brand-500"></i> Foto Profil
                    </h3>

                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="flex-1 space-y-6">
                            <div>
                                <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Pilih File Foto *</label>
                                
                                <div class="relative group cursor-pointer border-2 border-dashed border-slate-300 rounded-2xl hover:border-brand-500 hover:bg-brand-50 transition-all duration-300 w-full text-center overflow-hidden">
                                    <input type="file" id="image" name="image" accept="image/*" required onchange="previewTeamPhoto(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    
                                    <div class="px-6 py-10 flex flex-col items-center justify-center pointer-events-none">
                                        <div class="w-14 h-14 mb-3 rounded-full bg-slate-100 group-hover:bg-white text-slate-400 group-hover:text-brand-500 flex items-center justify-center transition-colors shadow-sm">
                                            <i class="fas fa-cloud-upload-alt text-xl"></i>
                                        </div>
                                        <h4 class="text-slate-800 font-bold mb-1 text-base">Klik atau seret foto ke sini</h4>
                                        <p class="text-slate-500 mb-3 text-xs">Preview akan muncul di samping.</p>
                                        
                                        <div class="flex flex-wrap justify-center gap-2 mt-2 font-medium text-[10px] text-slate-500 uppercase tracking-widest">
                                            <span class="px-2 py-1 bg-slate-100 rounded-md">JPG, PNG</span>
                                            <span class="px-2 py-1 bg-slate-100 rounded-md">Max 5MB</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-64 shrink-0 flex flex-col items-center">
                            <label class="block text-sm font-semibold text-slate-700 mb-3 w-full text-left md:text-center">Preview Foto</label>
                            <div class="relative w-40 h-40 rounded-full bg-slate-50 border-4 border-white shadow-lg flex items-center justify-center overflow-hidden ring-1 ring-slate-200">
                                <div id="teamPhotoPreview" class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                    <i class="fas fa-user text-4xl"></i>
                                </div>
                            </div>
                            <div class="mt-4 w-full rounded-xl bg-amber-50 border border-amber-100 p-3">
                                <h6 class="text-amber-800 font-bold text-[10px] uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-lightbulb"></i> Tips Foto
                                </h6>
                                <ul class="text-[11px] text-amber-700 space-y-1 font-medium leading-relaxed">
                                    <li>• Rasio 1:1 (Square)</li>
                                    <li>• Wajah terlihat jelas</li>
                                    <li>• Latar belakang rapi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8 bg-slate-50 flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <a href="index.php" class="inline-flex justify-center items-center gap-2 px-6 py-3 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
                        <i class="fas fa-save"></i> Save Team Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function previewTeamPhoto(event) {
    const file = event.target.files && event.target.files[0];
    const previewContainer = document.getElementById('teamPhotoPreview');
    if (!previewContainer) return;

    if (!file) {
        previewContainer.innerHTML = '<i class="fas fa-user text-4xl"></i>';
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file terlalu besar! Max 5MB');
        event.target.value = '';
        previewContainer.innerHTML = '<i class="fas fa-user text-4xl"></i>';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        previewContainer.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="w-full h-full object-cover">';
    };
    reader.readAsDataURL(file);
}
</script>

<?php include '../includes/footer.php'; ?>
