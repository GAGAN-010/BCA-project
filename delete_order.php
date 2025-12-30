<?php
include 'connects.php';
$conn = connectdb();

if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);

    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?deleted=1");
        exit();
    } else {
        echo "Error deleting order: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid order ID.";
}
?>
