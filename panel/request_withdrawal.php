<?php
require '../includes/auth.php';

if ($currentUser['hierarchy_level'] == 1) {
    header("Location: /admin/dashboard.php");
    exit;
}

// Calculate wallet dynamically (Original Logic Preserved)
$stmt = $pdo->prepare("
    SELECT IFNULL(SUM(commission_amount),0) 
    FROM commission_transactions 
    WHERE user_id = ? AND status = 'Credited'
");
$stmt->execute([$currentUser['id']]);
$totalCommission = $stmt->fetchColumn();

$stmt = $pdo->prepare("
    SELECT IFNULL(SUM(amount),0) 
    FROM withdrawals 
    WHERE user_id = ? AND status = 'Approved'
");
$stmt->execute([$currentUser['id']]);
$totalWithdrawn = $stmt->fetchColumn();

$walletBalance = $totalCommission - $totalWithdrawn;

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = floatval($_POST['amount']);
    if ($amount <= 0) {
        $message = "Invalid amount.";
    } elseif ($amount > $walletBalance) {
        $message = "Insufficient wallet balance.";
    } else {
        $insert = $pdo->prepare("
            INSERT INTO withdrawals (user_id, amount)
            VALUES (?, ?)
        ");
        $insert->execute([$currentUser['id'], $amount]);
        $message = "Withdrawal request submitted successfully.";
    }
}

require 'sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: sans-serif; }
        .main-content { margin-left: 260px; padding: 60px 40px; display: flex; justify-content: center; }
        .withdrawal-card { width: 100%; max-width: 500px; }
        .balance-hero {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 24px;
            padding: 32px;
            color: white;
            margin-bottom: -40px;
            position: relative;
            z-index: 10;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .form-box {
            background: white;
            border-radius: 24px;
            padding: 60px 32px 32px;
            border: 1px solid #e2e8f0;
        }
        .input-style {
            width: 100%;
            padding: 14px;
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            transition: all 0.2s;
        }
        .input-style:focus { outline: none; border-color: #2563eb; background: #fff; }
    </style>
</head>

<div class="main-content">
    <div class="withdrawal-card">
        
        <div class="balance-hero">
            <p class="text-blue-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Available for Payout</p>
            <h3 class="text-4xl font-bold tracking-tight">₹<?= number_format($walletBalance, 2) ?></h3>
            <div class="absolute right-8 top-1/2 -translate-y-1/2 opacity-10">
                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M21 18V19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V5C3 3.9 3.9 3 5 3H19C20.1 3 21 3.9 21 5V6H12C10.9 6 10 6.9 10 8V16C10 17.1 10.9 18 12 18H21M12 16H22V8H12V16M16 13.5C15.2 13.5 14.5 12.8 14.5 12C14.5 11.2 15.2 10.5 16 10.5C16.8 10.5 17.5 11.2 17.5 12C17.5 12.8 16.8 13.5 16 13.5Z"/></svg>
            </div>
        </div>

        <div class="form-box shadow-sm">
            <?php if($message): ?>
                <?php 
                    $isSuccess = strpos($message, 'successfully') !== false;
                    $bgColor = $isSuccess ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-rose-50 text-rose-700 border-rose-100';
                ?>
                <div class="<?= $bgColor ?> p-4 rounded-xl border text-sm font-bold mb-6 flex items-center gap-2">
                    <span><?= $isSuccess ? '✓' : '⚠' ?></span> <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Amount to Withdraw</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xl">₹</span>
                        <input type="number" step="0.01" name="amount" class="input-style pl-10" placeholder="0.00" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all transform active:scale-[0.98]">
                    Submit Withdrawal Request
                </button>

                <p class="text-center text-[11px] text-slate-400 leading-relaxed">
                    Requests are usually processed within 24-48 working hours.<br>
                    Ensure your profile bank details are up to date.
                </p>
            </form>
        </div>

        <div class="mt-8 text-center">
            <a href="dashboard.php" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">Cancel and return</a>
        </div>
    </div>
</div>