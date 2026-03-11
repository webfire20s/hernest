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
    /* Premium Transitions & Animations */
    .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    .reveal.active { opacity: 1; transform: translateY(0); }
    
    .service-card {
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
    }
    
    .service-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.08);
        background: #ffffff;
    }

    /* Category Filter Styling - More Refined */
    .filter-btn { 
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #f1f5f9;
        color: #64748b;
    }
    .filter-btn:hover { background: #f8fafc; color: #0f172a; }
    .filter-btn.active { 
        background: #0f172a; 
        color: white; 
        border-color: #0f172a;
        box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.3);
    }
    
    .icon-box {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }

    /* Grid Background Effect */
    .bg-grid {
        background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
        background-size: 30px 30px;
    }
</style>

<section class="relative py-24 overflow-hidden reveal bg-white">
    <div class="absolute inset-0 bg-grid opacity-20 -z-10"></div>
    <div class="relative z-10 text-center px-4">
        <span class="px-5 py-2 text-xs font-black bg-blue-50 text-blue-600 rounded-full uppercase tracking-[0.2em] border border-blue-100 mb-8 inline-block">Explore Solutions</span>
        <h2 class="text-6xl md:text-8xl font-black text-slate-900 mt-4 mb-8 tracking-tightest">
            Empowering <span class="text-blue-600">Futures.</span>
        </h2>
        <p class="text-slate-500 max-w-3xl mx-auto text-xl leading-relaxed font-medium">
            Discover a curated suite of specialized financial and digital services meticulously crafted to accelerate your personal and professional growth.
        </p>
        
        <div class="flex flex-wrap justify-center gap-3 mt-14">
            <button onclick="filterServices('all', this)" class="filter-btn active px-10 py-4 rounded-2xl font-bold text-sm bg-white shadow-sm">All Services</button>
            <button onclick="filterServices('finance', this)" class="filter-btn px-10 py-4 rounded-2xl font-bold text-sm bg-white shadow-sm">Finance & Loans</button>
            <button onclick="filterServices('insurance', this)" class="filter-btn px-10 py-4 rounded-2xl font-bold text-sm bg-white shadow-sm">Insurance</button>
            <button onclick="filterServices('digital', this)" class="filter-btn px-10 py-4 rounded-2xl font-bold text-sm bg-white shadow-sm">Digital Growth</button>
        </div>
    </div>
</section>

<section class="mb-40 px-6 md:px-12 lg:px-20 max-w-[1600px] mx-auto">
    <?php if($services): ?>
        <div id="servicesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <?php foreach($services as $service): 
                $name = strtolower($service['service_name']);
                $category = 'digital';  
                $iconPath = 'M13 10V3L4 14h7v7l9-11h-7z'; // Default bolt icon
                
                if (strpos($name, 'loan') !== false || strpos($name, 'finance') !== false || strpos($name, 'fund') !== false || strpos($name, 'trading') !== false || strpos($name, 'bank') !== false) {
                    $category = 'finance';
                    $iconPath = 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
                } elseif (strpos($name, 'insurance') !== false || strpos($name, 'policy') !== false || strpos($name, 'health') !== false) {
                    $category = 'insurance';
                    $iconPath = 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z';
                }
            ?>
                <div class="service-card reveal group p-10 rounded-[3rem] border border-slate-100 flex flex-col h-full min-h-[440px]" data-category="<?= $category ?>">
                    
                    <div class="icon-box w-16 h-16 text-white rounded-[1.25rem] flex items-center justify-center mb-10 shrink-0 transition-transform duration-500 group-hover:rotate-[10deg] shadow-2xl shadow-slate-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $iconPath ?>"></path></svg>
                    </div>
                    
                    <h3 class="text-3xl font-black text-slate-900 mb-5 group-hover:text-blue-600 transition-colors tracking-tight leading-none">
                        <?= htmlspecialchars($service['service_name']) ?>
                    </h3>
                    
                    <p class="text-slate-500 text-lg leading-relaxed mb-10 flex-grow">
                        <?= htmlspecialchars($service['description']) ?>
                    </p>
                    
                    <div class="mt-auto pt-8 border-t border-slate-50 flex justify-between items-center">
                        <span class="text-[11px] font-black uppercase tracking-[0.2em] text-blue-600 bg-blue-50 px-4 py-1.5 rounded-full border border-blue-100/50">
                            <?= ucfirst($category) ?>
                        </span>
                        <a href="contact.php?id=<?= $service['id'] ?>" class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center text-slate-900 hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-blue-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-32 bg-slate-50 rounded-[4rem] border-2 border-dashed border-slate-200">
            <p class="text-2xl font-bold text-slate-400 italic">Curating New Solutions...</p>
        </div>
    <?php endif; ?>
</section>

<section class="mb-40 mx-4 md:mx-10 bg-slate-900 rounded-[4rem] p-12 md:p-24 text-white reveal relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-600 opacity-10 blur-[120px] -z-10"></div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div>
            <span class="text-blue-400 font-black tracking-widest uppercase text-xs mb-6 block">Why Partner With Us</span>
            <h2 class="text-4xl md:text-6xl font-black mb-8 leading-tight tracking-tighter">Uncompromising <br>Standard of Excellence.</h2>
            <p class="text-slate-400 text-xl mb-12 leading-relaxed font-medium">
                We don't just provide services; we engineer success. Our infrastructure is built on bank-grade security and instant automation.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="flex items-center gap-4 group">
                    <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-all">✓</div>
                    <span class="font-bold text-slate-200">Military-Grade Security</span>
                </div>
                <div class="flex items-center gap-4 group">
                    <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-all">✓</div>
                    <span class="font-bold text-slate-200">Zero Hidden Costs</span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <div class="bg-white/5 p-10 rounded-[2.5rem] backdrop-blur-md border border-white/10 hover:border-blue-500/50 transition-all">
                <div class="text-5xl font-black text-blue-500 mb-2">0%</div>
                <div class="text-sm text-slate-400 font-bold uppercase tracking-widest">Entry Fee</div>
            </div>
            <div class="bg-white/5 p-10 rounded-[2.5rem] backdrop-blur-md border border-white/10 hover:border-blue-500/50 transition-all">
                <div class="text-5xl font-black text-blue-500 mb-2">24/7</div>
                <div class="text-sm text-slate-400 font-bold uppercase tracking-widest">Elite Support</div>
            </div>
            <div class="bg-blue-600 p-10 rounded-[2.5rem] col-span-2 shadow-2xl shadow-blue-900/40">
                <div class="text-4xl font-black text-white mb-2 italic">Institutional Grade</div>
                <div class="text-sm text-blue-100 font-bold uppercase tracking-widest">Global Payout Infrastructure</div>
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
    // Reveal Observer Logic
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Instant Filter Logic
    function filterServices(category, btn) {
        // Update Buttons
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Filter Cards
        const cards = document.querySelectorAll('.service-card');
        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category) {
                card.style.display = 'flex';
                card.classList.add('active'); // Keep the reveal animation active
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

<?php require 'partials/footer.php'; ?>