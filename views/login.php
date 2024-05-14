<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="../assets/styles/loginStyle.css">
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form class="login-form" action="../controllers/auth.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
