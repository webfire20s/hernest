<?php
require '../includes/sidebar.php';
require '../includes/middleware_admin.php';


if ($currentUser['hierarchy_level'] != 1) {
    die("Access Denied");
    }
    
    // Approve / Reject
    if (isset($_GET['approve'])) {
        
    $id = intval($_GET['approve']);

    $stmt = $pdo->prepare("
        UPDATE withdrawals 
        SET status = 'Approved',
            processed_at = NOW()
            WHERE id = ?
    ");
    $stmt->execute([$id]);
    
    header("Location: withdrawals.php");
    exit;
    }

if (isset($_GET['reject'])) {

    $id = intval($_GET['reject']);
    
    $stmt = $pdo->prepare("
        UPDATE withdrawals 
        SET status = 'Rejected',
            processed_at = NOW()
        WHERE id = ?
    ");
    $stmt->execute([$id]);

    header("Location: withdrawals.php");
    exit;
}

// Fetch requests
$stmt = $pdo->query("
SELECT w.*, u.full_name
    FROM withdrawals w
    JOIN users u ON w.user_id = u.id
    ORDER BY w.requested_at DESC
    ");
    $withdrawals = $stmt->fetchAll();
?>

<h2>Withdrawal Requests</h2>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>User</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Requested At</th>
    <th>Action</th>
</tr>

<?php foreach($withdrawals as $w): ?>
<tr>
    <td><?= $w['id'] ?></td>
    <td><?= $w['full_name'] ?></td>
    <td>₹<?= number_format($w['amount'],2) ?></td>
    <td><?= $w['status'] ?></td>
    <td><?= $w['requested_at'] ?></td>
    <td>
        <?php if($w['status'] == 'Pending'): ?>
            <a href="?approve=<?= $w['id'] ?>">Approve</a> |
            <a href="?reject=<?= $w['id'] ?>">Reject</a>
        <?php else: ?>
            Processed
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>