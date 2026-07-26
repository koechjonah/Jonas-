<?php 
include 'config.php';
if (!isLoggedIn()) header("Location: login.php");

$stmt = $pdo->prepare("SELECT balance FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$balance = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - FXTrading</title>
    <style>
        body { background:#0f172a; color:#e2e8f0; font-family:Arial; }
        .container { max-width:1100px; margin:40px auto; padding:20px; }
        .card { background:#1e2937; padding:30px; border-radius:12px; margin:20px 0; text-align:center; }
        .btn { padding:15px 30px; margin:10px; font-size:1.1rem; border:none; border-radius:8px; cursor:pointer; }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h1>
    
    <div class="card">
        <h2>Current Balance</h2>
        <h1 style="color:#22c55e; font-size:3rem;">$<?= number_format($balance, 2) ?></h1>
    </div>

    <a href="deposit.php"><button class="btn" style="background:#22c55e;color:white;">💰 Deposit Money</button></a>
    <a href="withdraw.php"><button class="btn" style="background:#ef4444;color:white;">📤 Request Withdrawal</button></a>
    <a href="logout.php"><button class="btn" style="background:#64748b;">Logout</button></a>

    <?php if (isAdmin()): ?>
        <hr style="margin:40px 0;">
        <h2>🔧 Admin Panel</h2>
        <a href="admin.php"><button class="btn" style="background:#8b5cf6; color:white; font-size:1.2rem;">Manage Deposits & Withdrawals</button></a>
    <?php endif; ?>
</div>
</body>
</html>