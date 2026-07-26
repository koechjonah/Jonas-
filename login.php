<?php 
include 'config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - FXTrading</title>
    <style>
        body { background:#0f172a; color:#e2e8f0; font-family:Arial; padding:50px; text-align:center; }
        input, button { padding:12px; margin:10px; width:320px; font-size:1rem; }
        button { background:#3b82f6; color:white; border:none; border-radius:6px; }
    </style>
</head>
<body>
    <h2>Login to FXTrading</h2>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>

    <p>Demo Admin Login:<br><strong>admin@fxtrading.com</strong> / <strong>password</strong></p>
    <p><a href="register.php">Don't have account? Register</a></p>
</body>
</html>