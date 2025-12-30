<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fresh-chicken: Payment Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome & Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap & Main CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .payment-option {
            max-width: 600px;
            margin: 0 auto;
            transition: 0.3s;
        }

        .payment-option:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 128, 0, 0.1);
        }

        .payment-option h4 i {
            font-size: 22px;
        }
    </style>
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
                <small><i class="fa fa-map-marker-alt me-2"></i>Karwar, KARANATAKA, INDIA</small>
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

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">F<span class="text-secondary">resh</span>Chicken</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="Contact.php" class="nav-item nav-link active">Contact Us</a>
                </div>
                <div class="d-none d-lg-flex ms-2">
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="#"><small class="fa fa-search text-body"></small></a>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="#"><small class="fa fa-user text-body"></small></a>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="#"><small class="fa fa-shopping-bag text-body"></small></a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Payment Dashboard Start -->
    <div class="container py-5 mt-5">
        <h2 class="text-center mb-4 text-success">Choose Your Payment Method</h2>

        <!-- COD -->
        <div class="payment-option border rounded p-4 mb-4 shadow-sm bg-white">
            <h4 class="text-warning mb-3"><i class="fas fa-money-bill-wave me-2"></i>Cash on Delivery (COD)</h4>
            <form action="process_cod.php" method="POST">
                <p class="text-muted">You will pay when the order is delivered to your address.</p>
                <button type="submit" class="btn btn-warning w-100 rounded-pill">Choose COD</button>
            </form>
        </div>

        <!-- UPI -->
        <div class="payment-option border rounded p-4 mb-4 shadow-sm bg-white">
            <h4 class="text-info mb-3"><i class="fas fa-mobile-alt me-2"></i>UPI (PhonePe)</h4>
            <form action="process_upi.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">UPI ID</label>
                    <input type="text" class="form-control" name="upi_id" placeholder="example@upi" required>
                </div>
                <button type="submit" class="btn btn-info w-100 rounded-pill">Pay with UPI</button>
            </form>
        </div>

        <!-- Card -->
        <div class="payment-option border rounded p-4 mb-4 shadow-sm bg-white">
            <h4 class="text-primary mb-3"><i class="fas fa-credit-card me-2"></i>Card Payment</h4>
            <form action="process_card.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Card Number</label>
                    <input type="text" class="form-control" name="card_number" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Card Holder</label>
                    <input type="text" class="form-control" name="card_holder" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Expiry</label>
                        <input type="text" class="form-control" name="expiry" placeholder="MM/YY" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CVV</label>
                        <input type="password" class="form-control" name="cvv" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100 rounded-pill">Pay with Card</button>
            </form>
        </div>
    </div>
    <!-- Payment Dashboard End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer pt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h1 class="fw-bold text-primary m-0">F<span class="text-secondary">resh</span>Chicken</h1>
                    <p>Quality fresh chicken delivered to your doorstep.</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="#"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, Karwar, India</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+91 9876543210</p>
                    <p><i class="fa fa-envelope me-3"></i>fresh_chicken@gmail.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="about.html">About Us</a>
                    <a class="btn btn-link" href="contact.php">Contact Us</a>
                    <a class="btn btn-link" href="#">Terms & Conditions</a>
                    <a class="btn btn-link" href="#">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>Subscribe for latest offers and updates.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
