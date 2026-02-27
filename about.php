<?php require 'partials/header.php'; ?>

<style>
    .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .stat-card:hover { transform: translateY(-5px); border-color: #3b82f6; }
</style>

<section class="py-20 text-center reveal">
    <h1 class="text-5xl md:text-6xl font-black text-slate-900 mb-6 tracking-tight">
        Behind the <span class="text-blue-600">Platform</span>
    </h1>
    <div class="w-24 h-1.5 bg-blue-600 mx-auto mb-8 rounded-full"></div>
    <p class="max-w-3xl mx-auto text-xl text-slate-600 leading-relaxed">
        HERNEST is a multi-level distribution and commission management platform designed to bridge the gap between premium financial products and the people who need them.
    </p>
</section>

<section class="mb-32 reveal">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-8 bg-white border border-slate-100 rounded-3xl shadow-sm stat-card transition-all duration-300">
            <div class="text-blue-600 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Integrity First</h3>
            <p class="text-slate-500 text-sm">Transparency in every commission, every loan, and every digital transaction.</p>
        </div>
        <div class="p-8 bg-white border border-slate-100 rounded-3xl shadow-sm stat-card transition-all duration-300">
            <div class="text-blue-600 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Hyper-Speed</h3>
            <p class="text-slate-500 text-sm">Real-time distribution tracking and automated service fulfillment.</p>
        </div>
        <div class="p-8 bg-white border border-slate-100 rounded-3xl shadow-sm stat-card transition-all duration-300">
            <div class="text-blue-600 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Network Growth</h3>
            <p class="text-slate-500 text-sm">Built to scale. We empower distributors to build their own multi-level ecosystems.</p>
        </div>
    </div>
</section>

<section class="mb-32 reveal bg-slate-50 p-12 rounded-[3rem]">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold">The HERNEST Ecosystem</h2>
    </div>
    <div class="space-y-12">
        <div class="flex flex-col md:flex-row gap-8 items-center">
            <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-2xl shrink-0 shadow-lg">1</div>
            <div>
                <h4 class="text-xl font-bold mb-1 text-slate-900">Aggregated Sourcing</h4>
                <p class="text-slate-600">We partner with top-tier banks, insurers, and digital providers to bring 15+ services under one roof.</p>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-8 items-center">
            <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-2xl shrink-0 shadow-lg">2</div>
            <div>
                <h4 class="text-xl font-bold mb-1 text-slate-900">Multi-Level Distribution</h4>
                <p class="text-slate-600">Our proprietary logic handles complex distribution hierarchies, ensuring everyone gets paid on time.</p>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-8 items-center">
            <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-2xl shrink-0 shadow-lg">3</div>
            <div>
                <h4 class="text-xl font-bold mb-1 text-slate-900">Seamless Management</h4>
                <p class="text-slate-600">User-friendly dashboards for tracking recharges, loan approvals, and marketing course sales.</p>
            </div>
        </div>
    </div>
</section>

<section class="mb-32 reveal px-6">
    <div class="max-w-5xl mx-auto bg-slate-900 rounded-[2.5rem] overflow-hidden flex flex-col md:flex-row items-center">
        <div class="w-full md:w-1/3 h-64 bg-slate-800 flex items-center justify-center text-slate-500">
           <svg class="w-20 h-20 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        </div>
        <div class="w-full md:w-2/3 p-12 text-white">
            <h3 class="text-2xl font-bold mb-4">"Our goal is to democratize financial services through technology."</h3>
            <p class="text-slate-400 italic mb-6">"At HERNEST, we don't just sell products; we create opportunities for entrepreneurs to thrive in the digital economy."</p>
            <p class="font-bold text-blue-400">— The Leadership Team</p>
        </div>
    </div>
</section>

<section class="mb-20 reveal grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
    <div>
        <div class="text-4xl font-black text-slate-900 mb-1">2026</div>
        <p class="text-xs uppercase tracking-widest text-slate-500 font-bold">Innovation Year</p>
    </div>
    <div>
        <div class="text-4xl font-black text-slate-900 mb-1">15+</div>
        <p class="text-xs uppercase tracking-widest text-slate-500 font-bold">Service Verticals</p>
    </div>
    <div>
        <div class="text-4xl font-black text-slate-900 mb-1">99.9%</div>
        <p class="text-xs uppercase tracking-widest text-slate-500 font-bold">System Uptime</p>
    </div>
    <div>
        <div class="text-4xl font-black text-slate-900 mb-1">Secure</div>
        <p class="text-xs uppercase tracking-widest text-slate-500 font-bold">Data Privacy</p>
    </div>
</section>

<section class="reveal py-16 border-t border-slate-100 text-center">
    <h2 class="text-3xl font-bold mb-6 text-slate-900">Ready to see what we offer?</h2>
    <a href="services.php" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition-all">
        Browse Our Services
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </a>
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