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

<section class="relative py-32 overflow-hidden bg-white">
    <div class="blob top-0 -left-20"></div>
    <div class="blob bottom-0 -right-20"></div>

    <div class="max-w-7xl mx-auto px-6">
        
        <div class="text-center mb-24 reveal">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 mb-6">
                <div class="status-pulse"></div>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600">Response Time: < 2 Hours</span>
            </div>
            <h1 class="text-7xl md:text-9xl font-black text-slate-900 tracking-tightest leading-[0.85] mb-8">
                Connect. <br><span class="text-blue-600">Collaborate.</span>
            </h1>
            <p class="text-slate-500 text-xl font-medium max-w-2xl mx-auto leading-relaxed">
                Have questions about our 15+ services? Our team is here to help you scale your digital infrastructure.
            </p>
        </div>

        <?php if($message_sent): ?>
            <div class="max-w-4xl mx-auto mb-16 p-8 bg-emerald-50 border border-emerald-100 rounded-[2.5rem] text-emerald-800 flex items-center gap-6 animate-in slide-in-from-top duration-700">
                <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-emerald-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.6" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="text-2xl font-black tracking-tight">Transmission Received.</p>
                    <p class="font-medium opacity-80">Message sent successfully. We'll get back to you soon!</p>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <div class="lg:col-span-4 flex flex-col gap-6 reveal">
                <div class="info-card p-10 rounded-[3rem] text-white shadow-2xl flex-grow">
                    <h3 class="text-3xl font-black mb-10 tracking-tight">Global Reach. <br><span class="text-blue-500">Local Support.</span></h3>
                    
                    <div class="space-y-10">
                        <div class="group cursor-pointer">
                            <p class="text-slate-500 text-[10px] uppercase font-black tracking-widest mb-2 group-hover:text-blue-400 transition-colors">Direct Terminal</p>
                            <p class="text-xl font-bold">info@hernestworld.com</p>
                        </div>

                        <div class="group cursor-pointer">
                            <p class="text-slate-500 text-[10px] uppercase font-black tracking-widest mb-2 group-hover:text-blue-400 transition-colors">Hotline</p>
                            <p class="text-xl font-bold">+91 9829008838</p>
                        </div>

                        <div class="group cursor-pointer">
                            <p class="text-slate-500 text-[10px] uppercase font-black tracking-widest mb-2 group-hover:text-blue-400 transition-colors">Headquarters</p>
                            <p class="text-lg font-medium leading-relaxed">4 k 3 Pratap Nagar <br>Jodhpur - 342003</p>
                        </div>
                    </div>
                </div>

                <!-- <div class="p-10 bg-blue-600 rounded-[3rem] text-white shadow-xl shadow-blue-200/50 reveal" style="transition-delay: 0.2s;">
                    <h4 class="text-xl font-black mb-4 italic">Institutional Support</h4>
                    <p class="text-blue-100 text-sm leading-relaxed font-medium opacity-90">Our distribution partners receive priority support. Login to your dashboard for live chat options.</p>
                </div> -->
            </div>

            <div class="lg:col-span-8 bg-slate-50 p-8 md:p-16 rounded-[4rem] border border-slate-100 reveal" style="transition-delay: 0.3s;">
                <form method="POST" class="space-y-8">

                    <!-- BASIC INFO -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Full Name</label>
                            <input type="text" name="name" class="form-input" placeholder="Your Name" required>
                        </div>

                        <div>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Phone Number</label>
                            <input type="text" name="phone" class="form-input" placeholder="Your Phone Number" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Email Address (Optional)</label>
                        <input type="email" name="email" class="form-input" placeholder="Your Email">
                    </div>

                    <!-- LOCATION -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">City</label>
                            <input type="text" name="city" class="form-input" placeholder="City">
                        </div>

                        <div>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">State</label>
                            <input type="text" name="state" class="form-input" placeholder="State">
                        </div>

                        <div>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Country</label>
                            <input type="text" name="country" value="India" class="form-input">
                        </div>
                    </div>

                    <!-- SERVICE DROPDOWN -->
                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">What are you looking for?</label>
                        <select name="service_id" class="form-input">
                            <option value="">Select a Service</option>
                            <?php foreach($services as $service): ?>
                                <option value="<?= $service['id'] ?>">
                                    <?= htmlspecialchars($service['service_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- MESSAGE -->
                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">How can we help?</label>
                        <textarea name="message" rows="6" class="form-input" placeholder="Describe your requirement..." required></textarea>
                    </div>

                    <!-- SUBMIT -->
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