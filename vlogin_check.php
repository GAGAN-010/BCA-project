xa
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

    $Shop_email = test_input($_POST['Shop_email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($Shop_email) || !filter_var($Shop_email, FILTER_VALIDATE_EMAIL)) {
        jsAlertAndGoBack("Please enter a valid email.");
    }

    if (empty($password)) {
        jsAlertAndGoBack("Please enter your password.");
    }

    $mysqli = connectdb();
    $stmt = $mysqli->prepare("SELECT Shop_name, password FROM vendor_signup WHERE Shop_email = ?");
    if (!$stmt) {
        jsAlertAndGoBack("Database error. Please try again later.");
    }

    $stmt->bind_param("s", $Shop_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($Shop_name, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['VENDOR_NAME'] = $Shop_name;
            $_SESSION['VENDOR_EMAIL'] = $Shop_email;

            echo '<script>alert("Login successful!"); window.location="vendor_dashboard.php";</script>';
			
        } else {
            jsAlertAndGoBack("Invalid password. Please try again.");
        }
    } else {
        jsAlertAndGoBack("No account found with that email.");
    }

    $stmt->close();
    $mysqli->close();
}
?>
<h3>Welcome, <?php echo htmlspecialchars($vendorname); ?></h3>
<p>Your Email: <?php echo htmlspecialchars($email); ?></p>
