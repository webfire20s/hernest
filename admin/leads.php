<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Fetch all leads
$stmt = $pdo->query("
    SELECT l.id, l.customer_name, l.customer_phone,
           l.current_status, l.created_at,
           s.service_name,
           u.full_name AS submitted_by
    FROM leads l
    JOIN services s ON l.service_id = s.id
    JOIN users u ON l.submitted_by = u.id
    ORDER BY l.created_at DESC
");
$leads = $stmt->fetchAll();
?>

<h2>Lead Management</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Phone</th>
        <th>Service</th>
        <th>Submitted By</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach($leads as $lead): ?>
        <tr>
            <td><?= $lead['id'] ?></td>
            <td><?= htmlspecialchars($lead['customer_name']) ?></td>
            <td><?= htmlspecialchars($lead['customer_phone']) ?></td>
            <td><?= $lead['service_name'] ?></td>
            <td><?= $lead['submitted_by'] ?></td>
            <td><?= $lead['current_status'] ?></td>
            <td>
                <?php if($lead['current_status'] == 'Pending' || $lead['current_status'] == 'In Process'): ?>
                    <a href="update_lead_status.php?id=<?= $lead['id'] ?>&status=In Process">In Process</a> |
                    <a href="update_lead_status.php?id=<?= $lead['id'] ?>&status=Approved">Approve</a> |
                    <a href="update_lead_status.php?id=<?= $lead['id'] ?>&status=Rejected">Reject</a>
                <?php else: ?>
                    Locked
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require '../includes/footer.php'; ?>