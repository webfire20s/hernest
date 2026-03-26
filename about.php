<?php require 'partials/header.php'; ?>

<style>
    :root {
        --accent: #2563eb;
        --dark: #020617;
    }

    /* --- Advanced Animation Engine --- */
    .reveal { 
        opacity: 0; 
        transform: translateY(50px) scale(0.95); 
        transition: all 1s cubic-bezier(0.22, 1, 0.36, 1); 
    }
    .reveal.active { 
        opacity: 1; 
        transform: translateY(0) scale(1); 
    }

    /* Floating Animation for Icons */
    .float-ui { animation: floating 4s ease-in-out infinite; }
    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    /* The "Neural" Background Mesh */
    .mesh-bg {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: 
            radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.1) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%);
        pointer-events: none;
        z-index: -1;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.5s shadow;
    }

    .glass-card:hover {
        transform: translateY(-10px) scale(1.02);
        background: white;
        box-shadow: 0 40px 80px -20px rgba(2, 6, 23, 0.15);
    }
</style>

<section class="relative pt-40 pb-32 overflow-hidden">
    <div class="mesh-bg"></div>
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 reveal">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 mb-6">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    <span class="text-[10px] font-black tracking-widest text-blue-600 uppercase">Our DNA</span>
                </div>
                <h1 class="text-7xl md:text-9xl font-black text-slate-900 leading-[0.85] tracking-tightest mb-8">
                    More than a <br><span class="text-blue-600">Platform.</span>
                </h1>
                <p class="text-xl text-slate-500 max-w-xl leading-relaxed font-medium mb-10">
                    HERNEST is an institutional-grade infrastructure designed to turn 10,000+ partners into digital wealth masters.
                </p>
                <div class="flex items-center gap-8">
                    <div>
                        <div class="text-3xl font-black text-slate-900">2026</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Roadmap Ready</div>
                    </div>
                    <div class="w-px h-10 bg-slate-200"></div>
                    <div>
                        <div class="text-3xl font-black text-slate-900">99.9%</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Efficiency</div>
                    </div>
                </div>
            </div>
            
            <div class="lg:w-1/2 relative reveal" style="transition-delay: 0.3s;">
                <div class="relative w-full h-[400px] bg-slate-100 rounded-[4rem] overflow-hidden border border-slate-200">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-emerald-500 opacity-10"></div>
                    
                    <div class="absolute top-10 left-10 glass-card p-6 rounded-3xl shadow-xl float-ui">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl mb-4 animate-pulse"></div>
                        <div class="h-2 w-20 bg-slate-200 rounded-full mb-2"></div>
                        <div class="h-2 w-12 bg-slate-100 rounded-full"></div>
                    </div>

                    <div class="absolute bottom-10 right-10 glass-card p-6 rounded-3xl shadow-xl float-ui" style="animation-delay: -2s;">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                                <div class="w-3 h-3 bg-white rounded-sm rotate-45"></div>
                            </div>
                            <div class="h-2 w-16 bg-slate-200 rounded-full"></div>
                        </div>
                        
                        <div class="flex items-end gap-2 h-12">
                            <div class="w-3 bg-emerald-200 rounded-t-sm animate-bounce" style="height: 40%; animation-duration: 2s;"></div>
                            <div class="w-3 bg-emerald-300 rounded-t-sm animate-bounce" style="height: 70%; animation-duration: 2.5s;"></div>
                            <div class="w-3 bg-emerald-500 rounded-t-sm animate-bounce" style="height: 100%; animation-duration: 1.8s;"></div>
                            <div class="w-3 bg-emerald-400 rounded-t-sm animate-bounce" style="height: 60%; animation-duration: 2.2s;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="py-32 bg-slate-950 rounded-[5rem] mx-4 overflow-hidden relative">
    <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-600/5 blur-[100px]"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-6xl font-black text-white mb-20 tracking-tighter text-center">How we <span class="text-blue-500">operate.</span></h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
            <div class="reveal">
                <div class="text-7xl font-black text-white/5 mb-[-2rem] ml-[-1rem]">01</div>
                <h3 class="text-2xl font-black text-white mb-4">Sourcing</h3>
                <p class="text-slate-400 leading-relaxed">We aggregate 15+ premium services from India's top banks and providers into a single high-speed API.</p>
            </div>
            <div class="reveal" style="transition-delay: 0.2s;">
                <div class="text-7xl font-black text-white/5 mb-[-2rem] ml-[-1rem]">02</div>
                <h3 class="text-2xl font-black text-white mb-4">Distribution</h3>
                <p class="text-slate-400 leading-relaxed">Our multi-level logic ensures that commissions are calculated and distributed with 0% margin of error.</p>
            </div>
            <div class="reveal" style="transition-delay: 0.4s;">
                <div class="text-7xl font-black text-white/5 mb-[-2rem] ml-[-1rem]">03</div>
                <h3 class="text-2xl font-black text-white mb-4">Empowerment</h3>
                <p class="text-slate-400 leading-relaxed">Partners get professional dashboards to track their growth and withdraw earnings instantly.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white reveal">
        <div class="max-w-7xl mx-auto px-6 bg-gradient-to-br from-blue-600 to-indigo-800 rounded-[3.5rem] p-12 md:p-24 text-white overflow-hidden relative">
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-16">
                <div class="max-w-xl text-center md:text-left">
                    <h2 class="text-4xl md:text-5xl font-black mb-8 leading-tight">Bank-Grade Security & Faster Payouts</h2>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <p class="text-lg opacity-90"><span class="font-bold">Instant Commission:</span> Withdraw your earnings instantly into your bank account without delays.</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <p class="text-lg opacity-90"><span class="font-bold">Encrypted Portal:</span> Your documents and financial data are secured with 256-bit SSL encryption.</p>
                        </div>
                    </div>
                    <div class="mt-12">
                        <a href="#" class="px-12 py-5 bg-white text-blue-700 font-black rounded-2xl hover:scale-105 transition-all shadow-xl">
                            Join Now
                        </a>
                    </div>
                </div>
                <div class="relative hidden lg:block">
                    <div class="w-80 h-80 bg-white/10 rounded-full flex items-center justify-center p-12 outline outline-white/20 outline-offset-[30px] floating">
                        <i class="fa-solid fa-user-check text-[10rem] text-white/50"></i>
                    </div>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -top-12 -right-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-blue-400/20 rounded-full blur-3xl"></div>
        </div>
    </section>

