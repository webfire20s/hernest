<?php require 'partials/header.php'; ?>

<style>
    :root {
        --fintech-blue: #2563eb;
        --fintech-emerald: #10b981;
        --fintech-dark: #020617;
    }

    /* --- Cinematic Cross-Fade Slider --- */
    .hero-wrapper {
        position: relative;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: var(--fintech-dark);
    }

    .slider-bg {
        position: absolute;
        inset: 0;
        z-index: 1;
    }

    .slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transform: scale(1.1);
        transition: opacity 2s ease-in-out, transform 8s linear;
    }

    .slide.active {
        opacity: 0.4; /* Controlled brightness for text legibility */
        transform: scale(1);
        z-index: 2;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, transparent 0%, rgba(2, 6, 23, 0.9) 100%);
        z-index: 3;
    }

    /* --- Partner Edge Glassmorphism --- */
    .edge-card {
        background: white;
        border: 1px solid #f1f5f9;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .edge-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 40px 80px -15px rgba(2, 6, 23, 0.1);
        border-color: var(--fintech-blue);
    }

    /* --- Animations --- */
    .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
    .reveal.active { opacity: 1; transform: translateY(0); }
</style>

<div class="hero-wrapper min-h-screen flex items-center justify-center py-20">
    <div class="slider-bg">
        <div class="slide active" style="background-image: url('assets/hero/photo1.jpg');"></div>
        <div class="slide" style="background-image: url('assets/hero/photo2.jpg');"></div>
        <div class="slide" style="background-image: url('assets/hero/photo3.jpg');"></div>
        <div class="slide" style="background-image: url('assets/hero/photo4.jpg');"></div>
    </div>
    <div class="hero-overlay"></div>

    <div class="relative z-10 text-center px-4 md:px-6 reveal">
        <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 md:mb-8 text-[9px] md:text-[10px] font-black tracking-[0.2em] md:tracking-[0.4em] text-blue-400 uppercase bg-blue-500/10 rounded-full border border-blue-500/20 backdrop-blur-md">
            Empowering Financial Independence
        </div>

        <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-9xl font-black text-white mb-6 md:mb-8 tracking-tighter leading-[1.1] md:leading-[0.9]">
            India’s #1 Fintech <br class="hidden sm:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Infrastructure.</span>
        </h1>

        <p class="max-w-2xl mx-auto text-base md:text-xl text-slate-400 mb-10 md:mb-14 leading-relaxed">
            Join 10,000+ Partners. Distribute premium products and earn up to <span class="text-white font-bold">₹1 Lakh monthly</span> with the HERNEST Digital Stack.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 md:gap-6 justify-center px-4 sm:px-0">
            <a href="contact.php" class="w-full sm:w-auto px-8 md:px-14 py-4 md:py-6 bg-white/5 text-white rounded-2xl font-bold shadow-2xl hover:bg-blue-700 transition-all text-center">
               Enquire Now
            </a>
            <a href="register_partner.php" class="w-full sm:w-auto px-8 md:px-14 py-4 md:py-6 bg-blue-600 text-white rounded-2xl font-bold shadow-2xl shadow-blue-600/20 hover:bg-blue-700 transition-all text-center">
                Become a Partner
            </a>
            <a href="services.php" class="w-full sm:w-auto px-8 md:px-14 py-4 md:py-6 bg-white/5 text-white backdrop-blur-md border border-white/10 rounded-2xl font-bold hover:bg-white/10 transition-all text-center">
                Explore Services
            </a>
        </div>
    </div>
</div>

<section class="py-8 md:py-12 bg-slate-950 border-y border-white/5 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-center md:justify-between items-center gap-6 md:gap-8 text-center md:text-left">
        <div class="flex flex-col md:flex-row items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-500 shrink-0">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
            </div>
            <div class="max-w-md md:max-w-none">
                <p class="text-slate-500 text-[10px] md:text-xs uppercase font-bold tracking-widest leading-loose">
                    Trusted by 500+ Clients | 150+ Women Empowered | 100+ Business Partners <br class="hidden md:block">
                    Building a Strong Digital Network Across India
                </p>
            </div>
        </div>
    </div>  
</section>

