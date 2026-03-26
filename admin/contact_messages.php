<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Fetch messages with service name
$stmt = $pdo->query("
    SELECT cm.*, s.service_name 
    FROM contact_messages cm
    LEFT JOIN services s ON cm.service_id = s.id
    ORDER BY cm.id DESC
");
$messages = $stmt->fetchAll();
?>

<head>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>

<div class="admin-main">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Contact Inquiries</h2>
            <p class="text-slate-500 text-sm">All submitted customer requests</p>
        </div>

        <div class="bg-blue-50 text-blue-600 px-5 py-3 rounded-xl font-bold text-sm border border-blue-100">
            <?= count($messages) ?> Total Requests
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-200">
        <table id="contactTable" class="display w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>Service</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($messages as $msg): ?>
                <tr>
                    <td>#<?= $msg['id'] ?></td>

                    <td class="font-bold">
                        <?= htmlspecialchars($msg['name']) ?>
                    </td>

                    <td>
                        <div><?= htmlspecialchars($msg['phone']) ?></div>
                        <div class="text-xs text-slate-400">
                            <?= htmlspecialchars($msg['email']) ?>
                        </div>
                    </td>

                    <td class="text-sm">
                        <?= htmlspecialchars($msg['city']) ?><br>
                        <?= htmlspecialchars($msg['state']) ?><br>
                        <span class="text-xs text-slate-400">
                            <?= htmlspecialchars($msg['country']) ?>
                        </span>
                    </td>

                    <td>
                        <span class="bg-indigo-50 text-indigo-600 px-2 py-1 rounded text-xs font-bold">
                            <?= htmlspecialchars($msg['service_name'] ?? 'General') ?>
                        </span>
                    </td>

                    <td class="max-w-[250px] truncate">
                        <?= htmlspecialchars($msg['message']) ?>
                    </td>

                    <td>
                        <?= date('d M Y', strtotime($msg['created_at'])) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#contactTable').DataTable({
        pageLength: 10,
        responsive: true
    });
});
</script>

<?php require '../includes/footer.php'; ?>