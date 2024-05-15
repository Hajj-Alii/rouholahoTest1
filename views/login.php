<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="../assets/styles/loginStyle.css">
</head>
<body>
<div class="login-container">
    <h2><?php echo __DIR__?></h2>
    <h2>Login</h2>
    <form class="login-form" action="../controllers/auth.php" method="post">
        <label>
            <input type="text" name="username" placeholder="Username" required>
        </label>
        <label>
            <input type="password" name="password" placeholder="Password" required>
        </label>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
