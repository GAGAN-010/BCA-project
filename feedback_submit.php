<?php
session_start();
include 'connects.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // CSRF validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        echo '<script>alert("Invalid request. Please reload the page."); window.location="contact.php";</script>';
        exit();
    }

    // Sanitize
    $name = test_input($_POST['name'] ?? '');
    $email = test_input($_POST['email'] ?? '');
    $rating = test_input($_POST['rating'] ?? '');
    $message = test_input($_POST['message'] ?? '');

    // Validation
    if (empty($name) || !preg_match("/^[A-Za-z\s]+$/", $name)) {
        jsAlertAndGoBack("Name must contain only letters and spaces.");
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsAlertAndGoBack("Invalid email address.");
    }

    if (empty($rating)) {
        jsAlertAndGoBack("rating is required.");
    }

    if (empty($message)) {
        jsAlertAndGoBack("Please add a feedback.");
    }

    // DB check
    $mysqli = connectdb();
    // Hash and insert
     
    $stmt = $mysqli->prepare("INSERT INTO contact (name, email, rating, message) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        log_error("Prepare failed: " . $mysqli->error);
        jsAlertAndRedirect("Internal error. Try again later.", "feedback.php");
    }

    $stmt->bind_param("ssss", $name, $email, $rating, $message);
    if ($stmt->execute()) {
        unset($_SESSION['csrf_token']);
        echo '<script>alert("feedback submited successful! Fresh Chicken will Take Care of You!"); window.location="contact.php";</script>';
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
