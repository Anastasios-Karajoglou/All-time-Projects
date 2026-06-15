<?php
session_start(); // Ξεκινά η συνεδρία

// Σύνδεση με τη βάση δεδομένων
$conn = new mysqli('localhost', 'root', '', 'eshop_cart_products');
if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error); // Έλεγχος σύνδεσης και εμφάνιση σφάλματος αν αποτύχει
}

// Έλεγχος αν η μέθοδος αιτήματος είναι POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Έλεγχος αν ο χρήστης είναι συνδεδεμένος
    if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Ανακατεύθυνση στη σελίδα σύνδεσης αν ο χρήστης δεν είναι συνδεδεμένος
        exit();
    }

    // Έλεγχος αν υπάρχει product_id στο POST αίτημα
    if (isset($_POST['product_id'])) {
        $user_id = $_SESSION['user_id']; // Διασφαλίστε ότι αυτό έχει οριστεί κατά τη σύνδεση
        $product_id = intval($_POST['product_id']); // Λήψη του product_id από το POST αίτημα και μετατροπή σε ακέραιο
        $quantity = 1; // Ορίστε την ποσότητα (μπορείτε να την προσαρμόσετε ή να την κάνετε δυναμική)

        // Προετοιμασία της SQL εντολής για εισαγωγή ή ενημέρωση της ποσότητας στο καλάθι
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
        $stmt->bind_param('iii', $user_id, $product_id, $quantity); // Δέσμευση των παραμέτρων

        // Εκτέλεση της εντολής και έλεγχος για σφάλματα
        if ($stmt->execute()) {
            header("Location: cart.php"); // Ανακατεύθυνση στη σελίδα καλαθιού αν η εισαγωγή ήταν επιτυχής
            exit();
        } else {
            echo "Σφάλμα κατά την προσθήκη στο καλάθι."; // Εμφάνιση μηνύματος σφάλματος αν η εισαγωγή αποτύχει
        }

        $stmt->close(); // Κλείσιμο του statement
    } elseif (isset($_POST['remove_item'])) {
        $user_id = $_SESSION['user_id']; // Διασφαλίστε ότι αυτό έχει οριστεί κατά τη σύνδεση
        $remove_item_id = intval($_POST['remove_item']); // Λήψη του ID του προϊόντος για αφαίρεση και μετατροπή σε ακέραιο

        // Προετοιμασία της SQL εντολής για διαγραφή του προϊόντος από το καλάθι
        $delete_stmt = $conn->prepare("DELETE FROM cart WHERE product_id = ? AND user_id = ?");
        $delete_stmt->bind_param('ii', $remove_item_id, $user_id); // Δέσμευση των παραμέτρων

        // Εκτέλεση της εντολής και έλεγχος για σφάλματα
        if ($delete_stmt->execute()) {
            header("Location: cart.php"); // Ανακατεύθυνση στη σελίδα καλαθιού αν η διαγραφή ήταν επιτυχής
            exit();
        } else {
            echo "Σφάλμα κατά την αφαίρεση του προϊόντος από το καλάθι."; // Εμφάνιση μηνύματος σφάλματος αν η διαγραφή αποτύχει
        }

        $delete_stmt->close(); // Κλείσιμο του statement
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Καλάθι</title>
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
    <h2>Το Καλάθι Μου</h2>
    <?php
    // Ελέγχουμε αν ο χρήστης είναι συνδεδεμένος
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Διασφαλίζουμε ότι έχει οριστεί το user_id κατά τη σύνδεση
        $cart_query = "SELECT products.id AS product_id, products.name, products.price, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
        $stmt = $conn->prepare($cart_query);
        $stmt->bind_param('i', $user_id); // Δέσμευση του user_id παραμέτρου στην SQL εντολή
        $stmt->execute(); // Εκτέλεση της εντολής
        $result = $stmt->get_result(); // Λήψη των αποτελεσμάτων
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Προϊόν</th>
                <th>Τιμή</th>
                <th>Ποσότητα</th>
                <th>Σύνολο</th>
                <th>Δράση</th> <!-- Προστέθηκε η κεφαλίδα για το κουμπί διαγραφής -->
            </tr>
        </thead>
        <tbody>
    <?php
    $total = 0; // Αρχικοποίηση του συνολικού ποσού
    // Επανάληψη για κάθε προϊόν στο καλάθι
    while ($row = $result->fetch_assoc()):
        $subtotal = $row['price'] * $row['quantity']; // Υπολογισμός του υποσυνόλου για το κάθε προϊόν
        $total += $subtotal; // Προσθήκη του υποσυνόλου στο συνολικό ποσό
    ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?>€</td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td><?php echo htmlspecialchars($subtotal); ?>€</td>
            <td>
                <!-- Φόρμα για αφαίρεση προϊόντος από το καλάθι -->
                <form method="POST" action="cart.php">
                    <input type="hidden" name="remove_item" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                    <button type="submit" class="btn btn-danger">Αφαίρεση</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    <!-- Προσθήκη γραμμής για το συνολικό ποσό -->
    <tr>
        <td colspan="4" class="text-right">Σύνολο</td>
        <td><?php echo htmlspecialchars($total); ?>€</td>
    </tr>
</tbody>
    </table>
    <?php
    } else {
        // Εμφάνιση μηνύματος αν ο χρήστης δεν είναι συνδεδεμένος
        echo "<p>Πρέπει να συνδεθείτε για να δείτε το καλάθι σας.</p>";
    }
    ?>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
    <div class="container">
        <p>&copy; 2024 BuildMyRig. Με επιφύλαξη παντός δικαιώματος.</p>
    </div>
</footer>

</body>
</html>

<?php
// Κλείσιμο της σύνδεσης μετά την απόδοση του περιεχομένου HTML
$conn->close();
?>
