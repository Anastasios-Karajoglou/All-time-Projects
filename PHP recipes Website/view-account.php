<?php
session_start(); // Ξεκινά η συνεδρία
require 'config.php'; // Εισαγωγή της σύνδεσης με τη βάση δεδομένων

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Ανακατεύθυνση στη σελίδα εισόδου αν δεν είναι συνδεδεμένος
    exit(); // Τερματισμός του script
}

$user_id = $_SESSION['user_id']; // Παίρνει το user_id από τη συνεδρία

// Ανάκτηση πληροφοριών χρήστη από τη βάση δεδομένων
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]); // Εκτέλεση της SQL εντολής με την τιμή του user_id
$user = $stmt->fetch(PDO::FETCH_ASSOC); // Ανάκτηση του αποτελέσματος ως συσχετιζόμενος πίνακας

// Έλεγχος αν ο χρήστης υπάρχει στη βάση δεδομένων
if (!$user) {
    echo "User not found."; // Μήνυμα αν ο χρήστης δεν βρέθηκε
    exit(); // Τερματισμός του script
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Account</title>
    <link rel="stylesheet" type="text/css" href="styling.css">
</head>
<body>
    <div class="header">
        <h2>My Account</h2>
    </div>
    <div class="content">
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <a href="edit-account.php">Edit Account</a>
    </div>
</body>
</html>
