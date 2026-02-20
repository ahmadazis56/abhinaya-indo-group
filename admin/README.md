# Admin Panel - Abhinaya Indo Group

Admin panel sederhana untuk mengelola konten website Abhinaya Indo Group.

## 🚀 Fitur Utama

### 📅 Events Management
- Tambah/Edit/Hapus Events
- Upload gambar event
- Filter berdasarkan status (Upcoming/Ongoing/Past)
- Search functionality

### 🎨 Logo Management  
- Upload logo perusahaan/klien
- Kategori logo (Publisher/Creative/Techno/Client)
- Preview logo dalam modal
- Edit dan hapus logo

### 🖼️ Gallery Management
- Upload foto/gambar
- Kategori gallery (Event/Portfolio/Team/General)
- Grid dan List view
- Preview gambar full-size
- Storage tracking

## 📁 Struktur Folder

```
/admin/
├── index.php              # Dashboard utama
├── login.php              # Halaman login
├── logout.php             # Logout handler
├── README.md              # Dokumentasi
├── events/                # Events management
│   ├── index.php          # List events
│   ├── add.php            # Tambah event
│   └── edit.php           # Edit event
├── logos/                 # Logo management
│   ├── index.php          # List logos
│   ├── add.php            # Tambah logo
│   └── edit.php           # Edit logo
├── gallery/               # Gallery management
│   ├── index.php          # List gallery
│   ├── add.php            # Tambah foto
│   └── edit.php           # Edit foto
├── includes/              # Shared components
│   ├── header.php         # HTML header & styles
│   ├── sidebar.php        # Navigation sidebar
│   └── footer.php         # JavaScript & footer
└── uploads/               # File uploads
    ├── events/            # Event images
    ├── logos/             # Logo files
    └── gallery/           # Gallery photos
```

## 🔑 Login Credentials

**Default Login:**
- Username: `admin`
- Password: `admin123`

> ⚠️ **Penting:** Ganti password default untuk keamanan!

## 🛠️ Setup Instructions

### 1. Database Setup
Buat database dan tabel-tabel berikut:

```sql
-- Events Table
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    date DATE,
    time TIME,
    location VARCHAR(255),
    status ENUM('upcoming', 'ongoing', 'past') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Logo Table  
CREATE TABLE logos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    category ENUM('publisher', 'creative', 'techno', 'client') DEFAULT 'client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Gallery Table
CREATE TABLE gallery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    image VARCHAR(255) NOT NULL,
    category ENUM('event', 'portfolio', 'team', 'general') DEFAULT 'general',
    file_size DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 2. Folder Permissions
Pastikan folder uploads memiliki permission yang tepat:

```bash
chmod 755 admin/uploads/
chmod 755 admin/uploads/events/
chmod 755 admin/uploads/logos/
chmod 755 admin/uploads/gallery/
```

### 3. Configuration
Edit file konfigurasi database di setiap file PHP:

```php
// Database connection
$host = 'localhost';
$username = 'your_db_username';
$password = 'your_db_password';
$database = 'your_database_name';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
```

## 🎨 Customization

### Mengubah Warna Tema
Edit file `includes/header.php` dan ubah CSS variables:

```css
:root {
    --primary-color: #14aecf;
    --secondary-color: #0f8c9f;
    --accent-color: #3b82f6;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
}
```

### Menambah Fitur Baru
1. Buat folder baru di `/admin/`
2. Tambah menu di `includes/sidebar.php`
3. Ikuti struktur yang sudah ada

## 📱 Responsive Design

Admin panel sudah responsive dan dapat diakses di:
- Desktop (1920px+)
- Tablet (768px - 1024px)  
- Mobile (320px - 768px)

## 🔒 Security Features

- Session-based authentication
- Input sanitization
- File upload validation
- CSRF protection (rekomendasi)
- SQL injection prevention (rekomendasi)

## 🚀 Future Enhancements

- [ ] User role management
- [ ] Activity logging
- [ ] Backup system
- [ ] Email notifications
- [ ] API integration
- [ ] Multi-language support

## 🐞 Troubleshooting

### Upload tidak berfungsi
1. Check folder permissions
2. Verify PHP upload limits
3. Check file size restrictions

### Login tidak berfungsi
1. Verify session configuration
2. Check database connection
3. Verify credentials

### Gambar tidak tampil
1. Check file paths
2. Verify folder permissions
3. Check .htaccess configuration

## 📞 Support

Untuk bantuan atau pertanyaan:
- Email: support@abhinaya.co.id
- Phone: +62 XXX XXXX

---

**Version:** 1.0.0  
**Last Updated:** February 2024  
**Developer:** Abhinaya Techno Team