<section class="py-16 md:py-32 bg-white px-4 md:px-6 relative overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-blue-50/50 via-transparent to-transparent -z-10"></div>

    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 md:mb-24 gap-8">
            <div class="max-w-2xl reveal">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-8 h-px bg-blue-600"></span>
                    <span class="text-blue-600 font-bold text-[10px] md:text-xs uppercase tracking-[0.2em] md:tracking-[0.3em]">Exclusive Benefits</span>
                </div>
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-900 mb-6 tracking-tightest leading-[1.1] md:leading-none">
                    The Partner <span class="text-blue-600 italic">Edge.</span>
                </h2>
                <p class="text-slate-500 text-lg md:text-xl leading-relaxed font-medium">
                    We don't just provide a platform; we provide a <span class="text-slate-900 underline decoration-blue-200 underline-offset-4 md:underline-offset-8">complete business-in-a-box</span> for the modern entrepreneur.
                </p>
            </div>
            
            <div class="reveal w-full md:w-auto" style="transition-delay: 0.2s;">
                <div class="p-4 md:p-5 bg-white rounded-[1.5rem] md:rounded-[2rem] border border-slate-100 flex items-center gap-4 md:gap-5 shadow-xl shadow-slate-200/50">
                    <div class="flex -space-x-3 md:-space-x-4">
                        <img src="https://i.pravatar.cc/100?img=11" class="w-10 h-10 md:w-12 md:h-12 rounded-full border-2 md:border-4 border-white shadow-sm" alt="User">
                        <img src="https://i.pravatar.cc/100?img=12" class="w-10 h-10 md:w-12 md:h-12 rounded-full border-2 md:border-4 border-white shadow-sm" alt="User">
                        <img src="https://i.pravatar.cc/100?img=13" class="w-10 h-10 md:w-12 md:h-12 rounded-full border-2 md:border-4 border-white shadow-sm" alt="User">
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full border-2 md:border-4 border-white bg-blue-600 flex items-center justify-center text-[8px] md:text-[10px] font-bold text-white shadow-sm">+10k</div>
                    </div>
                    <div>
                        <p class="text-[8px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Current Community</p>
                        <p class="text-xs md:text-sm font-bold text-slate-900">Active Wealth Partners</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <div class="edge-card group relative p-8 md:p-14 rounded-[2.5rem] md:rounded-[3.5rem] bg-white border border-slate-100 transition-all duration-500 hover:border-blue-500/30 hover:shadow-2xl hover:shadow-blue-200/40 reveal">
                <div class="absolute top-6 right-6 md:top-8 md:right-8 text-slate-100 group-hover:text-blue-50 transition-colors">
                    <span class="text-4xl md:text-6xl font-black italic">01</span>
                </div>
                <div class="w-16 h-16 md:w-20 md:h-20 bg-blue-50 text-blue-600 rounded-2xl md:rounded-3xl flex items-center justify-center mb-8 md:mb-10 group-hover:bg-blue-600 group-hover:text-white group-hover:rotate-[10deg] transition-all duration-500 shadow-xl shadow-blue-100/50 group-hover:shadow-blue-600/30">
                    <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-black mb-4 md:mb-5 text-slate-900 tracking-tight">Instant Payouts</h3>
                <p class="text-slate-500 leading-relaxed mb-6 md:mb-8 text-base md:text-lg font-medium">Real-time tracking of your earnings with immediate withdrawal options directly to your primary bank account.</p>
                <div class="h-1 w-12 bg-blue-600 rounded-full group-hover:w-full transition-all duration-700"></div>
            </div>

            <div class="edge-card group relative p-8 md:p-14 rounded-[2.5rem] md:rounded-[3.5rem] bg-slate-950 text-white border-none shadow-2xl shadow-blue-900/20 reveal" style="transition-delay: 0.1s;">
                <div class="absolute top-6 right-6 md:top-8 md:right-8 text-slate-800 transition-colors">
                    <span class="text-4xl md:text-6xl font-black italic">02</span>
                </div>
                <div class="w-16 h-16 md:w-20 md:h-20 bg-blue-600 text-white rounded-2xl md:rounded-3xl flex items-center justify-center mb-8 md:mb-10 group-hover:scale-110 transition-transform duration-500 shadow-xl shadow-blue-500/20">
                    <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-black mb-4 md:mb-5 text-white tracking-tight">Expert Academy</h3>
                <p class="text-slate-400 leading-relaxed mb-6 md:mb-8 text-base md:text-lg font-medium">Exclusive access to "Hernest Academy" featuring digital marketing tactics and high-conversion sales webinars.</p>
                <div class="h-1 w-12 bg-blue-400 rounded-full group-hover:w-full transition-all duration-700"></div>
            </div>

            <div class="edge-card group relative p-8 md:p-14 rounded-[2.5rem] md:rounded-[3.5rem] bg-white border border-slate-100 transition-all duration-500 hover:border-blue-500/30 hover:shadow-2xl hover:shadow-blue-200/40 reveal" style="transition-delay: 0.2s;">
                <div class="absolute top-6 right-6 md:top-8 md:right-8 text-slate-100 group-hover:text-blue-50 transition-colors">
                    <span class="text-4xl md:text-6xl font-black italic">03</span>
                </div>
                <div class="w-16 h-16 md:w-20 md:h-20 bg-blue-50 text-blue-600 rounded-2xl md:rounded-3xl flex items-center justify-center mb-8 md:mb-10 group-hover:bg-blue-600 group-hover:text-white group-hover:rotate-[10deg] transition-all duration-500 shadow-xl shadow-blue-100/50 group-hover:shadow-blue-600/30">
                    <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-black mb-4 md:mb-5 text-slate-900 tracking-tight">Smart Analytics</h3>
                <p class="text-slate-500 leading-relaxed mb-6 md:mb-8 text-base md:text-lg font-medium">Powerful real-time dashboard to track customer leads, pending approvals, and your monthly revenue trends.</p>
                <div class="h-1 w-12 bg-blue-600 rounded-full group-hover:w-full transition-all duration-700"></div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="py-16 md:py-24 bg-slate-50 px-4 md:px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12 md:mb-20 reveal">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 mb-4 md:mb-6">Our Core Offerings</h2>
            <p class="text-slate-500 text-base md:text-lg">We have curated the best financial and digital services to ensure our partners have a diverse portfolio to offer their clients.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            
            <div class="service-card group bg-white p-8 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm reveal">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-xl md:text-2xl mb-6 md:mb-8 shadow-lg shadow-blue-200">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-4">Capital & Loans</h3>
                <p class="text-slate-500 mb-6 md:mb-8 leading-relaxed text-sm md:text-base">Helping businesses and individuals secure the right capital at competitive rates.</p>
                <ul class="space-y-3 md:space-y-4 mb-8 md:mb-10">
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-700">
                        <i class="fa-solid fa-circle-check text-blue-500"></i> Business & Personal Loans
                    </li>
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-700">
                        <i class="fa-solid fa-circle-check text-blue-500"></i> Loan Against Property
                    </li>
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-700">
                        <i class="fa-solid fa-circle-check text-blue-500"></i> Instant Approval Portal
                    </li>
                </ul>
                <a href="services.php" class="w-full py-4 px-6 bg-slate-50 text-slate-900 group-hover:bg-blue-600 group-hover:text-white rounded-2xl font-bold flex items-center justify-center gap-2 transition-all">
                    View Details <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="service-card group bg-slate-900 p-8 md:p-10 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl reveal">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-xl md:text-2xl mb-6 md:mb-8 shadow-lg shadow-emerald-500/20">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-white mb-4">Full Protection</h3>
                <p class="text-slate-400 mb-6 md:mb-8 leading-relaxed text-sm md:text-base">Comprehensive insurance solutions to safeguard what matters most to you.</p>
                <ul class="space-y-3 md:space-y-4 mb-8 md:mb-10">
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-300">
                        <i class="fa-solid fa-circle-check text-emerald-400"></i> Life & Health Coverage
                    </li>
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-300">
                        <i class="fa-solid fa-circle-check text-emerald-400"></i> Motor & Vehicle Insurance
                    </li>
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-300">
                        <i class="fa-solid fa-circle-check text-emerald-400"></i> General Assets Protection
                    </li>
                </ul>
                <a href="services.php" class="w-full py-4 px-6 bg-white/10 text-white group-hover:bg-emerald-500 rounded-2xl font-bold flex items-center justify-center gap-2 transition-all">
                    Learn More <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="service-card group bg-white p-8 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm reveal">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-purple-600 text-white rounded-2xl flex items-center justify-center text-xl md:text-2xl mb-6 md:mb-8 shadow-lg shadow-purple-200">
                    <i class="fa-solid fa-rocket"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-4">Digital Services</h3>
                <p class="text-slate-500 mb-6 md:mb-8 leading-relaxed text-sm md:text-base">Modern tools for modern times. Digital recharges, bookings, and more.</p>
                <ul class="space-y-3 md:space-y-4 mb-8 md:mb-10">
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-700">
                        <i class="fa-solid fa-circle-check text-purple-500"></i> Mobile & DTH Recharge
                    </li>
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-700">
                        <i class="fa-solid fa-circle-check text-purple-500"></i> Course & Skill Distribution
                    </li>
                    <li class="flex items-center gap-3 font-semibold text-xs md:text-sm text-slate-700">
                        <i class="fa-solid fa-circle-check text-purple-500"></i> Travel & Hotel Bookings
                    </li>
                </ul>
                <a href="services.php" class="w-full py-4 px-6 bg-slate-50 text-slate-900 group-hover:bg-purple-600 group-hover:text-white rounded-2xl font-bold flex items-center justify-center gap-2 transition-all">
                    Explore <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-16 md:py-32 bg-slate-50 px-4 md:px-6 rounded-[2rem] md:rounded-[5rem] mx-2 md:mx-4 mb-12 md:mb-20 reveal">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-center">
        <div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 mb-6 md:mb-8 tracking-tighter leading-tight">
                Calculate Your <br><span class="text-emerald-500">Earnings.</span>
            </h2>
            <p class="text-slate-500 text-base md:text-lg mb-8 md:mb-10 leading-relaxed">
                Adjust the sliders to see how much you can potentially earn by distributing different services to your network.
            </p>
            
            <div class="space-y-8 md:space-y-10">
                <div class="space-y-4">
                    <div class="flex justify-between font-bold text-slate-700 text-sm md:text-base">
                        <span>Loans Disbursed / Month</span>
                        <span id="loanValue" class="text-blue-600">50+</span>
                    </div>
                    <input type="range" min="1" max="100" value="55" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-blue-600" oninput="updateCalc()">
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between font-bold text-slate-700 text-sm md:text-base">
                        <span>Insurance Policies / Month</span>
                        <span id="insValue" class="text-emerald-500">70+</span>
                    </div>
                    <input type="range" min="1" max="100" value="75" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-emerald-500" oninput="updateCalc()">
                </div>
            </div>
        </div>

        <div class="bg-slate-900 p-8 md:p-12 rounded-[2.5rem] md:rounded-[3rem] text-center shadow-3xl">
            <p class="text-slate-400 font-bold uppercase tracking-[0.2em] md:tracking-[0.3em] text-[8px] md:text-[10px] mb-4 md:mb-6">
                Estimated Monthly Profit
            </p>
            <div class="text-5xl sm:text-6xl md:text-8xl font-black text-white mb-8 md:mb-10 tracking-tighter">
                ₹<span id="totalProfit">24,500</span>
            </div>
            <a href="register_partner.php" class="w-full block py-4 md:py-6 bg-emerald-500 text-white font-black rounded-xl md:rounded-2xl hover:bg-emerald-600 transition-all text-center">
                Claim This Opportunity
            </a>
        </div>
    </div>
</section>

<script>
    // --- Auto-Slide Logic ---
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    
    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
    setInterval(nextSlide, 2000); // Change slide every 2 seconds

    // --- Calculator Logic ---
    function updateCalc() {
        const loans = document.querySelectorAll('input[type="range"]')[0].value;
        const ins = document.querySelectorAll('input[type="range"]')[1].value;
        
        document.getElementById('loanValue').innerText = loans;
        document.getElementById('insValue').innerText = ins;
        
        // Mock math: Loan comm = 4000, Ins comm = 500
        const total = (loans * 4000) + (ins * 1000);
        document.getElementById('totalProfit').innerText = total.toLocaleString('en-IN');
    }

    // --- Intersection Observer ---
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

<?php require 'partials/footer.php'; ?>