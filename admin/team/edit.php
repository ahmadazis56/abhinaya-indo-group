<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'Team member not found.';
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Get current team member
$stmt = $conn->prepare("SELECT * FROM team WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Team member not found.';
    header('Location: index.php');
    exit;
}

$member = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);
    $division = trim($_POST['division']);
    $description = trim($_POST['description']);
    $email = trim($_POST['email']);
    $linkedin = trim($_POST['linkedin']);
    $status = $_POST['status'] ?? 'active';
    $sort_order = 0;

    // Handle image upload if new image is provided
    $image = $member['image']; // Keep existing image by default
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $_SESSION['error'] = 'Invalid file type. Please upload JPG, PNG, GIF, or WebP images.';
            header('Location: edit.php?id=' . $id);
            exit;
        }

        if ($_FILES['image']['size'] > $maxSize) {
            $_SESSION['error'] = 'File size too large. Maximum size is 5MB.';
            header('Location: edit.php?id=' . $id);
            exit;
        }

        $uploadDir = '../uploads/team/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Delete old image if it exists
        if (!empty($member['image']) && file_exists($uploadDir . $member['image'])) {
            unlink($uploadDir . $member['image']);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $fileName;
        } else {
            $_SESSION['error'] = 'Failed to upload image. Please try again.';
            header('Location: edit.php?id=' . $id);
            exit;
        }
    }

    // Update database
    $stmt = $conn->prepare("UPDATE team SET name = ?, role = ?, division = ?, description = ?, image = ?, email = ?, linkedin = ?, status = ?, sort_order = ? WHERE id = ?");
    $stmt->bind_param("ssssssssii", $name, $role, $division, $description, $image, $email, $linkedin, $status, $sort_order, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Team member updated successfully!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to update team member. Please try again.';
        header('Location: edit.php?id=' . $id);
        exit;
    }

    $stmt->close();
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<main class="flex-1 lg:ml-72">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex items-start justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Edit Team Member</h1>
                    <p class="text-slate-600 mt-1">Update team member profile information</p>
                </div>
                <a href="index.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 flex items-start gap-3">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <div class="text-sm font-medium"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200 rounded-2xl p-6 overflow-x-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                            </div>
                            <div>
                                <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">Role/Position *</label>
                                <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($member['role']); ?>" required placeholder="e.g., CEO, Developer" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="division" class="block text-sm font-semibold text-slate-700 mb-2">Division *</label>
                                <select id="division" name="division" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                                    <option value="">Select Division</option>
                                    <option value="techno" <?php echo ($member['division'] == 'techno') ? 'selected' : ''; ?>>Techno</option>
                                    <option value="creative" <?php echo ($member['division'] == 'creative') ? 'selected' : ''; ?>>Creative</option>
                                    <option value="publisher" <?php echo ($member['division'] == 'publisher') ? 'selected' : ''; ?>>Publisher</option>
                                    <option value="general" <?php echo ($member['division'] == 'general') ? 'selected' : ''; ?>>General</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                                <select id="status" name="status" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                                    <option value="active" <?php echo ($member['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo ($member['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Biography</label>
                            <textarea id="description" name="description" rows="4" placeholder="Brief biography" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600"><?php echo htmlspecialchars($member['description']); ?></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" placeholder="name@example.com" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                            </div>
                            <div>
                                <label for="linkedin" class="block text-sm font-semibold text-slate-700 mb-2">LinkedIn Profile</label>
                                <input type="url" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($member['linkedin']); ?>" placeholder="https://linkedin.com/..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Photo</label>
                            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-4 text-center">
                                <div id="teamPhotoPreview" class="w-full aspect-square rounded-xl bg-white border border-slate-200 flex items-center justify-center overflow-hidden mb-3">
                                    <?php if (!empty($member['image'])): ?>
                                        <img src="../uploads/team/<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="text-slate-400 text-sm px-4">Preview</div>
                                    <?php endif; ?>
                                </div>
                                <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-brand-600 file:text-white file:font-semibold hover:file:bg-brand-700" onchange="previewTeamPhoto(event)">
                                <div class="mt-2 text-[10px] text-slate-500 uppercase tracking-wider font-bold">Leave empty to keep current photo</div>
                            </div>
                        </div>

                        <div class="rounded-xl bg-brand-50 border border-brand-100 p-4">
                            <h6 class="text-brand-800 font-bold text-xs uppercase tracking-widest mb-2 flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> Requirements
                            </h6>
                            <ul class="text-xs text-brand-700 space-y-1 font-medium">
                                <li>• Professional headshot</li>
                                <li>• Square 1:1 ratio works best</li>
                                <li>• Min 300x300 pixels</li>
                                <li>• Clear background</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-200 flex flex-col sm:flex-row gap-3 sm:justify-end">
                    <a href="index.php" class="inline-flex justify-center items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-600 text-white font-semibold hover:bg-brand-700">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function previewTeamPhoto(event) {
    const file = event.target.files && event.target.files[0];
    const preview = document.getElementById('teamPhotoPreview');
    if (!preview) return;

    if (!file) {
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file terlalu besar! Max 5MB');
        event.target.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="w-full h-full object-cover">';
    };
    reader.readAsDataURL(file);
}
</script>

<?php include '../includes/footer.php'; ?>
