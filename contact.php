<?php
require 'includes/db.php';
require 'partials/header.php';

$message_sent = false; // Internal flag for UI styling only
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name,email,message) VALUES (?,?,?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['message']
    ]);
    $message_sent = true;
}
?>

<style>
    .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .form-input { 
        width: 100%;
        padding: 1rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    .form-input:focus {
        background: #ffffff;
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }
</style>

<section class="py-12 reveal">
    <div class="max-w-5xl mx-auto">
        
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-4">Get in Touch</h2>
            <p class="text-slate-500 text-lg">Have questions about our 15+ services? Our team is here to help.</p>
        </div>

        <?php if($message_sent): ?>
            <div class="mb-10 p-6 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 flex items-center gap-4 animate-bounce">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0"></path></svg>
                <p class="font-bold text-lg">Message sent successfully. We'll get back to you soon!</p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-start">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="p-8 bg-slate-900 rounded-[2rem] text-white shadow-xl">
                    <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-slate-400 text-xs uppercase font-bold tracking-widest">Email Us</p>
                                <p class="text-lg">support@hernest.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-slate-400 text-xs uppercase font-bold tracking-widest">Office</p>
                                <p class="text-lg">Financial District, Suite 400</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-blue-50 border border-blue-100 rounded-[2rem]">
                    <h4 class="font-bold text-blue-900 mb-2">24/7 Support</h4>
                    <p class="text-blue-700 text-sm leading-relaxed">Our distribution partners receive priority support. Login to your dashboard for live chat options.</p>
                </div>
            </div>

            <div class="lg:col-span-3 bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                <form method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Your Name</label>
                            <input type="text" name="name" class="form-input" placeholder="Yor Name" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Your Email</label>
                            <input type="email" name="email" class="form-input" placeholder="Your Email" required>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Message</label>
                        <textarea name="message" rows="5" class="form-input" placeholder="How can we help you with our services?" required></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-slate-900 hover:-translate-y-1 transition-all">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </div>
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