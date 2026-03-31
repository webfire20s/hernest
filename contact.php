<?php
require 'includes/db.php';
require 'partials/header.php';

$message_sent = false; 

// Fetch services for dropdown
$services = $pdo->query("SELECT id, service_name FROM services WHERE is_active = 1")->fetchAll();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = $_POST['name'];
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $phone = $_POST['phone'];
    $city = $_POST['city'] ?? null;
    $state = $_POST['state'] ?? null;
    $country = $_POST['country'] ?? 'India';
    $service_id = $_POST['service_id'] ?? null;
    $message = $_POST['message'];

    $stmt = $pdo->prepare("
        INSERT INTO contact_messages 
        (name, email, message, phone, city, state, country, service_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $name,
        $email,
        $message,
        $phone,
        $city,
        $state,
        $country,
        $service_id
    ]);

    $message_sent = true;
}

?>

<style>
    :root {
        --primary: #2563eb;
        --dark-bg: #0f172a;
    }

    /* --- Sophisticated Motion --- */
    .reveal { opacity: 0; transform: translateY(30px); transition: all 1s cubic-bezier(0.16, 1, 0.3, 1); }
    .reveal.active { opacity: 1; transform: translateY(0); }

    /* Floating Background Elements */
    .blob {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
        z-index: -1;
        filter: blur(60px);
    }

    /* Form Modernization */
    .form-input { 
        width: 100%;
        padding: 1.25rem;
        background: #fdfdfe;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 500;
    }
    .form-input:focus {
        background: #ffffff;
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.15);
        transform: translateY(-2px);
    }

    /* Glass Info Card */
    .info-card {
        background: var(--dark-bg);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .info-card::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%; width: 200%; height: 200%;
        background: radial-gradient(circle at center, rgba(37, 99, 235, 0.15) 0%, transparent 50%);
        pointer-events: none;
    }

    .status-pulse {
        width: 10px;
        height: 10px;
        background: #10b981;
        border-radius: 50%;
        position: relative;
    }
    .status-pulse::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        border: 2px solid #10b981;
        animation: pulse-out 2s infinite;
    }
    @keyframes pulse-out {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(2.5); opacity: 0; }
    }
</style>

