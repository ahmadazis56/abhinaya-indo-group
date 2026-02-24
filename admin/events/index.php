<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/messages.php';
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
<div class="p-6 sm:p-8 max-w-7xl mx-auto">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Events Management</h1>
            <p class="text-slate-500 mt-1 text-sm">Kelola daftar acara, seminar, dan kegiatan perusahaan.</p>
        </div>
        <a href="add.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
            <i class="fas fa-plus"></i> Tambah Event
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <!-- Filter & Search Bar -->
        <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row gap-4 justify-between items-center bg-white">
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <label class="text-sm font-medium text-slate-500">Status:</label>
                <select id="statusFilter" onchange="filterEvents()" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 outline-none transition-colors">
                    <option value="">Semua Status</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="past">Past</option>
                </select>
            </div>
            
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
                <input type="text" id="searchEvents" onkeyup="searchEvents()" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 p-2.5 outline-none transition-colors" placeholder="Cari judul event...">
            </div>
        </div>

        <!-- Event Grid -->
        <div class="p-6 bg-slate-50/50">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="eventsList">
                <?php
                // Database connection
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'abhinaya_admin';
                
                $conn = new mysqli($host, $username, $password, $database);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT * FROM events ORDER BY date DESC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        
                        $statusClass = 'bg-slate-100 text-slate-600';
                        if($row['status'] == 'upcoming') $statusClass = 'bg-brand-50 text-brand-700 border-brand-200';
                        if($row['status'] == 'ongoing') $statusClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                        if($row['status'] == 'past') $statusClass = 'bg-slate-100 text-slate-600 border-slate-200';

                        echo '<div class="event-card bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg hover:border-brand-200 transition-all duration-300 group flex flex-col" data-title="' . strtolower(htmlspecialchars($row['title'])) . '" data-status="' . htmlspecialchars($row['status']) . '">';
                        
                        echo '  <div class="aspect-[16/9] relative overflow-hidden bg-slate-100">';
                        if (!empty($row['image'])) {
                            echo '      <img src="../uploads/events/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">';
                        } else {
                            echo '      <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fas fa-image text-4xl"></i></div>';
                        }
                        echo '      <div class="absolute top-3 right-3 px-3 py-1 text-xs font-bold rounded-full border bg-opacity-90 backdrop-blur-sm ' . $statusClass . '">' . htmlspecialchars(ucfirst($row['status'])) . '</div>';
                        echo '  </div>';
                        
                        echo '  <div class="p-5 flex-1 flex flex-col">';
                        echo '      <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-1 group-hover:text-brand-600 transition-colors">' . htmlspecialchars($row['title']) . '</h3>';
                        echo '      <p class="text-slate-500 text-sm mb-4 line-clamp-2 flex-1">' . htmlspecialchars($row['description']) . '</p>';
                        
                        echo '      <div class="flex flex-col gap-2 mb-5">';
                        echo '          <div class="flex items-center text-sm text-slate-600 gap-2"><i class="fas fa-calendar-day w-4 text-slate-400"></i>' . date('d M Y', strtotime($row['date'])) . '</div>';
                        echo '          <div class="flex items-center text-sm text-slate-600 gap-2"><i class="fas fa-map-marker-alt w-4 text-slate-400"></i><span class="truncate">' . htmlspecialchars($row['location']) . '</span></div>';
                        echo '      </div>';
                        
                        echo '      <div class="flex items-center gap-2 pt-4 border-t border-slate-100 mt-auto">';
                        echo '          <a href="edit.php?id=' . $row['id'] . '" class="flex-1 inline-flex justify-center items-center gap-2 px-3 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-brand-600 transition-colors">Edit</a>';
                        echo '          <button onclick="deleteEvent(' . $row['id'] . ')" class="flex-1 inline-flex justify-center items-center gap-2 px-3 py-2 text-sm font-semibold text-rose-600 bg-white border border-rose-200 rounded-lg hover:bg-rose-50 transition-colors">Hapus</button>';
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200 border-dashed">';
                    echo '  <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-50 flex items-center justify-center text-slate-400"><i class="fas fa-calendar-times text-2xl"></i></div>';
                    echo '  <h3 class="text-lg font-bold text-slate-900 mb-2">Belum Ada Events</h3>';
                    echo '  <p class="text-slate-500 mb-6 max-w-sm mx-auto">Anda belum menambahkan event apapun. Mulai dengan menambahkan event pertama Anda.</p>';
                    echo '  <a href="add.php" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm">';
                    echo '      <i class="fas fa-plus"></i> Tambah Event Pertama';
                    echo '  </a>';
                    echo '</div>';
                }
                
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>
</main>

<script>
function filterEvents() {
    const status = document.getElementById('statusFilter').value;
    const events = document.querySelectorAll('.event-card');
    
    events.forEach(event => {
        if (status === '' || event.dataset.status === status) {
            event.style.display = 'block';
        } else {
            event.style.display = 'none';
        }
    });
}

function searchEvents() {
    const searchTerm = document.getElementById('searchEvents').value.toLowerCase();
    const events = document.querySelectorAll('.event-card');
    
    events.forEach(event => {
        if (event.dataset.title.includes(searchTerm)) {
            event.style.display = 'block';
        } else {
            event.style.display = 'none';
        }
    });
}

function deleteEvent(id) {
    if (confirm('Apakah Anda yakin ingin menghapus event ini?')) {
        // Create form data
        const formData = new FormData();
        formData.append('id', id);
        
        // Send delete request
        fetch('delete_event.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Reload page to see changes
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus event');
        });
    }
}
</script>

<?php include '../includes/footer.php'; ?>
