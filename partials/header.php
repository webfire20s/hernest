<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERNEST | Premium Financial Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .nav-blur { backdrop-filter: blur(12px); background: rgba(255, 255, 255, 0.85); }
        .nav-link { position: relative; transition: all 0.3s ease; }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0; height: 2px;
            bottom: -4px; left: 0;
            background-color: #2563eb;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }
        
        /* Mobile Menu Animation */
        #mobile-menu {
            transition: all 0.3s ease-in-out;
            transform: translateY(-20px);
            opacity: 0;
            pointer-events: none;
        }
        #mobile-menu.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<header class="sticky top-0 z-[100] nav-blur border-b border-slate-200">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">
        
        <div class="flex items-center gap-2 shrink-0">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-200">
                H
            </div>
            <span class="text-xl sm:text-2xl font-bold tracking-tight text-slate-800">HERNEST</span>
        </div>

        <div class="hidden md:flex items-center gap-8 font-medium text-slate-600">
            <a href="index.php" class="nav-link hover:text-blue-600">Home</a>
            <a href="about.php" class="nav-link hover:text-blue-600">About</a>
            <a href="services.php" class="nav-link hover:text-blue-600">Services</a>
            <a href="contact.php" class="nav-link hover:text-blue-600">Contact</a>
        </div>

        <div class="flex items-center gap-4">
            <a href="login.php" class="hidden sm:inline-block px-6 py-2.5 bg-slate-900 text-white rounded-full font-semibold hover:bg-blue-600 transform hover:-translate-y-0.5 transition-all shadow-md active:scale-95">
                Login
            </a>
            
            <button id="menu-btn" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                <svg id="menu-icon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="absolute top-20 left-0 w-full bg-white border-b border-slate-200 shadow-xl md:hidden z-[-1]">
        <div class="flex flex-col p-6 gap-4 font-semibold text-slate-700">
            <a href="index.php" class="py-2 hover:text-blue-600 border-b border-slate-50">Home</a>
            <a href="about.php" class="py-2 hover:text-blue-600 border-b border-slate-50">About</a>
            <a href="services.php" class="py-2 hover:text-blue-600 border-b border-slate-50">Services</a>
            <a href="contact.php" class="py-2 hover:text-blue-600 border-b border-slate-50">Contact</a>
            <a href="login.php" class="mt-2 py-3 bg-blue-600 text-white text-center rounded-xl">Login to Account</a>
        </div>
    </div>
</header>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
        
        // Toggle icon between Hamburger and X
        if(mobileMenu.classList.contains('active')) {
            menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>`;
        } else {
            menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>`;
        }
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!menuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.remove('active');
            menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>`;
        }
    });
</script>

<main class="max-w-7xl mx-auto px-4 sm:px-6 py-12">