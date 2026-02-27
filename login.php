<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("
        SELECT u.id, u.password_hash, u.is_active, r.hierarchy_level
        FROM users u
        JOIN roles r ON u.role_id = r.id
        WHERE u.email = ?
        LIMIT 1
    ");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && $user['is_active'] == 1 && password_verify($password, $user['password_hash'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_level'] = $user['hierarchy_level'];

        // Redirect based on role
        if ($user['hierarchy_level'] == 1) {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: panel/dashboard.php");
        }
        exit;

    } else {
        $error = "Invalid credentials or account inactive.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Login | HERNEST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: radial-gradient(circle at top right, #eff6ff, #f8fafc);
        }
        .login-card {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: slideUp 0.6s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        .input-field:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="index.php" class="inline-flex items-center gap-2 mb-4">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200">H</div>
                <span class="text-2xl font-black tracking-tighter text-slate-800">HERNEST</span>
            </a>
            <h2 class="text-xl font-semibold text-slate-600 tracking-tight">Welcome back</h2>
        </div>

        <div class="login-card p-8 md:p-10 rounded-[2.5rem] shadow-2xl shadow-blue-100/50">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Login</h1>
            <p class="text-slate-500 mb-8 text-sm">Access your multi-level service dashboard.</p>

            <?php if(isset($error)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl flex items-center gap-3 text-red-600 text-sm animate-shake">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0"></path></svg>
                    <p class="font-medium"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" placeholder="name@test.com" 
                           class="w-full px-5 py-4 rounded-2xl bg-white input-field text-slate-900" required>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••" 
                           class="w-full px-5 py-4 rounded-2xl bg-white input-field text-slate-900" required>
                </div>

                <div class="flex items-center justify-between py-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-500">Remember me</span>
                    </label>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Forgot?</a>
                </div>

                <button type="submit" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-blue-600 transform hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-slate-200 hover:shadow-blue-200">
                    Sign In
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-slate-100 text-center">
                <p class="text-slate-500 text-sm">
                    Don't have an account? 
                    <a href="contact.php" class="text-blue-600 font-bold hover:underline">Become a Partner</a>
                </p>
            </div>
        </div>
        
        <div class="mt-8 flex justify-center gap-6 text-xs font-medium text-slate-400">
            <a href="index.php" class="hover:text-slate-600 transition-colors tracking-wide uppercase">Home</a>
            <a href="#" class="hover:text-slate-600 transition-colors tracking-wide uppercase">Privacy</a>
            <a href="#" class="hover:text-slate-600 transition-colors tracking-wide uppercase">Support</a>
        </div>
    </div>

</body>
</html>