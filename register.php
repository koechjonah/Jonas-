<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - FXTrading</title>
    <style>
        body { background:#0f172a; color:#e2e8f0; font-family:Arial; padding:40px; text-align:center; }
        input, button { padding:12px; margin:10px; width:320px; font-size:1rem; }
        button { background:#22c55e; color:white; border:none; border-radius:6px; cursor:pointer; }
    </style>
</head>
<body>
    <h2>Create Account</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="register">Register</button>
    </form>

    <?php
    if (isset($_POST['register'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed]);
            echo "<p style='color:green'>✅ Registration Successful! <a href='login.php'>Login Now</a></p>";
        } catch(Exception $e) {
            echo "<p style='color:red'>❌ Username or Email already exists.</p>";
        }
    }
    ?>
    <p><a href="login.php">Already have account? Login</a></p>
</body>
</html>