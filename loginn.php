<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
</head>
<body>

<h2>User Login</h2>

<form method="POST" action="login_check.php">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Email:</label>
    <input type="email" name="email" required placeholder="Enter your email">

    <label>Password:</label>
    <input type="password" name="password" required placeholder="Enter your password">

    <br><br>
    <input type="submit" name="login" value="Login">
</form>

</body>
</html>
