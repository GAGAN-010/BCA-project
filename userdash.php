<?php
session_start();
include 'connects.php';
$conn = connectdb();

// Handle status update
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    $updateSql = "UPDATE orders SET status = '$new_status' WHERE id = '$order_id'";
    $conn->query($updateSql);
}

// Fetch orders (make sure 'id' column exists in 'orders' table)
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .cutting-btn { background-color: #f0ad4e; }
        .delivery-btn { background-color: #5cb85c; }
    </style>
</head>
<body>

<h2>All Orders</h2>

<table>
    <tr>
        <th>Order Date</th>
        <th>Customer Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <th>State</th>
        <th>City</th>
        <th>Chicken ID</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['state']) . "</td>";
            echo "<td>" . htmlspecialchars($row['city']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cid']) . "</td>";
            echo "<td>₹" . htmlspecialchars($row['cprice']) . "</td>";
            echo "<td>" . htmlspecialchars($row['chkqty']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                        <input type='hidden' name='status' value='Cutting'>
                        <button type='submit' name='update_status' class='btn cutting-btn'>Cutting</button>
                    </form>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                        <input type='hidden' name='status' value='Delivery'>
                        <button type='submit' name='update_status' class='btn delivery-btn'>Delivery</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='12'>No orders found.</td></tr>";
    }
    ?>
</table>



</body>
</html>
