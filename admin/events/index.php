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

<div class="main-content">
    <div class="page-header">
        <h1>📅 Events Management</h1>
        <a href="add.php" class="btn btn-primary">
            <span>➕</span> Tambah Event Baru
        </a>
    </div>

    <div class="events-container">
        <div class="filter-section">
            <div class="filter-group">
                <label>Status:</label>
                <select id="statusFilter" onchange="filterEvents()">
                    <option value="">Semua</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="past">Past</option>
                </select>
            </div>
            
            <div class="search-group">
                <input type="text" id="searchEvents" placeholder="Cari events..." onkeyup="searchEvents()">
            </div>
        </div>

        <div class="events-grid" id="eventsList">
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
            
            // Fetch events from database
            $sql = "SELECT * FROM events ORDER BY date DESC";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="event-card" data-title="' . htmlspecialchars($row['title']) . '" data-status="' . htmlspecialchars($row['status']) . '">';
                    echo '<div class="event-image">';
                    if (!empty($row['image'])) {
                        echo '<img src="../uploads/events/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '">';
                    } else {
                        echo '<img src="https://via.placeholder.com/400x250/6366f1/ffffff?text=Event" alt="' . htmlspecialchars($row['title']) . '">';
                    }
                    echo '<span class="event-status status-' . htmlspecialchars($row['status']) . '">' . htmlspecialchars(ucfirst($row['status'])) . '</span>';
                    echo '</div>';
                    echo '<div class="event-content">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p class="event-desc">' . htmlspecialchars($row['description']) . '</p>';
                    echo '<div class="event-meta">';
                    echo '<div class="meta-item">';
                    echo '<i>📅</i>';
                    echo '<span>' . date('d M Y', strtotime($row['date'])) . '</span>';
                    echo '</div>';
                    echo '<div class="meta-item">';
                    echo '<i>📍</i>';
                    echo '<span>' . htmlspecialchars($row['location']) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="event-actions">';
                    echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-sm btn-secondary">Edit</a>';
                    echo '<button onclick="deleteEvent(' . $row['id'] . ')" class="btn btn-sm btn-danger">Hapus</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="empty-state">';
                echo '<div class="empty-icon">📅</div>';
                echo '<h3>Belum Ada Events</h3>';
                echo '<p>Anda belum menambahkan event apapun. Mulai dengan menambahkan event pertama Anda!</p>';
                echo '<div class="empty-actions">';
                echo '<a href="add.php" class="btn btn-primary">';
                echo '<span>➕</span> Tambah Event Pertama';
                echo '</a>';
                echo '</div>';
                echo '</div>';
            }
            
            $conn->close();
            ?>
        </div>
    </div>
</div>

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .page-header h1 {
        color: #1e293b;
        font-size: 1.8rem;
    }

    .filter-section {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        display: flex;
        gap: 2rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-group, .search-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-group label {
        font-weight: 500;
        color: #64748b;
    }

    .filter-group select, .search-group input {
        padding: 0.5rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .search-group input {
        width: 250px;
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .event-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .event-card:hover {
        transform: translateY(-5px);
    }

    .event-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .event-status {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        color: white;
    }

    .status-upcoming { background: #3b82f6; }
    .status-ongoing { background: #10b981; }
    .status-past { background: #64748b; }

    .event-content {
        padding: 1.5rem;
    }

    .event-content h3 {
        color: #1e293b;
        margin-bottom: 0.5rem;
        font-size: 1.2rem;
    }

    .event-desc {
        color: #64748b;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        margin-bottom: 1rem;
    }

    .event-date, .event-location {
        font-size: 0.9rem;
        color: #64748b;
    }

    .event-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        color: #64748b;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 20px;
        border: 2px dashed #cbd5e0;
        margin: 2rem 0;
    }

    .empty-icon {
        font-size: 5rem;
        color: #cbd5e0;
        margin-bottom: 2rem;
        opacity: 0.7;
    }

    .empty-state h3 {
        color: #1e293b;
        margin-bottom: 1rem;
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .empty-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .empty-actions .btn {
        padding: 1rem 2rem;
        font-size: 1rem;
        border-radius: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .empty-actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.2);
    }

    @media (max-width: 768px) {
        .events-grid {
            grid-template-columns: 1fr;
        }
        
        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-group input {
            width: 100%;
        }
    }
</style>

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
