<?php
session_start();
include 'connects.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ensure user is logged in
    if (!isset($_SESSION['email'])) {
        jsAlertAndRedirect("Please log in first.", "login.php");
    }

    $email = $_SESSION['email']; // Get email from session

    // Connect to database
    $mysqli = connectdb();

    // Fetch uid from customer_signup using email
    $stmt_uid = $mysqli->prepare("SELECT uid FROM customer_signup WHERE email = ?");
    if (!$stmt_uid) {
        log_error("UID fetch prepare failed: " . $mysqli->error);
        jsAlertAndRedirect("Internal error. Try again.", "cart.php");
    }

    $stmt_uid->bind_param("s", $email);
    $stmt_uid->execute();
    $result_uid = $stmt_uid->get_result();

    if ($result_uid->num_rows === 0) {
        jsAlertAndRedirect("User not found.", "login.php");
    }

    $uid = $result_uid->fetch_assoc()['uid'];
    $stmt_uid->close();

    // Sanitize product inputs
    $cid = test_input($_POST['cid'] ?? '');
    $price = test_input($_POST['cprice'] ?? '');
    $chkqty = test_input($_POST['chkqty'] ?? '');

    // Validation
    if (empty($cid) || empty($price) || empty($chkqty)) {
        jsAlertAndGoBack("All fields are required.");
    }

    if (!is_numeric($price) || !is_numeric($chkqty)) {
        jsAlertAndGoBack("Price and quantity must be numeric.");
    }

    // Insert into cart
    $stmt = $mysqli->prepare("INSERT INTO cart (cid, cprice, chkqty, uid) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        log_error("Cart insert prepare failed: " . $mysqli->error);
        jsAlertAndRedirect("Internal error. Try again later.", "cart.php");
    }

    $stmt->bind_param("ssss", $cid, $price, $chkqty, $uid);

    if ($stmt->execute()) {
        echo '<script>alert("Item added to cart successfully!"); window.location="cart.php";</script>';
    } else {
        log_error("Cart insert failed: " . $stmt->error);
        jsAlertAndGoBack("Failed to add item to cart. Try again.");
    }

    $stmt->close();
    $mysqli->close();
}

// Helper functions
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
