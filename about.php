<?php require 'partials/header.php'; ?>

<style>
    /* --- Enterprise UI Kit --- */
    .hero-gradient {
        background: radial-gradient(circle at 0% 0%, rgba(37, 99, 235, 0.15) 0%, transparent 40%),
                    radial-gradient(circle at 100% 100%, rgba(30, 64, 175, 0.1) 0%, transparent 40%);
    }

    .feature-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .feature-card:hover {
        border-color: #3b82f6;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05);
        transform: translateY(-5px);
    }

    /* Textures to prevent "Empty" look */
    .grid-pattern {
        background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
        background-size: 32px 32px;
    }

    /* Responsive text fixes */
    .text-responsive-h1 { font-size: clamp(2.5rem, 8vw, 6rem); }
    
    .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
    .reveal.active { opacity: 1; transform: translateY(0); }
</style>

<div class="grid-pattern">
    
    <section class="relative pt-24 pb-12 md:pt-40 md:pb-24 hero-gradient">
        <div class="max-w-7xl mx-auto px-5">
            <div class="flex flex-col lg:flex-row items-center gap-10 md:gap-16">
                
                <div class="w-full lg:w-3/5 text-center lg:text-left reveal">
                    <div class="inline-block px-4 py-1.5 rounded-full bg-blue-600 text-white text-[10px] font-black uppercase tracking-[0.2em] mb-6 shadow-lg shadow-blue-200">
                        The Infrastructure of Trust
                    </div>
                    <h1 class="text-responsive-h1 font-black text-slate-900 leading-[1.05] tracking-tight mb-8">
                        The Future of <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Service Logistics.</span>
                    </h1>
                    <p class="text-slate-600 text-base md:text-xl max-w-2xl leading-relaxed mb-10 mx-auto lg:mx-0">
                        HERNEST isn't just a platform; it's a proprietary ecosystem connecting 15+ high-demand financial services to a network of 10,000+ verified distribution partners across India.
                    </p>
                    
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        <a href="register_partner.php" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-blue-600 transition-all shadow-xl">Start Earning</a>
                        <div class="flex -space-x-3 items-center">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-200"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-300"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-400"></div>
                            <span class="pl-5 text-sm font-bold text-slate-500">Join 10k+ Partners</span>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/5 reveal" style="transition-delay: 200ms;">
                    <div class="relative p-6 bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl">
                        <div class="space-y-4">
                            <div class="h-32 bg-slate-50 rounded-2xl border border-dashed border-slate-200 flex items-center justify-center">
                                <i class="fa-solid fa-chart-pie text-4xl text-blue-200"></i>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="h-20 bg-blue-50 rounded-xl p-3">
                                    <div class="w-8 h-1.5 bg-blue-200 rounded-full mb-2"></div>
                                    <div class="w-12 h-4 bg-blue-600 rounded-lg"></div>
                                </div>
                                <div class="h-20 bg-slate-50 rounded-xl p-3">
                                    <div class="w-8 h-1.5 bg-slate-200 rounded-full mb-2"></div>
                                    <div class="w-12 h-4 bg-slate-900 rounded-lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-12 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-5">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center md:border-r border-slate-100 last:border-0">
                    <div class="text-3xl font-black text-slate-900">15+</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Global Services</div>
                </div>
                <div class="text-center md:border-r border-slate-100 last:border-0">
                    <div class="text-3xl font-black text-slate-900">₹1 L+</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Processed Monthly</div>
                </div>
                <div class="text-center md:border-r border-slate-100 last:border-0">
                    <div class="text-3xl font-black text-slate-900">99.9%</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Uptime SLA</div>
                </div>
                <div class="text-center last:border-0">
                    <div class="text-3xl font-black text-slate-900">Instant</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Settlement</div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 md:py-32">
        <div class="max-w-7xl mx-auto px-5">
            <div class="mb-16 reveal">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">Our Core Ecosystem.</h2>
                <div class="h-1.5 w-20 bg-blue-600 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <div class="feature-card p-8 md:p-10 rounded-[2.5rem] reveal">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8">
                        <i class="fa-solid fa-shield-halved text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Enterprise Security</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Every transaction and data point is guarded by 256-bit encryption and ISO-compliant server architecture.
                    </p>
                </div>

                <div class="bg-slate-900 p-8 md:p-10 rounded-[2.5rem] shadow-2xl reveal shadow-blue-900/20" style="transition-delay: 150ms;">
                    <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-8">
                        <i class="fa-solid fa-bolt-lightning text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Zero-Delay Payouts</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Our real-time commission engine ensures that as soon as a service is delivered, your earnings are ready.
                    </p>
                </div>

                <div class="feature-card p-8 md:p-10 rounded-[2.5rem] reveal" style="transition-delay: 300ms;">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8">
                        <i class="fa-solid fa-laptop-code text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Aggregator Tech</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        One single point of entry for Loans, Insurance, and Digital Marketing tools from top Indian providers.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-24">
        <div class="max-w-7xl mx-auto px-5">
            <div class="bg-blue-50/50 border border-blue-100 rounded-[3rem] p-8 md:p-16 flex flex-col md:flex-row items-center gap-12 reveal">
                <div class="w-full md:w-1/2">
                    <h2 class="text-3xl font-black text-slate-900 mb-6 tracking-tight">Regulated. Recognized. Reliable.</h2>
                    <p class="text-slate-600 mb-8 leading-relaxed">
                        HERNEST is officially recognized by the **DPIIT (Department for Promotion of Industry and Internal Trade)**. We operate within the strict legal framework of the Government of India to ensure long-term stability for our partners.
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="assets/dpiit_logo.png" alt="DPIIT Logo" class="h-12 opacity-80  transition-all">
                        <div class="h-8 w-px bg-blue-200"></div>
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Startup India Certified</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="relative bg-white p-3 rounded-3xl shadow-xl rotate-1">
                        <img src="assets/certificate.jpg" alt="Certification" class="rounded-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-32 bg-slate-50/50 border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-12 md:mb-20 reveal">
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight">Diverse Service <span class="text-blue-600">Portfolios.</span></h2>
            <p class="text-slate-500 font-medium text-base md:text-lg">One dashboard. Unlimited financial possibilities for your customers.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            
            <div class="p-8 md:p-10 bg-white border border-slate-200 rounded-[2rem] hover:border-blue-500 hover:shadow-xl transition-all reveal">
                <i class="fa-solid fa-building-columns text-4xl text-blue-600 mb-8"></i>
                <h4 class="text-xl font-black text-slate-900 mb-3">Banking Services</h4>
                <p class="text-[10px] text-slate-400 leading-relaxed uppercase font-black tracking-[0.15em]">Savings · Current · Demat</p>
            </div>

            <div class="p-8 md:p-10 bg-white border border-slate-200 rounded-[2rem] hover:border-blue-500 hover:shadow-xl transition-all reveal" style="transition-delay: 100ms;">
                <i class="fa-solid fa-credit-card text-4xl text-blue-600 mb-8"></i>
                <h4 class="text-xl font-black text-slate-900 mb-3">Credit Solutions</h4>
                <p class="text-[10px] text-slate-400 leading-relaxed uppercase font-black tracking-[0.15em]">Personal · Business · Gold</p>
            </div>

            <div class="p-8 md:p-10 bg-white border border-slate-200 rounded-[2rem] hover:border-blue-500 hover:shadow-xl transition-all reveal" style="transition-delay: 200ms;">
                <i class="fa-solid fa-umbrella text-4xl text-blue-600 mb-8"></i>
                <h4 class="text-xl font-black text-slate-900 mb-3">Risk Protection</h4>
                <p class="text-[10px] text-slate-400 leading-relaxed uppercase font-black tracking-[0.15em]">Health · Life · Vehicle</p>
            </div>

            <div class="p-8 md:p-10 bg-white border border-slate-200 rounded-[2rem] hover:border-blue-500 hover:shadow-xl transition-all reveal" style="transition-delay: 300ms;">
                <i class="fa-solid fa-bullhorn text-4xl text-blue-600 mb-8"></i>
                <h4 class="text-xl font-black text-slate-900 mb-3">Digital Growth</h4>
                <p class="text-[10px] text-slate-400 leading-relaxed uppercase font-black tracking-[0.15em]">Marketing · IT · SEO</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 md:py-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-12 md:gap-20 items-center">
            
            <div class="w-full lg:w-1/3 text-center lg:text-left reveal">
                <h2 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 tracking-tighter">Your Path to <br><span class="text-blue-600">Sovereignty.</span></h2>
                <p class="text-slate-500 text-base md:text-lg leading-relaxed">
                    We’ve engineered a friction-less onboarding process. You focus on the relationships; we handle the technology and compliance.
                </p>
            </div>

            <div class="w-full lg:w-2/3">
                <div class="relative flex flex-col md:flex-row gap-10 md:gap-6">
                    
                    <div class="relative flex-1 p-8 md:p-10 bg-white border border-slate-100 rounded-[2.5rem] shadow-sm reveal">
                        <span class="absolute -top-5 left-8 md:-left-4 w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-black italic shadow-lg shadow-blue-200">01</span>
                        <h5 class="text-xl font-black text-slate-900 mb-4 mt-4">Fast Onboarding</h5>
                        <p class="text-sm text-slate-500 leading-relaxed">Complete your digital KYC and get verified within 24 hours.</p>
                    </div>

                    <div class="relative flex-1 p-8 md:p-10 bg-white border border-slate-100 rounded-[2.5rem] shadow-sm reveal" style="transition-delay: 200ms;">
                        <span class="absolute -top-5 left-8 md:-left-4 w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center font-black italic shadow-lg">02</span>
                        <h5 class="text-xl font-black text-slate-900 mb-4 mt-4">Service Selection</h5>
                        <p class="text-sm text-slate-500 leading-relaxed">Access the full library of 15+ services and start distributing instantly.</p>
                    </div>

                    <div class="relative flex-1 p-8 md:p-10 bg-slate-900 rounded-[2.5rem] shadow-2xl shadow-blue-900/20 reveal" style="transition-delay: 400ms;">
                        <span class="absolute -top-5 left-8 md:-left-4 w-12 h-12 bg-blue-500 text-white rounded-2xl flex items-center justify-center font-black italic shadow-lg shadow-blue-500/40">03</span>
                        <h5 class="text-xl font-black text-white mb-4 mt-4">Scale & Earn</h5>
                        <p class="text-sm text-slate-400 leading-relaxed">Track commissions on your live dashboard and withdraw earnings 24/7.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


</div>

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

<?php require 'partials/footer.php'; ?>