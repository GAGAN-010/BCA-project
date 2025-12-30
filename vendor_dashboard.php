<?php
session_start();

if (!isset($_SESSION['VENDOR_EMAIL'])) {
    echo "<script>alert('Please login first.'); window.location='vlogin.php';</script>";
    exit();
}

$email = $_SESSION['VENDOR_EMAIL'] ?? 'Email not available';
$vendorname = $_SESSION['VENDOR_NAME'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Vendor Dashboard - FreshChicken</title>
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
            <a class="text-body ms-3" href="#"><i class="fab fa-facebook-f"></i></a>
            <a class="text-body ms-3" href="#"><i class="fab fa-twitter"></i></a>
            <a class="text-body ms-3" href="#"><i class="fab fa-linkedin-in"></i></a>
            <a class="text-body ms-3" href="#"><i class="fab fa-instagram"></i></a>
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
                <a href="index.html" class="nav-item nav-link">Home</a>
                <a href="Product.html" class="nav-item nav-link">Products</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<!-- Vendor Dashboard Start -->
<div class="container-xxl py-5 mt-5">
    <div class="container">
        <div class="bg-white p-4 shadow rounded wow fadeInUp" data-wow-delay="0.2s">
            <h2 class="text-primary mb-4">Welcome, <?php echo htmlspecialchars($vendorname); ?>!</h2>
            <div class="row justify-content-center g-4">
                <!-- Add Chicken Card -->
                <div class="col-md-5 col-sm-10">
                    <div class="bg-light p-4 text-center rounded h-100">
                        <i class="fa fa-plus-square fa-2x text-secondary mb-3"></i>
                        <h5 class="mb-2">Add Chicken</h5>
                        <p>Upload and manage chicken stock and details.</p>
                        <a href="uploadchicken.php" class="btn btn-outline-primary btn-sm rounded-pill px-4">Upload</a>
                    </div>
                </div>
                <!-- View Orders Card -->
                <div class="col-md-5 col-sm-10">
                    <div class="bg-light p-4 text-center rounded h-100">
                        <i class="fa fa-truck fa-2x text-secondary mb-3"></i>
                        <h5 class="mb-2">View Orders</h5>
                        <p>Check customer orders and delivery status.</p>
                        <a href="vendor_view_orders.php" class="btn btn-outline-primary btn-sm rounded-pill px-4">Orders</a>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="logout.php" class="btn btn-danger rounded-pill px-4">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Vendor Dashboard End -->


<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer mt-5 pt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white mb-3">FreshChicken</h4>
                <p>Trusted by vendors for simple stock management and real-time order tracking.</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white mb-3">Vendor Links</h4>
                <a class="btn btn-link text-light" href="vendor_dashboard.php">Dashboard</a><br>
                <a class="btn btn-link text-light" href="upload_product.php">Add Product</a><br>
                <a class="btn btn-link text-light" href="vendor_orders.php">Orders</a><br>
                <a class="btn btn-link text-light" href="logout.php">Logout</a>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white mb-3">Contact</h4>
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