<section class="relative py-16 md:py-32 overflow-hidden bg-white">
    <div class="blob top-0 -left-10 md:-left-20 w-40 h-40 md:w-80 md:h-80"></div>
    <div class="blob bottom-0 -right-10 md:-right-20 w-40 h-40 md:w-80 md:h-80"></div>

    <div class="max-w-7xl mx-auto px-4 md:px-6">
        
        <div class="text-center mb-12 md:mb-24 reveal">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 mb-6">
                <div class="status-pulse"></div>
                <span class="text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] text-blue-600">Response Time: &lt; 2 Hours</span>
            </div>
            <h1 class="text-5xl sm:text-6xl md:text-8xl lg:text-9xl font-black text-slate-900 tracking-tightest leading-[1.1] md:leading-[0.85] mb-6 md:mb-8">
                Connect. <br><span class="text-blue-600">Collaborate.</span>
            </h1>
            <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed px-2">
                Have questions about our 15+ services? Our team is here to help you scale your digital infrastructure.
            </p>
        </div>

        <?php if($message_sent): ?>
            <div class="max-w-4xl mx-auto mb-12 md:mb-16 p-6 md:p-8 bg-emerald-50 border border-emerald-100 rounded-[2rem] md:rounded-[2.5rem] text-emerald-800 flex flex-col sm:flex-row items-center gap-4 md:gap-6 animate-in slide-in-from-top duration-700 text-center sm:text-left">
                <div class="w-12 h-12 md:w-14 md:h-14 bg-emerald-500 text-white rounded-xl md:rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-emerald-200">
                    <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.6" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="text-xl md:text-2xl font-black tracking-tight">Transmission Received.</p>
                    <p class="text-sm md:text-base font-medium opacity-80">Message sent successfully. We'll get back to you soon!</p>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <div class="lg:col-span-4 flex flex-col gap-6 reveal">
                <div class="info-card p-8 md:p-10 rounded-[2.5rem] md:rounded-[3rem] text-white shadow-2xl flex-grow bg-slate-900">
                    <h3 class="text-2xl md:text-3xl font-black mb-8 md:mb-10 tracking-tight">Global Reach. <br><span class="text-blue-500">Local Support.</span></h3>
                    
                    <div class="space-y-8 md:space-y-10">
                        <div class="group cursor-pointer">
                            <p class="text-slate-500 text-[9px] md:text-[10px] uppercase font-black tracking-widest mb-1 md:mb-2 group-hover:text-blue-400 transition-colors">Direct Terminal</p>
                            <p class="text-lg md:text-xl font-bold break-words">info@hernestworld.com</p>
                        </div>

                        <div class="group cursor-pointer">
                            <p class="text-slate-500 text-[9px] md:text-[10px] uppercase font-black tracking-widest mb-1 md:mb-2 group-hover:text-blue-400 transition-colors">Hotline</p>
                            <p class="text-lg md:text-xl font-bold">+91 9829008838</p>
                        </div>

                        <div class="group cursor-pointer">
                            <p class="text-slate-500 text-[9px] md:text-[10px] uppercase font-black tracking-widest mb-1 md:mb-2 group-hover:text-blue-400 transition-colors">Headquarters</p>
                            <p class="text-base md:text-lg font-medium leading-relaxed">4 k 3 Pratap Nagar <br>Jodhpur - 342003</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 bg-slate-50 p-6 sm:p-10 md:p-16 rounded-[2.5rem] md:rounded-[4rem] border border-slate-100 reveal" style="transition-delay: 0.3s;">
                <form method="POST" class="space-y-6 md:space-y-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        <div>
                            <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 md:mb-3 ml-2">Full Name</label>
                            <input type="text" name="name" class="form-input w-full p-4 rounded-xl border-slate-200" placeholder="Your Name" required>
                        </div>

                        <div>
                            <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 md:mb-3 ml-2">Phone Number</label>
                            <input type="text" name="phone" class="form-input w-full p-4 rounded-xl border-slate-200" placeholder="Your Phone Number" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 md:mb-3 ml-2">Email Address (Optional)</label>
                        <input type="email" name="email" class="form-input w-full p-4 rounded-xl border-slate-200" placeholder="Your Email">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                        <div>
                            <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 md:mb-3 ml-2">City</label>
                            <input type="text" name="city" class="form-input w-full p-4 rounded-xl border-slate-200" placeholder="City">
                        </div>

                        <div>
                            <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 md:mb-3 ml-2">State</label>
                            <input type="text" name="state" class="form-input w-full p-4 rounded-xl border-slate-200" placeholder="State">
                        </div>

                        <div class="sm:col-span-2 md:col-span-1">
                            <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 md:mb-3 ml-2">Country</label>
                            <input type="text" name="country" value="India" class="form-input w-full p-4 rounded-xl border-slate-200">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 md:mb-3 ml-2">What are you looking for?</label>
                        <select name="service_id" class="form-input w-full p-4 rounded-xl border-slate-200 bg-white">
                            <option value="">Select a Service</option>
                            <?php foreach($services as $service): ?>
                                <option value="<?= $service['id'] ?>">
                                    <?= htmlspecialchars($service['service_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 md:mb-3 ml-2">How can we help?</label>
                        <textarea name="message" rows="5" class="form-input w-full p-4 rounded-xl border-slate-200" placeholder="Describe your requirement..." required></textarea>
                    </div>

                    <button type="submit" class="group relative w-full py-5 bg-slate-900 text-white font-black rounded-2xl overflow-hidden transition-all hover:bg-blue-600 hover:shadow-2xl hover:shadow-blue-300">
                        <span class="relative z-10 flex items-center justify-center gap-3">
                            Submit Request
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                    </button>

                </form>
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