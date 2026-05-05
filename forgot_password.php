<?php
require 'includes/db.php';

$message = '';
$isError = false;
$step = 1; // Step control

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // STEP 1: VERIFY USER
    if (isset($_POST['verify'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $check = $pdo->prepare("SELECT id FROM users WHERE email = ? AND phone = ?");
        $check->execute([$email, $phone]);

        if ($check->fetch()) {
            $step = 2;
        } else {
            $message = "Invalid email or phone.";
            $isError = true;
        }
    }

    // STEP 2: RESET PASSWORD
    if (isset($_POST['reset'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $newPassword = $_POST['password'];

        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);

        $update = $pdo->prepare("
            UPDATE users 
            SET password_hash = ? 
            WHERE email = ? AND phone = ?
        ");
        $update->execute([$hashed, $email, $phone]);

        $message = "Password updated successfully. You can login now.";
        $step = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Identity | HERNEST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        }

        .form-input {
            width: 100%;
            padding: 1.25rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
        }

        .form-input:focus {
            background: #ffffff;
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }

        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, transparent 70%);
            z-index: -1;
            filter: blur(60px);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- Ambient Background -->
    <div class="blob -top-24 -left-24"></div>
    <div class="blob -bottom-24 -right-24"></div>

    <div class="w-full max-w-md relative">
        
        <!-- Back Button -->
        <a href="login.php" class="inline-flex items-center gap-2 text-slate-400 hover:text-blue-600 font-bold text-[10px] uppercase tracking-widest mb-8 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            Return to Terminal
        </a>

        <div class="glass-card p-10 md:p-12 rounded-[3rem]">
            
            <div class="text-center mb-10">
                <div class="w-16 h-16 bg-blue-600 rounded-2xl mx-auto mb-6 flex items-center justify-center shadow-xl shadow-blue-200">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 mb-2">Account Recovery</h1>
                <p class="text-slate-500 text-sm font-medium">Step <?= $step ?> of 2: Verify Credentials</p>
            </div>

            <?php if($message): ?>
                <div class="mb-8 p-5 rounded-2xl flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-500 <?= $isError ? 'bg-red-50 border border-red-100 text-red-600' : 'bg-emerald-50 border border-emerald-100 text-emerald-700' ?>">
                    <?php if($isError): ?>
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <?php else: ?>
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <?php endif; ?>
                    <span class="text-xs font-bold uppercase tracking-wide leading-tight"><?= $message ?></span>
                </div>
            <?php endif; ?>

            <!-- STEP 1: IDENTITY VERIFICATION -->
            <?php if($step == 1): ?>
            <form method="POST" class="space-y-6">
                <input type="hidden" name="verify">

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Digital Mailbox</label>
                    <input type="email" name="email" placeholder="email@address.com" required class="form-input">
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Registered Phone</label>
                    <input type="text" name="phone" placeholder="+91 00000 00000" required class="form-input">
                </div>

                <button type="submit" class="w-full py-5 bg-slate-900 text-white font-black rounded-2xl text-[11px] uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 hover:shadow-blue-200 active:scale-95">
                    Verify Identity
                </button>
            </form>
            <?php endif; ?>

            <!-- STEP 2: PASSWORD RECONSTRUCTION -->
            <?php if($step == 2): ?>
            <form method="POST" class="space-y-6">
                <input type="hidden" name="reset">

                <!-- Persisting data from step 1 -->
                <input type="hidden" name="email" value="<?= htmlspecialchars($_POST['email']) ?>">
                <input type="hidden" name="phone" value="<?= htmlspecialchars($_POST['phone']) ?>">

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">New Secure Password</label>
                    <div class="relative group">
                        <input type="password" id="password" name="password" placeholder="••••••••" required class="form-input pr-14">
                        
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 p-2 text-slate-400 hover:text-blue-600 transition-colors focus:outline-none">
                            <!-- Eye Icon (Visible by default) -->
                            <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Slash Icon (Hidden by default) -->
                            <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <script>
                function togglePassword() {
                    const passwordInput = document.getElementById('password');
                    const eyeOpen = document.getElementById('eye-open');
                    const eyeClosed = document.getElementById('eye-closed');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeOpen.classList.add('hidden');
                        eyeClosed.classList.remove('hidden');
                    } else {
                        passwordInput.type = 'password';
                        eyeOpen.classList.remove('hidden');
                        eyeClosed.classList.add('hidden');
                    }
                }
                </script>

                <button type="submit" class="w-full py-5 bg-emerald-600 text-white font-black rounded-2xl text-[11px] uppercase tracking-[0.2em] hover:bg-emerald-500 transition-all shadow-xl shadow-emerald-200 active:scale-95">
                    Finalize Reset
                </button>
            </form>
            <?php endif; ?>

        </div>

        <p class="text-center mt-10 text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">
            Secure Identity Protocol &copy; <?= date('Y') ?> HERNEST INC.
        </p>
    </div>

</body>
</html>