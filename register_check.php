<?php
session_start();
include 'connects.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // CSRF validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        echo '<script>alert("Invalid request. Please reload the page."); window.location="customer_signup.php";</script>';
        exit();
    }

    // Sanitize
    $email = test_input($_POST['email'] ?? '');
    $name = test_input($_POST['name'] ?? '');
	$phone = test_input($_POST['phone'] ?? '');
    $address = test_input($_POST['address'] ?? '');
    $state = test_input($_POST['state'] ?? '');
    $city = test_input($_POST['city'] ?? '');
    $raw_password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';

    // Validation
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsAlertAndGoBack("Invalid email address.");
    }

    if (empty($name) || !preg_match("/^[A-Za-z\s]+$/", $name)) {
        jsAlertAndGoBack("Name must contain only letters and spaces.");
    }
	
	if (empty($phone)) {
        jsAlertAndGoBack("phone is required.");
    }

    if (empty($address)) {
        jsAlertAndGoBack("Address is required.");
    }

    if (empty($state)) {
        jsAlertAndGoBack("Please select a state.");
    }

    if (empty($city)) {
        jsAlertAndGoBack("Please select a city.");
    }

    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*]).{6,}$/", $raw_password)) {
        jsAlertAndGoBack("Password must be at least 6 characters and include letters, numbers, and symbols.");
    }

    if ($raw_password !== $repassword) {
        jsAlertAndGoBack("Passwords do not match.");
    }

    // DB check
    $mysqli = connectdb();
    $sql = "SELECT email FROM customer_signup WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        jsAlertAndGoBack("Email already registered. Try a different one.");
    }
    $stmt->close();

    // Hash and insert
    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO customer_signup (email, name, phone, address, state, city, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        log_error("Prepare failed: " . $mysqli->error);
        jsAlertAndRedirect("Internal error. Try again later.", "customer_signup.php");
    }

    $stmt->bind_param("sssssss", $email, $name, $phone, $address, $state, $city, $hashed_password);
    if ($stmt->execute()) {
        unset($_SESSION['csrf_token']);
        echo '<script>alert("Registration successful!"); window.location="customer_signup.php";</script>';
    } else {
        log_error("Insert failed: " . $stmt->error);
        jsAlertAndGoBack("Failed to register. Try again.");
    }

    $stmt->close();
    $mysqli->close();
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function log_error($message) {
    $logFile = __DIR__ . '/error_log.txt';
    error_log("[" . date('Y-m-d H:i:s') . "] " . $message . "\n", 3, $logFile);
}

function jsAlertAndGoBack($message) {
    echo "<script>alert('" . addslashes($message) . "'); window.history.back();</script>";
    exit();
}

function jsAlertAndRedirect($message, $location) {
    echo "<script>alert('" . addslashes($message) . "'); window.location='$location';</script>";
    exit();
}
?>
