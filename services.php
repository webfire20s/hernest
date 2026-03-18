<?php
require 'includes/db.php';
require 'partials/header.php';

// Logic remains untouched
$stmt = $pdo->query("
    SELECT id, service_name, description, image
    FROM services
    WHERE is_active = 1
    ORDER BY id DESC
");
$services = $stmt->fetchAll();
?>

<style>
    :root {
        --accent: #2563eb;
        --slate-900: #0f172a;
    }

    /* --- Luxury Animation Engine --- */
    .reveal { opacity: 0; transform: translateY(30px); transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1); }
    .reveal.active { opacity: 1; transform: translateY(0); }
    
    /* Breaking the "Basic" Card */
    .service-card {
        position: relative;
        background: #ffffff;
        border: 1px solid #f1f5f9;
        transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        z-index: 1;
    }
    
    .service-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--accent) 0%, #1d4ed8 100%);
        border-radius: inherit;
        z-index: -1;
        opacity: 0;
        transition: all 0.6s ease;
        transform: scale(0.95);
    }

    .service-card:hover {
        transform: translateY(-15px);
        border-color: transparent;
    }

    .service-card:hover::after {
        opacity: 1;
        transform: scale(1);
        box-shadow: 0 40px 80px -15px rgba(37, 99, 235, 0.35);
    }

    .service-card:hover h3, 
    .service-card:hover p,
    .service-card:hover .label-tag {
        color: #ffffff !important;
    }

    /* Floating Background Text */
    .bg-text {
        position: absolute;
        font-size: 20rem;
        font-weight: 900;
        color: #f8fafc;
        z-index: -1;
        user-select: none;
        top: -50px;
        left: -20px;
        line-height: 1;
    }

    /* Refined Filter Buttons */
    .filter-btn {
        position: relative;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        transition: all 0.4s ease;
    }

    .filter-btn.active {
        background: var(--slate-900);
        color: #ffffff;
        border-color: var(--slate-900);
        box-shadow: 0 15px 30px -8px rgba(15, 23, 42, 0.3);
    }

    .image-container {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .image-container::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.4), transparent);
    }
</style>

<section class="relative pt-40 pb-24 overflow-hidden bg-white">
    <div class="bg-text">ASSETS</div>
    <div class="max-w-7xl mx-auto px-6 text-center reveal">
        <div class="inline-block px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-8">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600">Digital Infrastructure</span>
        </div>
        <h1 class="text-7xl md:text-9xl font-black text-slate-900 tracking-tightest leading-[0.85] mb-12">
            The Service <br><span class="text-blue-600">Stack.</span>
        </h1>
        
        <div class="flex flex-wrap justify-center gap-3 mt-14 max-w-6xl mx-auto">
            <button onclick="filterServices('all', this)" class="filter-btn active px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">All</button>
            <button onclick="filterServices('financial', this)" class="filter-btn px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">Financial</button>
            <button onclick="filterServices('insurance', this)" class="filter-btn px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">Insurance</button>
            <button onclick="filterServices('investment', this)" class="filter-btn px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">Investment</button>
            <button onclick="filterServices('payments', this)" class="filter-btn px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">Payments</button>
            <button onclick="filterServices('travel', this)" class="filter-btn px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">Travel</button>
            <button onclick="filterServices('selling', this)" class="filter-btn px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">Selling</button>
            <button onclick="filterServices('tech', this)" class="filter-btn px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">Tech</button>
        </div>
    </div>
</section>

<section class="pb-40 px-6 max-w-[1500px] mx-auto">
    <?php if($services): ?>
        <div id="servicesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php foreach($services as $service): 
                $name = strtolower($service['service_name']);
                
                // --- CATEGORY MAPPING LOGIC (UNCHANGED) ---
                if (preg_match('/loan|credit card|saving account|bank/', $name)) {
                    $category = 'financial'; $label = 'Financial Services';
                } elseif (preg_match('/insurance|policy|health/', $name)) {
                    $category = 'insurance'; $label = 'Insurance Services';
                } elseif (preg_match('/mutual fund|sip|share|trading|investment/', $name)) {
                    $category = 'investment'; $label = 'Investment & Growth';
                } elseif (preg_match('/recharge|dth|payment/', $name)) {
                    $category = 'payments'; $label = 'Digital & Payments';
                } elseif (preg_match('/travel|flight|hotel|tour/', $name)) {
                    $category = 'travel'; $label = 'Tours & Travel';
                } elseif (preg_match('/product|selling|ecommerce|distribution/', $name)) {
                    $category = 'selling'; $label = 'Product Selling';
                } else {
                    $category = 'tech'; $label = 'Tech & Marketing';
                }
            ?>
            <div class="service-card reveal p-10 rounded-[3rem] flex flex-col h-full group" data-category="<?= $category ?>">
                
                <?php if (!empty($service['image'])): ?>
                <div class="image-container h-48">
                    <img src="uploads/services/<?= htmlspecialchars($service['image']) ?>" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <?php endif; ?>
                
                <h3 class="text-3xl font-black text-slate-900 mb-4 tracking-tighter transition-colors duration-500">
                    <?= htmlspecialchars($service['service_name']) ?>
                </h3>
                
                <p class="text-slate-500 text-lg leading-relaxed mb-10 flex-grow transition-colors duration-500">
                    <?= htmlspecialchars($service['description']) ?>
                </p>
                
                <div class="mt-auto pt-8 border-t border-slate-100 flex justify-between items-center transition-colors duration-500">
                    <span class="label-tag text-[11px] font-black uppercase tracking-widest text-blue-600 bg-blue-50 px-4 py-1.5 rounded-full border border-blue-100">
                        <?= $label ?>
                    </span>
                    <a href="contact.php?id=<?= $service['id'] ?>" class="w-14 h-14 bg-slate-950 text-white rounded-full flex items-center justify-center hover:bg-white hover:text-blue-600 transition-all shadow-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Instant Filter Logic (UNTOUCHED)
    function filterServices(category, btn) {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const cards = document.querySelectorAll('.service-card');
        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category) {
                card.style.display = 'flex';
                card.classList.add('active');
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

<?php require 'partials/footer.php'; ?>