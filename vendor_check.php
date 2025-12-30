<?php
session_start();
include 'connects.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // CSRF validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        echo '<script>alert("Invalid request. Please reload the page."); window.location="vendor_signup.php";</script>';
        exit();
    }

    // Sanitize
	$Shop_email = test_input($_POST['Shop_email'] ?? '');
    $Shop_name = test_input($_POST['Shop_name'] ?? '');
	$Shop_phone = test_input($_POST['Shop_phone'] ?? '');
    $Shop_address = test_input($_POST['Shop_address'] ?? '');
    $state = test_input($_POST['state'] ?? '');
    $city = test_input($_POST['city'] ?? '');
    $raw_password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';

    // Validation
  // Validation
	if (empty($Shop_email) || !filter_var($Shop_email, FILTER_VALIDATE_EMAIL)) {
    jsAlertAndGoBack("Invalid email address.");
	}


    if (empty($Shop_name) || !preg_match("/^[A-Za-z\s]+$/", $Shop_name)) {
        jsAlertAndGoBack("Name must contain only letters and spaces.");
    }

    if (empty($Shop_address)) {
        jsAlertAndGoBack("Address is required.");
    }
	
	 if (empty($Shop_phone)) {
        jsAlertAndGoBack("number is required.");
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
    $sql = "SELECT Shop_email FROM vendor_signup WHERE Shop_email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $Shop_email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        jsAlertAndGoBack("Email already registered. Try a different one.");
    }
    $stmt->close();

    // Hash and insert
    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO vendor_signup (Shop_email,Shop_name,Shop_phone,Shop_address, state, city, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        log_error("Prepare failed: " . $mysqli->error);
        jsAlertAndRedirect("Internal error. Try again later.", "vendor_signup.php");
    }

    $stmt->bind_param("sssssss", $Shop_email, $Shop_name, $Shop_phone, $Shop_address, $state, $city, $hashed_password);
    if ($stmt->execute()) {
        unset($_SESSION['csrf_token']);
        echo '<script>alert("Vendor Registration successful!"); window.location="vendor_signup.php";</script>';
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
