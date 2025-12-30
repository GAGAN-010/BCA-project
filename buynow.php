<?php
session_start();
include 'connects.php';

if (!isset($_SESSION['USER'])) {
    echo "<script>alert('You must be logged in to checkout.'); window.location='login.php';</script>";
    exit();
}

$email = $_SESSION['USER'];
$mysqli = connectdb();

// 1. Fetch user details from customer_signup
$userQuery = "SELECT name, phone, address, state, city FROM customer_signup WHERE email = ?";
$userStmt = $mysqli->prepare($userQuery);
$userStmt->bind_param('s', $email);
$userStmt->execute();
$userResult = $userStmt->get_result();

if ($userResult->num_rows == 0) {
    echo "<script>alert('User details not found.'); window.location='cart.php';</script>";
    exit();
}

$user = $userResult->fetch_assoc();
$name = $user['name'];
$phone = $user['phone'];
$address = $user['address'];
$state = $user['state'];
$city = $user['city'];

// 2. Fetch cart items
$query = "SELECT cid, cprice, chkqty FROM cart WHERE email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

$orders_inserted = 0;

// 3. Prepare insert into orders (updated with user details)
$insert_query = "INSERT INTO orders (cid, cprice, chkqty, email, order_date, name, phone, address, state, city) 
                 VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?)";
$insert_stmt = $mysqli->prepare($insert_query);

while ($row = $result->fetch_assoc()) {
    $cid = $row['cid'];
    $cprice = $row['cprice'];
    $chkqty = $row['chkqty'];

    $insert_stmt->bind_param('sdsssssss', $cid, $cprice, $chkqty, $email, $name, $phone, $address, $state, $city);

    if ($insert_stmt->execute()) {
        $orders_inserted++;
    }
}

// 4. Clear the cart after successful order placement
if ($orders_inserted > 0) {
    $delete_query = "DELETE FROM cart WHERE email = ?";
    $delete_stmt = $mysqli->prepare($delete_query);
    $delete_stmt->bind_param('s', $email);
    $delete_stmt->execute();
    $delete_stmt->close();

    echo "<script>alert('Order placed successfully! Payment?'); window.location='orderplaced.php';</script>";
} else {
    echo "<script>alert('No items in cart or order failed.'); window.location='cart.php';</script>";
}

// 5. Close statements
$stmt->close();
$insert_stmt->close();
$userStmt->close();
$mysqli->close();
?>
