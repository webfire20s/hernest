<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Logic Preserved: POST Handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['base_price'];

    $stmt = $pdo->prepare("
        INSERT INTO services (service_name, description, base_price)
        VALUES (?, ?, ?)
    ");
    $stmt->execute([$name, $description, $price]);

    header("Location: services.php");
    exit;
}
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .form-container { max-width: 650px; margin: 0 auto; }
        .service-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 40px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        
        .field-label { display: block; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
        .modern-input { 
            width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; 
            font-size: 0.95rem; color: #1e293b; background: #fcfcfd; transition: all 0.2s;
        }
        .modern-input:focus { outline: none; border-color: #4f46e5; background: white; ring: 4px; ring-color: rgba(79, 70, 229, 0.1); }
    </style>
</head>

<div class="admin-main">
    <div class="form-container">
        <div class="mb-8">
            <a href="services.php" class="text-xs font-bold text-indigo-600 uppercase tracking-widest flex items-center gap-2 mb-2 hover:text-indigo-800 transition-colors">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to Services
            </a>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Add New Service</h2>
            <p class="text-slate-500 text-sm mt-1">Define a new financial product to be offered across your network.</p>
        </div>

        <form method="POST" class="service-card">
            <div class="space-y-6">
                <div>
                    <label class="field-label">Service Name</label>
                    <input type="text" name="service_name" class="modern-input" placeholder="e.g. Personal Loan Premium" required>
                </div>

                <div>
                    <label class="field-label">Description / Features</label>
                    <textarea name="description" rows="5" class="modern-input" placeholder="Outline the benefits, eligibility, and core features..."></textarea>
                </div>

                <div class="max-w-xs">
                    <label class="field-label">Initial Base Price</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-slate-400">₹</span>
                        <input type="number" step="0.01" name="base_price" class="modern-input pl-8" placeholder="0.00" required>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-[10px] text-slate-400 max-w-[200px] leading-relaxed">
                        Note: Once created, you will need to set up the <b>Commission Structure</b> for this service.
                    </p>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-indigo-100 transition-all transform active:scale-95 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Create Service
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>