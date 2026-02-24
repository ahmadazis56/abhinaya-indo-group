<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Abhinaya</title>
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
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        };
    </script>
</head>
<body class="font-sans bg-slate-50 text-slate-800 antialiased selection:bg-brand-500 selection:text-white">
    <div class="min-h-screen flex flex-col lg:flex-row">
        
        <!-- Mobile Header (Visible only on small screens) -->
        <div class="lg:hidden sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200">
            <div class="px-4 h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white font-bold">A</div>
                    <div class="font-bold text-slate-900 tracking-tight">Admin Dashboard</div>
                </div>
                <button type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors" onclick="toggleSidebar()">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>

        <div class="flex w-full">
