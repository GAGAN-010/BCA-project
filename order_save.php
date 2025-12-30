// Connect to DB
include 'connects.php';
$conn = connectdb();
$cid=$_GET['cid'];

// Fetch all cart items
$sql = "SELECT cid, chkqty, cprice FROM cart";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $stmt = $conn->prepare("INSERT INTO orders (cid, chkqty, cprice, email) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $stmt->bind_param("iid",$cid, $row['chkqty'], $row['cprice']);
        $stmt->execute();
    }

    $stmt->close();

    // Optional: Clear cart after order
    $conn->query("DELETE FROM cart");

    echo '<script>alert("Order placed successfully from cart!"); window.location="orders.php";</script>';
} else {
    echo '<script>alert("Cart is empty!"); window.location="cart.php";</script>';
}
