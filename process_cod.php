<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fresh Chicken - Order Placed</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap and Custom Styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .order-confirm {
            text-align: center;
            padding: 80px 20px;
            background-color: #f9fff9;
        }

        .order-confirm h1 {
            font-size: 3rem;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .order-confirm p {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 30px;
        }

        .btn-home {
            background-color: #4CAF50;
            color: white;
            padding: 10px 25px;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .btn-home:hover {
            background-color: #388e3c;
        }

        .checkmark {
            font-size: 80px;
            color: #4CAF50;
            margin-bottom: 20px;
            animation: pop 0.4s ease;
        }

        @keyframes pop {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>

<body>

    <div class="container order-confirm">
        <div class="checkmark"><i class="fas fa-check-circle"></i></div>
        <h1>Order Successfully Placed!</h1>
        <p>Thank you for shopping with Fresh Chicken. Your order has been received and is now being processed.</p>
        <a href="index.html" class="btn-home">Back to Home</a>
    </div>

</body>

</html>
