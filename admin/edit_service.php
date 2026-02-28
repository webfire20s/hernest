<?php
require '../includes/middleware_admin.php';
require '../includes/header.php';
require '../includes/sidebar.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
$stmt->execute([$id]);
$service = $stmt->fetch();

if (!$service) {
    die("Service not found");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['service_name'];
    $desc = $_POST['description'];
    $price = $_POST['base_price'];
    $active = isset($_POST['is_active']) ? 1 : 0;

    $update = $pdo->prepare("
        UPDATE services
        SET service_name = ?, description = ?, base_price = ?, is_active = ?
        WHERE id = ?
    ");
    $update->execute([$name, $desc, $price, $active, $id]);

    header("Location: services.php");
    exit;
}
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .form-container { max-width: 700px; margin: 0 auto; }
        .editor-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 40px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        
        .field-label { display: block; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
        .modern-input { 
            width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; 
            font-size: 0.95rem; color: #1e293b; background: #fcfcfd; transition: all 0.2s;
        }
        .modern-input:focus { outline: none; border-color: #4f46e5; background: white; ring: 4px; ring-color: rgba(79, 70, 229, 0.1); }
        
        /* Modern Toggle Switch Styling */
        .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { 
            position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; 
            background-color: #e2e8f0; transition: .4s; border-radius: 24px; 
        }
        .slider:before { 
            position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; 
            background-color: white; transition: .4s; border-radius: 50%; 
        }
        input:checked + .slider { background-color: #4f46e5; }
        input:checked + .slider:before { transform: translateX(20px); }
    </style>
</head>

<div class="admin-main">
    <div class="form-container">
        <div class="mb-8 flex justify-between items-end">
            <div>
                <a href="services.php" class="text-xs font-bold text-indigo-600 uppercase tracking-widest flex items-center gap-2 mb-2 hover:text-indigo-800 transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Service Inventory
                </a>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Edit Service</h2>
                <p class="text-slate-500 text-sm mt-1">Update service pricing and visibility across the partner network.</p>
            </div>
            <div class="text-right pb-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Service ID</span>
                <p class="font-mono font-bold text-slate-900">#<?= $service['id'] ?></p>
            </div>
        </div>

        <form method="POST" class="editor-card">
            <div class="space-y-6">
                <div>
                    <label class="field-label">Service Title</label>
                    <input type="text" name="service_name" class="modern-input" 
                        value="<?= htmlspecialchars($service['service_name']) ?>" required>
                </div>

                <div>
                    <label class="field-label">Service Description</label>
                    <textarea name="description" rows="4" class="modern-input" 
                        placeholder="Detail the service benefits..."><?= htmlspecialchars($service['description']) ?></textarea>
                </div>

                <div class="max-w-xs">
                    <label class="field-label">Base Price (₹)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-slate-400">₹</span>
                        <input type="number" step="0.01" name="base_price" class="modern-input pl-8" 
                            value="<?= $service['base_price'] ?>" required>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div>
                            <p class="text-sm font-bold text-slate-800">Publishing Status</p>
                            <p class="text-[11px] text-slate-500">Allow partners to submit leads for this service.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="is_active" <?= $service['is_active'] ? 'checked' : '' ?>>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-4">
                    <a href="services.php" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">Cancel</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-100 transition-all transform active:scale-95">
                        Update Service
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>