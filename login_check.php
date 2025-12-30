<?php
session_start();
include 'connects.php';

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function jsAlertAndGoBack($msg) {
    echo "<script>alert('" . addslashes($msg) . "'); window.history.back();</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = test_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsAlertAndGoBack("Please enter a valid email.");
    }

    if (empty($password)) {
        jsAlertAndGoBack("Please enter your password.");
    }

    $mysqli = connectdb();
    $stmt = $mysqli->prepare("SELECT password, name FROM customer_signup WHERE email = ?");
    if (!$stmt) {
        jsAlertAndGoBack("Database error. Try again later.");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_Password, $name);
        $stmt->fetch();

        if (password_verify($password, $hashed_Password)) {
            $_SESSION['USER'] = $email;
            $_SESSION['NAME'] = $name;
            echo '<script>alert("Login successful!"); window.location="user_dashboard.php";</script>';
            exit();
        } else {
            jsAlertAndGoBack("Incorrect password.");
        }
    } else {
        jsAlertAndGoBack("Account not found.");
    }

    $stmt->close();
    $mysqli->close();
}
?>
