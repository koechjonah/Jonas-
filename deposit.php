<?php 
include 'config.php';
if (!isLoggedIn()) header("Location: login.php");

if (isset($_POST['deposit'])) {
    $amount = floatval($_POST['amount']);
    $method = $_POST['method'];

    if ($amount >= 10) {
        $stmt = $pdo->prepare("INSERT INTO deposits (user_id, amount, payment_method, status) VALUES (?, ?, ?, 'completed')");
        $stmt->execute([$_SESSION['user_id'], $amount, $method]);

        $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?")
             ->execute([$amount, $_SESSION['user_id']]);

        echo "<script>alert('✅ Deposit of \[ amount via $method successful!'); window.location='dashboard.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deposit - FXTrading</title>
    <style>
        body { background:#0f172a; color:#e2e8f0; padding:40px; font-family:Arial; text-align:center; }
        input, select, button { padding:12px; margin:10px; width:350px; font-size:1rem; }
        button { background:#22c55e; color:white; border:none; border-radius:8px; cursor:pointer; }
    </style>
</head>
<body>
    <h2>Deposit Funds</h2>
    <form method="POST">
        <input type="number" name="amount" step="0.01" min="10" placeholder="Amount (USD)" required><br>
        
        <select name="method" required>
            <option value="">Select Payment Method</option>
            <option value="M-Pesa">M-Pesa (Kenya)</option>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Bitcoin">Bitcoin (BTC)</option>
            <option value="USDT">USDT (TRC20)</option>
            <option value="PayPal">PayPal</option>
        </select><br>
        
        <button type="submit" name="deposit">Deposit Now</button>
    </form>
    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>