# Abhinaya Indo Group Website

Simple website with admin panel for managing portfolio, team, and client logos.

## 🚀 Quick Start

### 1. Database Setup
Open your browser and go to:
```
http://localhost/web/setup.php
```

This will create the database and tables automatically.

### 2. Admin Access
- URL: `http://localhost/web/admin/`
- Username: `admin`
- Password: `admin123`

### 3. Start Adding Content
- Add portfolio items
- Add team members  
- Add client logos

## 📁 File Structure

```
web/
├── admin/                  # Admin panel
│   ├── index.php          # Dashboard
│   ├── login.php          # Login page
│   ├── logout.php         # Logout
│   ├── portfolio/         # Portfolio CRUD
│   ├── team/              # Team CRUD
│   ├── logos/             # Client logos CRUD
│   └── includes/          # Admin components
├── config/
│   └── database.php       # Database functions
├── uploads/               # Uploaded files
│   ├── portfolio/         # Portfolio images
│   ├── team/              # Team photos
│   └── logos/             # Client logos
├── index.php              # Homepage
├── setup.php              # Database setup
└── README.md              # This file
```

## 🎯 Features

### Portfolio Management
- Add/edit/delete portfolio items
- Upload images
- Add project links
- Categories and tags

### Team Management
- Add/edit/delete team members
- Upload photos
- Add roles and descriptions
- Contact information

### Client Logos Management
- Add/edit/delete client logos
- Simple upload interface
- Display order control

## 🛠️ Technical Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **File Upload**: PHP file handling

## 🔧 Configuration

### Database Settings
Edit `config/database.php`:
```php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';
```

### Upload Settings
- Max file size: 5MB
- Allowed formats: JPG, PNG, GIF, WebP
- Auto-resize: No (maintains quality)

## 📱 How It Works

1. **Admin uploads content** → Files saved to `uploads/`
2. **Data stored in database** → MySQL tables
3. **Website displays content** → Dynamic PHP pages
4. **Real-time updates** → Changes appear immediately

## 🔒 Security

- Password hashing (bcrypt)
- SQL injection protection (prepared statements)
- XSS protection (htmlspecialchars)
- File validation
- Session management

## 🐛 Troubleshooting

### Database Issues
- Make sure XAMPP MySQL is running
- Check database credentials
- Run `setup.php` again

### Upload Issues
- Check folder permissions (chmod 755)
- Verify PHP upload limits
- Check file format and size

### Permission Issues
```bash
chmod -R 755 uploads/
chmod -R 755 admin/
```

## 📞 Support

For issues:
1. Check browser console for errors
2. Verify database connection
3. Test file permissions
4. Contact development team

## 🔄 Updates

- Add new features to admin panel
- Improve responsive design
- Add more validation
- Enhance security

---

**Simple, Clean, Admin-Controlled Website** 🎯