<section class="py-40 bg-white">
    <div class="max-w-5xl mx-auto px-6 text-center reveal">
        <svg class="w-20 h-20 text-blue-100 mx-auto mb-10" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V12C14.017 12.5523 13.5693 13 13.017 13H11.017C10.4647 13 10.017 12.5523 10.017 12V9C10.017 7.89543 10.9124 7 12.017 7H19.017C20.1216 7 21.017 7.89543 21.017 9V15C21.017 17.2091 19.2261 19 17.017 19H15.017C14.4647 19 14.017 19.4477 14.017 20V21H14.017ZM5.017 21L5.017 18C5.017 16.8954 5.91243 16 7.017 16H10.017C10.5693 16 11.017 15.5523 11.017 15V9C11.017 8.44772 10.5693 8 10.017 8H6.017C5.46472 8 5.017 8.44772 5.017 9V12C5.017 12.5523 4.56929 13 4.017 13H2.017C1.46472 13 1.017 12.5523 1.017 12V9C1.017 7.89543 1.91243 7 3.017 7H10.017C11.1216 7 12.017 7.89543 12.017 9V15C12.017 17.2091 10.2261 19 8.017 19H6.017C5.46472 19 5.017 19.4477 5.017 20V21H5.017Z"/></svg>
        <h2 class="text-3xl md:text-5xl font-medium text-slate-900 leading-snug italic mb-10">
            "Our mission is to democratize financial sovereignty by putting a bank in every partner's pocket."
        </h2>
        <div class="flex items-center justify-center gap-4">
            <div class="w-12 h-px bg-slate-300"></div>
            <p class="text-blue-600 font-black uppercase tracking-widest text-xs">The Leadership Team</p>
            <div class="w-12 h-px bg-slate-300"></div>
        </div>
    </div>
</section>
<section class="py-24 bg-white reveal">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-16 bg-slate-50 rounded-[4rem] p-8 md:p-16 border border-slate-100 shadow-sm">
            
            <div class="lg:w-1/2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-[10px] font-black tracking-widest text-emerald-600 uppercase">Verified Excellence</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight">
                    Authorized & <br><span class="text-blue-600">Certified.</span>
                </h2>
                <p class="text-lg text-slate-500 leading-relaxed mb-8">
                    HERNEST operates under strict compliance standards. Our certification reflects our commitment to security, transparency, and the financial success of our 10,000+ partners.
                </p>
                <div class="flex gap-4">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-tighter">Issued By</span>
                        <span class="text-lg font-black text-slate-900">Department of Promotion of Industry & Internal Trade</span>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 relative group">
                <div class="absolute inset-0 bg-blue-600/10 blur-[60px] rounded-full scale-75 group-hover:scale-110 transition-transform duration-700"></div>
                
                <div class="relative glass-card p-4 rounded-[2rem] shadow-2xl border border-white rotate-2 group-hover:rotate-0 transition-all duration-500">
                    <img src="assets/certificate.jpg" 
                         alt="Official Certification" 
                         class="w-full h-auto rounded-2xl shadow-inner grayscale-[0.2] group-hover:grayscale-0 transition-all">
                    
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl flex items-center gap-3 float-ui">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white">
                            <i class="fa-solid fa-ribbon text-xl"></i>
                        </div>
                        <!-- <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase leading-none">Status</p>
                            <p class="text-sm font-bold text-slate-900">Valid 2026</p>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-32 bg-blue-600 rounded-[5rem] mx-4 mb-20 relative overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 items-center gap-20">
        <div>
            <h2 class="text-5xl font-black text-white mb-8 tracking-tighter">Bank-Grade <br>Security.</h2>
            <p class="text-blue-100 text-lg mb-12">Your data and commissions are protected by AES-256 encryption and PCI-DSS compliant infrastructure.</p>
            <div class="grid grid-cols-2 gap-8">
                <div class="p-6 bg-white/10 rounded-3xl border border-white/20">
                    <div class="text-3xl font-black text-white">SSL</div>
                    <div class="text-[10px] text-blue-200 uppercase font-bold tracking-widest">Encrypted</div>
                </div>
                <div class="p-6 bg-white/10 rounded-3xl border border-white/20">
                    <div class="text-3xl font-black text-white">ISO</div>
                    <div class="text-[10px] text-blue-200 uppercase font-bold tracking-widest">Certified</div>
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-64 h-64 bg-white/5 rounded-full flex items-center justify-center border border-white/10 float-ui">
                <svg class="w-32 h-32 text-white opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
        </div>
    </div>
</section>

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

<?php require 'partials/footer.php'; ?>