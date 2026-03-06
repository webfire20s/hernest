<?php
require 'includes/db.php';
require 'partials/header.php';

// Logic remains untouched
$stmt = $pdo->query("
    SELECT id, service_name, description
    FROM services
    WHERE is_active = 1
    ORDER BY id DESC
");
$services = $stmt->fetchAll();
?>

<style>
    .reveal { opacity: 0; transform: translateY(30px); transition: all 0.7s ease-out; }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
    .service-card:hover .icon-bounce { transform: scale(1.1) rotate(5deg); }

    /* Razorpay Button Styling */
    .btn-pay {
        background: #10b981; /* Emerald Green for trust/payment */
        color: white;
        padding: 10px 20px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    .btn-pay:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
    }
</style>

<section class="relative py-20 overflow-hidden reveal">
    <div class="relative z-10 text-center">
        <span class="px-4 py-1 text-sm font-bold bg-blue-100 text-blue-700 rounded-full uppercase tracking-widest">Our Portfolio</span>
        <h2 class="text-5xl md:text-7xl font-black text-slate-900 mt-6 mb-6 tracking-tighter">
            Solutions for <span class="text-blue-600">Every Need.</span>
        </h2>
        <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">
            From financial freedom to digital excellence, explore our 15+ specialized services designed to empower your journey.
        </p>
    </div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:20px_20px] opacity-30 -z-10"></div>
</section>

<section class="mb-32">
    <?php if($services): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php foreach($services as $service): ?>
                <div class="service-card reveal group bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 hover:border-blue-500 transition-all duration-500">
                    <div class="icon-bounce w-16 h-16 bg-slate-900 text-white rounded-2xl flex items-center justify-center mb-8 transition-transform duration-300 shadow-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors">
                        <?= htmlspecialchars($service['service_name']) ?>
                    </h3>
                    
                    <p class="text-slate-500 leading-relaxed mb-8">
                        <?= htmlspecialchars($service['description']) ?>
                    </p>
                    
                    <div class="mt-auto pt-6 border-t border-slate-50 flex justify-between items-center">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Premium Service</span>
                        <a href="https://razorpay.me/@krantikumarjain" target="_blank" class="btn-pay flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            Pay Now
                        </a>
                        <a href="contact.php?id=<?= $service['id'] ?>" class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-900 hover:bg-blue-600 hover:text-white transition-all">
                            →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-20 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200 reveal">
            <p class="text-xl font-medium text-slate-600">No services currently active.</p>
        </div>
    <?php endif; ?>
</section>

<section class="mb-32 bg-slate-900 rounded-[3rem] p-12 md:p-20 text-white reveal">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold mb-6 italic">"The gold standard in service distribution."</h2>
            <p class="text-slate-400 text-lg mb-8 leading-relaxed">
                Whether you are applying for a Business Loan or starting a Digital Marketing course, our platform ensures speed, security, and 100% transparency.
            </p>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-[10px]">✓</div>
                    <span>End-to-End Encryption on all Financial Data</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-[10px]">✓</div>
                    <span>Instant Commission Tracking for Partners</span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-slate-800 p-6 rounded-2xl text-center">
                <div class="text-3xl font-bold text-blue-400 mb-1">0%</div>
                <div class="text-xs text-slate-400 uppercase">Hidden Fees</div>
            </div>
            <div class="bg-slate-800 p-6 rounded-2xl text-center">
                <div class="text-3xl font-bold text-blue-400 mb-1">24/7</div>
                <div class="text-xs text-slate-400 uppercase">Support</div>
            </div>
            <div class="bg-slate-800 p-6 rounded-2xl text-center col-span-2">
                <div class="text-3xl font-bold text-blue-400 mb-1">Secure</div>
                <div class="text-xs text-slate-400 uppercase">Bank-Grade Infrastructure</div>
            </div>
        </div>
    </div>
</section>

<section class="mb-32 reveal">
    <div class="max-w-3xl mx-auto text-center mb-16">
        <h2 class="text-3xl font-bold text-slate-900 mb-4">Frequently Asked Questions</h2>
        <p class="text-slate-500">Quick answers to help you navigate our services.</p>
    </div>
    <div class="max-w-4xl mx-auto space-y-4">
        <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
            <h4 class="font-bold text-slate-900 mb-2 uppercase text-xs tracking-wider text-blue-600">Loans & Insurance</h4>
            <p class="text-slate-600">All loan and insurance applications are processed within 24-48 business hours with complete digital documentation.</p>
        </div>
        <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
            <h4 class="font-bold text-slate-900 mb-2 uppercase text-xs tracking-wider text-blue-600">Digital Services</h4>
            <p class="text-slate-600">Recharges and Travel bookings are instant. Digital marketing course access is granted immediately upon enrollment.</p>
        </div>
    </div>
</section>

<section class="text-center py-20 bg-blue-50 rounded-[3rem] mb-20 reveal">
    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Can't find what you're looking for?</h2>
    <p class="text-slate-600 mb-10 max-w-xl mx-auto">Our experts are available to provide personalized financial and digital consultations.</p>
    <a href="contact.php" class="px-12 py-5 bg-blue-600 text-white font-bold rounded-2xl hover:bg-slate-900 transition-all shadow-xl shadow-blue-200">
        Contact Expert Support
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

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

<?php require 'partials/footer.php'; ?>