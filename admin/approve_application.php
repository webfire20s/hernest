<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../includes/auth.php';

$appId = $_GET['id'];

$app = $pdo->prepare("SELECT * FROM partner_applications WHERE id=?");
$app->execute([$appId]);
$data = $app->fetch();

$parents = $pdo->prepare("
SELECT id, full_name
FROM users
ORDER BY full_name
");

$parents->execute();
$parents = $parents->fetchAll();

if($_SERVER['REQUEST_METHOD']=='POST'){

    $parent = $_POST['parent_id'];
    $applicationId = $_POST['application_id'];

    $insert = $pdo->prepare("
    INSERT INTO users
    (parent_id,role_id,full_name,email,password_hash)
    VALUES (?,?,?,?,?)
    ");

    $insert->execute([
        $parent,
        $data['requested_role_id'],
        $data['full_name'],
        $data['email'],
        $data['password_hash']
    ]);

    $pdo->prepare("
    UPDATE partner_applications
    SET status='approved'
    WHERE id=?
    ")->execute([$applicationId]);

    header("Location: applications.php");
    exit;
}
require '../includes/sidebar.php';

?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        /* Matched exactly to your Users and Applications theme */
        .admin-main { margin-left: 20px; padding: 5px; }
        .data-card { 
            background: white; 
            border-radius: 24px; 
            border: 1px solid #e2e8f0; 
            padding: 40px; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); 
            max-width: 600px; /* Kept focused for a single-form task */
        }
        .form-select {
            width: 100%; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;
            padding: 12px 16px; font-size: 14px; font-weight: 500; color: #1e293b;
            transition: all 0.2s ease; appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat; background-position: right 1rem center; background-size: 1em;
        }
        .form-select:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    </style>
</head>

<div class="admin-main">
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Finalize Approval</h2>
        <p class="text-slate-500 text-sm mt-1">Assign a parent distributor to complete the onboarding process.</p>
    </div>

    <div class="data-card">
        <form method="POST" class="space-y-6">
            <input type="hidden" name="application_id" value="<?= $appId ?>">

            <div class="space-y-2">
                <label class="text-[11px] uppercase font-bold text-slate-400 tracking-widest ml-1">
                    Select Parent Distributor
                </label>
                <select name="parent_id" class="form-select" required>
                    <option value="" disabled selected>Choose a distributor...</option>
                    <?php foreach($parents as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= htmlspecialchars($p['full_name']) ?> (ID: #<?= $p['id'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="text-[11px] text-slate-400 mt-2 px-1">
                    This user will manage the newly approved partner's commissions and hierarchy.
                </p>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-emerald-100 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Confirm & Approve User
                </button>
                
                <a href="applications.php" class="text-slate-400 hover:text-slate-600 font-bold text-sm transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>