<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

$service_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$service_id) {
    header("Location: services.php");
    exit;
}

// Fetch Service details for the header (Minimal logic addition for UX)
$serviceInfo = $pdo->prepare("SELECT service_name FROM services WHERE id = ?");
$serviceInfo->execute([$service_id]);
$serviceName = $serviceInfo->fetchColumn();

$roles = $pdo->query("
    SELECT id, role_name FROM roles ORDER BY hierarchy_level ASC
")->fetchAll();

$successMsg = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['commission'] as $role_id => $data) {
        $type = $data['type'];
        $value = $data['value'];

        $stmt = $pdo->prepare("
            INSERT INTO service_commissions
            (service_id, role_id, commission_type, commission_value)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                commission_type = VALUES(commission_type),
                commission_value = VALUES(commission_value)
        ");
        $stmt->execute([$service_id, $role_id, $type, $value]);
    }
    $successMsg = true;
}
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .config-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .role-row { transition: all 0.2s; border-bottom: 1px solid #f1f5f9; }
        .role-row:hover { background-color: #f8fafc; }
        .modern-select { 
            appearance: none; background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px 35px 10px 15px; 
            border-radius: 10px; font-size: 0.875rem; font-weight: 600; color: #475569;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;
        }
        .modern-input { 
            background: white; border: 1px solid #e2e8f0; padding: 10px 15px; 
            border-radius: 10px; font-size: 0.875rem; font-weight: 700; color: #1e293b; width: 120px;
        }
        .modern-input:focus { border-color: #4f46e5; outline: none; ring: 3px rgba(79, 70, 229, 0.1); }
    </style>
</head>

<div class="admin-main">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-8 flex justify-between items-center">
            <div>
                <a href="services.php" class="text-xs font-bold text-indigo-600 uppercase tracking-widest flex items-center gap-2 mb-2 hover:text-indigo-800">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Services List
                </a>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Commission Structure</h2>
                <p class="text-slate-500 text-sm mt-1">Defining payouts for <span class="text-indigo-600 font-bold"><?= htmlspecialchars($serviceName) ?></span></p>
            </div>
            
            <?php if($successMsg): ?>
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-4 py-2 rounded-xl text-xs font-bold animate-bounce">
                ✓ Settings Updated
            </div>
            <?php endif; ?>
        </div>

        <form method="POST" class="config-card">
            <div class="overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-bold text-slate-400 uppercase tracking-widest border-bottom border-slate-100">
                            <th class="pb-4 px-2">Access Role</th>
                            <th class="pb-4 px-2">Calculation Type</th>
                            <th class="pb-4 px-2">Commission Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($roles as $role): ?>
                        <tr class="role-row">
                            <td class="py-5 px-2">
                                <span class="font-bold text-slate-700"><?= $role['role_name'] ?></span>
                            </td>
                            <td class="py-5 px-2">
                                <select name="commission[<?= $role['id'] ?>][type]" class="modern-select">
                                    <option value="fixed">Fixed (₹)</option>
                                    <option value="percentage">Percentage (%)</option>
                                </select>
                            </td>
                            <td class="py-5 px-2">
                                <div class="flex items-center gap-3">
                                    <input type="number" step="0.01" 
                                           name="commission[<?= $role['id'] ?>][value]" 
                                           class="modern-input" 
                                           placeholder="0.00" required>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-10 rounded-xl shadow-lg transition-all transform active:scale-95 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Save Commission Policy
                </button>
            </div>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>