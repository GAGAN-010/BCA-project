<?php
session_start();
include 'connects.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['btnorder'])) {
    $uid = $_SESSION['USER']; // should contain user's email
    $conn = connectdb();

    // Fetch customer details
    $userQuery = "SELECT name, phone, address, state, city FROM customer_signup WHERE email = '$uid'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $user = $userResult->fetch_assoc();

        $name = $user['name'];
        $phone = $user['phone'];
        $address = $user['address'];
        $state = $user['state'];
        $city = $user['city'];

        // Fetch cart items for user
        $cartQuery = "SELECT * FROM cart WHERE email = '$uid'";
        $cartResult = $conn->query($cartQuery);

        if ($cartResult->num_rows > 0) {
            $order_date = date("Y-m-d H:i:s");

            while ($row = $cartResult->fetch_assoc()) {
                $cid = $row['cid'];
                $cprice = $row['cprice'];
                $chkqty = $row['chkqty'];

                $insertOrder = "INSERT INTO orders 
                (cid, cprice, chkqty, email, order_date, name, phone, address, state, city) 
                VALUES 
                ('$cid', '$cprice', '$chkqty', '$uid', '$order_date', '$name', '$phone', '$address', '$state', '$city')";

                $conn->query($insertOrder);
            }

            // Optional: clear the cart
            // $conn->query("DELETE FROM cart WHERE email = '$uid'");

            echo "<script>alert('Order Successful'); window.location.href='thankyou.php';</script>";
        } else {
            echo "<script>alert('Cart is empty');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
