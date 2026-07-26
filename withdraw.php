<?php 
include 'config.php';
if (!isLoggedIn()) header("Location: login.php");

if (isset($_POST['withdraw'])) {
    $amount = floatval($_POST['amount']);

    $stmt = $pdo->prepare("SELECT balance FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $balance = $stmt->fetchColumn();

    if ($amount < 50) {
        echo "<script>alert('Minimum withdrawal is $50');</script>";
    } elseif ($amount > $balance) {
        echo "<script>alert('Insufficient Balance!');</script>";
    } else {
        $pdo->prepare("INSERT INTO withdrawals (user_id, amount, status) VALUES (?, ?, 'pending')")
             ->execute([$_SESSION['user_id'], $amount]);
        echo "<script>alert('Withdrawal request of \]amount submitted successfully. Admin will review it soon.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Withdraw - FXTrading</title>
    <style>
        body { background:#0f172a; color:#e2e8f0; padding:40px; font-family:Arial; text-align:center; }
        input, button { padding:12px; margin:10px; width:350px; font-size:1rem; }
        button { background:#ef4444; color:white; border:none; border-radius:8px; }
    </style>
</head>
<body>
    <h2>Request Withdrawal</h2>
    <form method="POST">
        <input type="number" name="amount" step="0.01" min="50" placeholder="Amount (USD)" required><br>
        <button type="submit" name="withdraw">Submit Withdrawal Request</button>
    </form>
    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>