<?php
require '../includes/auth.php';

if ($currentUser['hierarchy_level'] == 1) {
    header("Location: /admin/dashboard.php");
    exit;
}

// Fetch active services
$stmt = $pdo->query("
    SELECT id, service_name
    FROM services
    WHERE is_active = 1
    ORDER BY service_name ASC
");
$services = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $serviceId = $_POST['service_id'];
    $customerName = trim($_POST['customer_name']);
    $customerPhone = trim($_POST['customer_phone']);
    $customerEmail = trim($_POST['customer_email']);
    $address = trim($_POST['address']);

    $insert = $pdo->prepare("
        INSERT INTO leads (
            service_id,
            customer_name,
            customer_phone,
            customer_email,
            address,
            submitted_by,
            current_status,
            commission_distributed
        )
        VALUES (?, ?, ?, ?, ?, ?, 'Pending', 0)
    ");

    $insert->execute([
        $serviceId,
        $customerName,
        $customerPhone,
        $customerEmail,
        $address,
        $currentUser['id']
    ]);

    header("Location: leads.php?submitted=1");
    exit;
}

require 'sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: sans-serif; }
        .main-content { margin-left: 260px; padding: 60px 40px; display: flex; justify-content: center; }
        .form-container { width: 100%; max-width: 600px; }
        .input-group { margin-bottom: 20px; }
        .label { display: block; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
        .form-input { 
            width: 100%; 
            padding: 12px 16px; 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            background: white; 
            color: #1e293b; 
            font-size: 0.95rem; 
            transition: all 0.2s ease;
        }
        .form-input:focus { outline: none; border-color: #2563eb; ring: 2px; ring-color: #dbeafe; }
        .submit-btn {
            width: 100%;
            background: #2563eb;
            color: white;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
        }
        .submit-btn:hover { background: #1d4ed8; transform: translateY(-1px); }
    </style>
</head>

<div class="main-content">
    <div class="form-container">
        
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Submit New Lead</h2>
            <p class="text-slate-500 mt-2">Enter customer details to initiate a new service request.</p>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-[2rem] border border-slate-100 shadow-sm">
            <form method="POST" class="space-y-6">

                <div class="input-group">
                    <label class="label">Select Service Type</label>
                    <select name="service_id" id="service_id" class="form-input cursor-pointer" required>
                        <option value="">Choose a service...</option>
                        <?php foreach($services as $service): ?>
                            <option value="<?= $service['id'] ?>">
                                <?= htmlspecialchars($service['service_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="commissionPreview" class="mt-3 text-sm font-semibold text-green-600 hidden">
                        Projected Commission: ₹ <span id="commissionAmount">0.00</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="input-group">
                        <label class="label">Customer Name</label>
                        <input type="text" name="customer_name" class="form-input" placeholder="Customer Name" required>
                    </div>

                    <div class="input-group">
                        <label class="label">Phone Number</label>
                        <input type="text" name="customer_phone" class="form-input" placeholder="Customer Contact Number" required>
                    </div>
                </div>

                <div class="input-group">
                    <label class="label">Email Address (Optional)</label>
                    <input type="email" name="customer_email" class="form-input" placeholder="Your Email">
                </div>

                <div class="input-group">
                    <label class="label">Physical Address</label>
                    <textarea name="address" class="form-input" rows="3" placeholder="Enter complete customer address..."></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="submit-btn">
                        Create Lead Entry
                    </button>
                    <p class="text-center text-[11px] text-slate-400 mt-4 uppercase tracking-widest">
                        Security verified entry • Data encrypted
                    </p>
                </div>
            </form>
        </div>

        <div class="mt-8 text-center">
            <a href="leads.php" class="text-sm font-semibold text-slate-400 hover:text-blue-600 transition-colors">
                ← Back to Lead Management
            </a>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {

    const serviceSelect = document.getElementById('service_id');
    const previewBox    = document.getElementById('commissionPreview');
    const amountSpan    = document.getElementById('commissionAmount');

    serviceSelect.addEventListener('change', function () {

        const serviceId = this.value;

        if (!serviceId) {
            previewBox.classList.add('hidden');
            return;
        }

        fetch('get_projected_commission.php?service_id=' + serviceId)
            .then(response => response.json())
            .then(data => {

                if (data.amount > 0) {
                    amountSpan.textContent = parseFloat(data.amount).toFixed(2);
                    previewBox.classList.remove('hidden');
                } else {
                    previewBox.classList.add('hidden');
                }

            });

    });

});
</script>