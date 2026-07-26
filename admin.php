<?php 
include 'config.php';
if (!isAdmin()) die("<h2 style='color:red;text-align:center;'>Access Denied! Admin Only.</h2>");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - FXTrading</title>
    <style> body { background:#0f172a; color:#e2e8f0; padding:30px; font-family:Arial; } table { width:100%; border-collapse:collapse; } th, td { padding:12px; border:1px solid #334155; } </style>
</head>
<body>
    <h1>🔧 Admin Dashboard</h1>
    <a href="dashboard.php">← Back to My Dashboard</a><br><br>

    <h2>Pending Withdrawals</h2>
    <table>
        <tr><th>ID</th><th>User ID</th><th>Amount</th><th>Status</th><th>Date</th><th>Action</th></tr>
        <?php
        $stmt = $pdo->query("SELECT * FROM withdrawals WHERE status='pending' ORDER BY id DESC");
        while($row = $stmt->fetch()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['user_id']}</td>
                <td>\${$row['amount']}</td>
                <td>{$row['status']}</td>
                <td>{$row['created_at']}</td>
                <td><a href='?approve={$row['id']}'>Approve</a></td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>