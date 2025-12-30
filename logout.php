<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Optional: Delay and redirect
echo "<script>
    alert('You have been logged out.');
    window.location.href = 'index.html'; // or 'vlogin.php' for vendors
</script>";
exit();
?>
