<?php
session_start();
if (!isset($_SESSION['USER'])) {
    echo "<script>alert('Please login first.'); window.location='login.php';</script>";
    exit();
}
$username = $_SESSION['USER'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Foody - Organic Chicken Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheets -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap & Custom Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<!-- Spinner -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status"></div>
</div>

<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>Karwar, Karnataka, India</small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i>freshchicken@gmail.com</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0">Fr<span class="text-secondary">esh</span>chicken</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About us</a>
                <a href="Product.html" class="nav-item nav-link">Products</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Customer</a>
                    <div class="dropdown-menu m-0">
                        <a href="customer_signup.php" class="dropdown-item">SignUp</a>
                        <a href="login.php" class="dropdown-item">Login</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Chicken-shop</a>
                    <div class="dropdown-menu m-0">
                        <a href="vendor_signup.php" class="dropdown-item">SignUp</a>
                        <a href="vlogin.php" class="dropdown-item">Login</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Feedback</a>
            </div>
            <div class="d-none d-lg-flex ms-2">
                <a class="btn-sm-square bg-white rounded-circle ms-3" href=""><small class="fa fa-search text-body"></small></a>
                <a class="btn-sm-square bg-white rounded-circle ms-3" href=""><small class="fa fa-user text-body"></small></a>
                <a class="btn-sm-square bg-white rounded-circle ms-3" href=""><small class="fa fa-shopping-bag text-body"></small></a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<!-- Dashboard Start -->
<div class="container-xxl py-5 mt-5">
    <div class="container">
        <div class="bg-white p-4 shadow rounded wow fadeInUp" data-wow-delay="0.2s">
            <h2 class="text-primary mb-4">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="bg-light p-4 text-center rounded">
                        <i class="fa fa-user fa-2x text-secondary mb-3"></i>
                        <h5 class="mb-2">Place Order</h5>
                        <p>View Chicken Items</p>
                        <a href="viewallchicken.php" class="btn btn-outline-primary btn-sm rounded-pill">Place Order</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-light p-4 text-center rounded">
                        <i class="fa fa-shopping-cart fa-2x text-secondary mb-3"></i>
                        <h5 class="mb-2">My Cart</h5>
                        <p>View and manage items in your cart before checkout.</p>
                        <a href="cart.php" class="btn btn-outline-primary btn-sm rounded-pill">View Cart</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-light p-4 text-center rounded">
                        <i class="fa fa-box fa-2x text-secondary mb-3"></i>
                        <h5 class="mb-2">My Orders</h5>
                        <p>Track your recent and past orders here.</p>
                        <a href="view_orders.php" class="btn btn-outline-primary btn-sm rounded-pill">Order History</a>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="logout.php" class="btn btn-danger rounded-pill px-4">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard End -->

<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer mt-5 pt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white mb-3">FreshChicken</h4>
                <p>Get fresh and hygienic chicken delivered fast, safe, and reliable to your home.</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white mb-3">Quick Links</h4>
                <a class="btn btn-link text-light" href="index.html">Home</a><br>
                <a class="btn btn-link text-light" href="Product.html">Products</a><br>
                <a class="btn btn-link text-light" href="contact.php">Contact</a><br>
                <a class="btn btn-link text-light" href="login.php">Login</a>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white mb-3">Contact Us</h4>
                <p><i class="fa fa-map-marker-alt me-2"></i>Karwar, Karnataka</p>
                <p><i class="fa fa-envelope me-2"></i>freshchicken@gmail.com</p>
                <p><i class="fa fa-phone-alt me-2"></i>+91 98765 43210</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Spinner Script -->
<script>
    window.addEventListener('load', () => {
        const spinner = document.getElementById('spinner');
        if (spinner) {
            spinner.classList.remove('show');
        }
    });
</script>

</body>
</html>
