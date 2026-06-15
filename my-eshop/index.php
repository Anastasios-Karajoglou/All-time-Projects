<?php
session_start(); // Ξεκινάει μια νέα συνεδρία 

include('eshop_users.php'); // Συμπεριλαμβάνει το αρχείο διαμόρφωσης βάσης δεδομένων

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BuildMyRig</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    
<header class="bg-dark text-white">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding: 15px 0;">
            <a class="navbar-brand" href="index.php">
                <span style="color: red;">BuildMyRig</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Προϊόντα</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Καλάθι</a>
                    </li>
                    <!-- Έλεγχος αν ο χρήστης είναι συνδεδεμένος -->
                    <?php if (isset($_SESSION['username'])): ?>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Αποσύνδεση</a>
                        <li class="nav-item">
                            <a class="nav-link" href="add_product.php">Προσθήκη Προϊόντος</a>
                        </li>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Σύνδεση</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Εγγραφή</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
</body>
<div class="fullscreen-bg">
    <img src="images/logo.png" alt="Fullscreen Background">
</div>

<div class="container mt-4">
    <!-- Εμφάνιση μηνύματος καλωσορίσματος αν ο χρήστης είναι συνδεδεμένος -->
    <?php if (isset($_SESSION['username'])): ?>
        <div class="alert alert-success">
            Καλώς ήρθες, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </div>
    <?php endif; ?>

    <div class="jumbotron text-center">
        <h1 class="display-4">Καλώς ήρθατε στο BuildMyRig!</h1>
        <p class="lead">Τα καλύτερα κομμάτια υπολογογιστή στις καλύτερες τιμές!</p>
        <a class="btn btn-primary btn-lg" href="products.php" role="button">Δείτε τα Προϊόντα μας</a>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
    <!-- Υποσέλιδο με πληροφορίες πνευματικών δικαιωμάτων -->
    <div class="container">
        <p>&copy; 2024 BuildMyRig. All rights reserved.</p>
    </div>
</footer>

</body>
</html>