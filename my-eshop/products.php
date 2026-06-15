<?php
session_start(); // Ξεκινάει μια νέα συνεδρία ή συνεχίζει την υπάρχουσα

include('eshop_cart_products.php'); // Συμπεριλαμβάνει τη βασική διαμόρφωση της βάσης δεδομένων

// Ανάκτηση όλων των κατηγοριών προϊόντων
$categories_result = $main_db_conn->query("SELECT * FROM categories");
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row;
}

// Ανάκτηση προϊόντων βάσει κατηγορίας
$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;
$products_query = "SELECT * FROM products";
if ($category_id > 0) {
    $products_query .= " WHERE category_id = $category_id";
}
$products_result = $main_db_conn->query($products_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Προϊόντα</title>
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
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Αποσύνδεση</a>
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

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
             <!-- Πλευρικό μενού κατηγοριών προϊόντων -->
            <h4>Κατηγορίες</h4>
            <ul class="list-group">
                <li class="list-group-item"><a href="products.php">Όλα</a></li>
                <?php foreach ($categories as $category): ?>
                    <li class="list-group-item"><a href="products.php?category=<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-9">
            <h2>Προϊόντα</h2>
            <div class="row">
                <?php if ($products_result->num_rows > 0): ?>
                    <?php while ($row = $products_result->fetch_assoc()): ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                    <!-- Κύριο περιεχόμενο με λίστα προϊόντων -->
                                <img class="card-img-top product-image" src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                                    <p class="card-text">Τιμή: <?php echo htmlspecialchars($row['price']); ?>€</p>
                                    <form method="POST" action="cart.php">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <button type="submit" class="btn btn-primary">Προσθήκη στο Καλάθι</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Δεν βρέθηκαν προϊόντα.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
    <!-- Υποσέλιδο με πληροφορίες πνευματικών δικαιωμάτων -->
    <div class="container">
        <p>&copy; 2024 BuildMyRig. Με επιφύλαξη παντός δικαιώματος.</p>
    </div>
</footer>


</body>
</html>
