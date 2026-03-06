<?php require 'partials/header.php'; ?>

<style>
    /* Premium Animation Classes */
    .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .glass-card { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); }
    .gradient-text { background: linear-gradient(135deg, #1e40af 0%, #4338ca 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .step-line { position: absolute; top: 50%; left: 0; width: 100%; height: 2px; background: #e2e8f0; z-index: -1; }
</style>

<section class="py-24 flex flex-col items-center text-center reveal">
    <div class="inline-block px-4 py-1.5 mb-6 text-sm font-semibold tracking-wide text-blue-600 uppercase bg-blue-50 rounded-full animate-bounce">
        The Future of Service Distribution
    </div>
    
    <h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 mb-8 tracking-tighter">
        Empowering <span class="gradient-text">HERNEST</span>
    </h1>
    
    <p class="max-w-3xl mx-auto text-xl text-slate-500 mb-12 leading-relaxed">
        A sophisticated ecosystem delivering 15+ essential services—from competitive Loans and Insurance to cutting-edge Digital Marketing.
    </p>

    <div class="flex flex-col sm:flex-row gap-6 justify-center">
        <a href="https://razorpay.me/@krantikumarjain" target="_blank" class="group px-10 py-5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-2xl font-bold shadow-2xl shadow-emerald-200/50 hover:-translate-y-2 transition-all duration-300 flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Pay Now
        </a>
        <a href="services.php" class="group px-10 py-5 bg-slate-900 text-white rounded-2xl font-bold shadow-2xl hover:bg-blue-600 hover:-translate-y-2 transition-all duration-300 flex items-center gap-3">
            Explore All Services
            <span class="group-hover:translate-x-1 transition-transform">→</span>
        </a>
        <a href="login.php" class="px-10 py-5 bg-white text-slate-900 border border-slate-200 rounded-2xl font-bold hover:bg-slate-50 transition-all shadow-sm">
            Partner Login
        </a>
    </div>  
</section>

<section class="mb-32 grid grid-cols-2 md:grid-cols-4 gap-8 reveal">
    <div class="text-center p-8 glass-card rounded-3xl shadow-sm">
        <div class="text-4xl font-black text-slate-900 mb-2">15+</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Active Services</div>
    </div>
    <div class="text-center p-8 glass-card rounded-3xl shadow-sm">
        <div class="text-4xl font-black text-blue-600 mb-2">24/7</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Digital Support</div>
    </div>
    <div class="text-center p-8 glass-card rounded-3xl shadow-sm">
        <div class="text-4xl font-black text-slate-900 mb-2">100%</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Secure Platform</div>
    </div>
    <div class="text-center p-8 glass-card rounded-3xl shadow-sm">
        <div class="text-4xl font-black text-blue-600 mb-2">Instant</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Payouts/Access</div>
    </div>
</section>

<section class="mb-32 reveal px-4">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-slate-900 mb-4">How It Works</h2>
        <p class="text-slate-500">Getting started with HERNEST is simple and efficient.</p>
    </div>
    <div class="relative grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
        <div class="hidden md:block step-line"></div>
        <div class="relative bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
            <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mx-auto mb-6 shadow-lg">1</div>
            <h3 class="text-xl font-bold mb-2">Select Service</h3>
            <p class="text-slate-500 text-sm">Choose from our vast catalog of 15+ financial and digital products.</p>
        </div>
        <div class="relative bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
            <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mx-auto mb-6 shadow-lg">2</div>
            <h3 class="text-xl font-bold mb-2">Submit Details</h3>
            <p class="text-slate-500 text-sm">Upload required documents through our high-security digital portal.</p>
        </div>
        <div class="relative bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
            <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mx-auto mb-6 shadow-lg">3</div>
            <h3 class="text-xl font-bold mb-2">Fast Approval</h3>
            <p class="text-slate-500 text-sm">Receive instant confirmation and enjoy seamless service fulfillment.</p>
        </div>
    </div>
</section>

<section class="mb-32 reveal">
    <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
        <div class="max-w-xl">
            <h2 class="text-4xl font-bold text-slate-900 mb-4 tracking-tight">One Platform, Every Solution.</h2>
            <p class="text-slate-500">We've categorized our 15+ offerings into three core pillars to help you find exactly what you need.</p>
        </div>
        <a href="services.php" class="text-blue-600 font-bold hover:underline flex items-center gap-2">
            View the Full Catalog
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="group p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-blue-500 transition-all duration-500">
            <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-8 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-slate-900">Capital & Loans</h3>
            <ul class="space-y-3 text-slate-500">
                <li class="flex items-center gap-2"><span>•</span> Personal & Business Loans</li>
                <li class="flex items-center gap-2"><span>•</span> Loan Against Property</li>
                <li class="flex items-center gap-2"><span>•</span> Home Financing</li>
            </ul>
        </div>

        <div class="group p-10 bg-slate-900 rounded-[2.5rem] shadow-xl hover:shadow-2xl transition-all duration-500">
            <div class="w-16 h-16 bg-blue-500 text-white rounded-2xl flex items-center justify-center mb-8 -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-white">Full-Spectrum Insurance</h3>
            <ul class="space-y-3 text-slate-400">
                <li class="flex items-center gap-2"><span>•</span> Life & Health Coverage</li>
                <li class="flex items-center gap-2"><span>•</span> Motor Vehicle Insurance</li>
                <li class="flex items-center gap-2"><span>•</span> Mutual Fund Investments</li>
            </ul>
        </div>

        <div class="group p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-blue-500 transition-all duration-500">
            <div class="w-16 h-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mb-8 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 21l3-1 3 1-.75-4M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-slate-900">Digital Growth</h3>
            <ul class="space-y-3 text-slate-500">
                <li class="flex items-center gap-2"><span>•</span> Marketing & Course Selling</li>
                <li class="flex items-center gap-2"><span>•</span> Mobile & DTH Recharge</li>
                <li class="flex items-center gap-2"><span>•</span> Travel & Hotel Booking</li>
            </ul>
        </div>
    </div>
</section>

<section class="mb-32 reveal bg-slate-50 rounded-[3rem] p-12 md:p-20">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div>
            <h2 class="text-4xl font-bold text-slate-900 mb-6 leading-tight">Bank-Grade Security for Your Peace of Mind</h2>
            <div class="space-y-6 text-slate-600">
                <div class="flex gap-4">
                    <div class="shrink-0 w-6 h-6 text-emerald-500">✓</div>
                    <p><span class="font-bold text-slate-800">256-Bit Encryption:</span> Your data and documents are protected by industry-leading security protocols.</p>
                </div>
                <div class="flex gap-4">
                    <div class="shrink-0 w-6 h-6 text-emerald-500">✓</div>
                    <p><span class="font-bold text-slate-800">Privacy First:</span> We never share your personal information with third-party marketers.</p>
                </div>
                <div class="flex gap-4">
                    <div class="shrink-0 w-6 h-6 text-emerald-500">✓</div>
                    <p><span class="font-bold text-slate-800">Verified Providers:</span> Every service on our platform is sourced from vetted, premium institutions.</p>
                </div>
            </div>
        </div>
        <div class="relative flex justify-center">
            <div class="w-64 h-80 bg-blue-600 rounded-3xl shadow-2xl relative rotate-3 flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                <svg class="w-24 h-24 text-white opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
            </div>
            <div class="absolute -bottom-6 -left-6 w-48 h-48 glass-card rounded-2xl -rotate-6 flex flex-col items-center justify-center p-6 shadow-xl">
                 <div class="text-emerald-500 text-3xl font-black mb-1">SECURE</div>
                 <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-none">Verified by HERNEST</div>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-br from-blue-700 to-indigo-900 rounded-[3rem] p-12 md:p-24 text-center text-white mb-20 relative overflow-hidden reveal">
    <div class="relative z-10">
        <h2 class="text-4xl md:text-5xl font-black mb-8 leading-tight">Ready to transform your<br>Service Distribution?</h2>
        <div class="flex flex-wrap justify-center gap-6">
            <a href="services.php" class="px-12 py-5 bg-white text-blue-700 font-bold rounded-2xl hover:scale-105 transition-transform">
                Get Started Now
            </a>
        </div>
    </div>
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-white opacity-10 rounded-full"></div>
    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-blue-400 opacity-20 rounded-full"></div>
</section>

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(section => {
        observer.observe(section);
    });
</script>

<?php require 'partials/footer.php'; ?>