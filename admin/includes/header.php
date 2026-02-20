<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Abhinaya Indo Group</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'Segoe UI', 'Roboto', 'Arial', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            600: '#14aecf',
                            700: '#0f8c9f'
                        }
                    }
                }
            }
        };
    </script>
</head>
<body class="font-sans bg-slate-50 text-slate-800">
    <div class="min-h-screen">
        <div class="lg:hidden sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-slate-200">
            <div class="px-4 h-14 flex items-center justify-between">
                <div class="font-semibold">Admin Dashboard</div>
                <button type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-lg hover:bg-slate-100" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <div class="flex">
