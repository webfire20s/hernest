<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERNEST | Premium Financial Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
        
        /* Premium Header Blur */
        .nav-blur { 
            backdrop-filter: blur(20px); 
            background: rgba(255, 255, 255, 0.7); 
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Scrolled State */
        .header-scrolled {
            height: 4.5rem !important;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
        }

        /* Nav Link Inversion Effect */
        .nav-link { 
            position: relative; 
            padding: 0.5rem 1rem;
            transition: all 0.3s ease; 
        }
        .nav-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: #f1f5f9;
            border-radius: 0.75rem;
            scale: 0.8;
            opacity: 0;
            z-index: -1;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-link:hover { color: #2563eb; }
        .nav-link:hover::before { scale: 1; opacity: 1; }
        
        /* Mobile Menu Micro-interactions */
        #mobile-menu {
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            transform: translateY(-20px) scale(0.95);
            opacity: 0;
            pointer-events: none;
            clip-path: circle(0% at top right);
        }
        #mobile-menu.active {
            transform: translateY(0) scale(1);
            opacity: 1;
            pointer-events: auto;
            clip-path: circle(150% at top right);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<header id="main-header" class="sticky top-0 z-[100] nav-blur border-b border-slate-200/60 transition-all duration-300">
    <nav class="max-w-7xl mx-auto px-6 h-24 flex items-center justify-between transition-all duration-300" id="nav-container">
        
        <div class="flex items-center gap-2 shrink-0">
            <a href="index.php" class="flex items-center shrink-0 group">
                <div class="w-14 h-14 rounded-2xl overflow-hidden flex items-center justify-center shadow-xl shadow-blue-100 border border-white transition-transform group-hover:scale-105">
                    <img src="assets/logo.jpeg" alt="HERNEST Logo" class="w-full h-full object-cover">
                </div>
                <span class="ml-3 font-black text-xl tracking-tighter text-slate-900 hidden sm:block">HERNEST</span>
            </a>
        </div>

        <div class="hidden md:flex items-center gap-2 font-bold text-[13px] uppercase tracking-widest text-slate-500">
            <a href="index.php" class="nav-link">Home</a>
            <a href="about.php" class="nav-link">About</a>
            <a href="services.php" class="nav-link">Services</a>
            <a href="contact.php" class="nav-link">Contact</a>
        </div>

        <div class="flex items-center gap-4">
            <a href="login.php" class="hidden sm:inline-flex px-8 py-3 bg-slate-900 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 hover:shadow-blue-200 active:scale-95">
                Portal
            </a>
            
            <button id="menu-btn" class="md:hidden w-12 h-12 flex items-center justify-center text-slate-600 hover:bg-white rounded-xl transition-all border border-transparent hover:border-slate-100 shadow-sm">
                <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="absolute top-full left-0 w-full bg-white/95 backdrop-blur-2xl border-b border-slate-200 shadow-2xl md:hidden">
        <div class="flex flex-col p-8 gap-6 font-black text-[11px] uppercase tracking-[0.2em] text-slate-400">
            <a href="index.php" class="flex justify-between items-center hover:text-blue-600 group">
                Home <span class="opacity-0 group-hover:opacity-100 transition-opacity">→</span>
            </a>
            <a href="about.php" class="flex justify-between items-center hover:text-blue-600 group">
                About <span class="opacity-0 group-hover:opacity-100 transition-opacity">→</span>
            </a>
            <a href="services.php" class="flex justify-between items-center hover:text-blue-600 group">
                Services <span class="opacity-0 group-hover:opacity-100 transition-opacity">→</span>
            </a>
            <a href="contact.php" class="flex justify-between items-center hover:text-blue-600 group">
                Contact <span class="opacity-0 group-hover:opacity-100 transition-opacity">→</span>
            </a>
            <a href="login.php" class="mt-4 py-5 bg-slate-900 text-white text-center rounded-2xl tracking-[0.3em]">
                Partner Login
            </a>
        </div>
    </div>
</header>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const header = document.getElementById('main-header');
    const navContainer = document.getElementById('nav-container');

    // Header Scroll Observer
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            header.classList.add('header-scrolled');
            navContainer.classList.replace('h-24', 'h-20');
        } else {
            header.classList.remove('header-scrolled');
            navContainer.classList.replace('h-20', 'h-24');
        }
    });

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
        
        if(mobileMenu.classList.contains('active')) {
            menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>`;
        } else {
            menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"></path>`;
        }
    });

    document.addEventListener('click', (e) => {
        if (!menuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.remove('active');
            menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"></path>`;
        }
    });
</script>

<main>