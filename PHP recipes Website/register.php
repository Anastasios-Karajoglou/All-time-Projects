<?php
session_start(); // Ξεκινάει τη συνεδρία
require 'config.php'; // Περιλαμβάνει το αρχείο σύνδεσης με τη βάση δεδομένων

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Ελέγχει αν το αίτημα είναι POST
    $username = trim($_POST['username']); // Καθαρίζει και αποθηκεύει το όνομα χρήστη από τη φόρμα
    $email = trim($_POST['email']); // Καθαρίζει και αποθηκεύει το email από τη φόρμα
    $password = trim($_POST['password']); // Καθαρίζει και αποθηκεύει τον κωδικό πρόσβασης από τη φόρμα
    $password_hash = password_hash($password, PASSWORD_BCRYPT); // Δημιουργεί το hash του κωδικού πρόσβασης

    // Ελέγχει αν το όνομα χρήστη ή το email είναι ήδη καταχωρημένο
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetchColumn() > 0) {
        echo "Username or email is already taken."; // Εάν υπάρχει ήδη, εκτυπώνει μήνυμα σφάλματος
    } else {
        // Εισάγει το νέο χρήστη στη βάση δεδομένων
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $password_hash])) {
            // Εάν η εγγραφή είναι επιτυχής, ανακατευθύνει στη σελίδα σύνδεσης
            header("Location: login.php");
            exit();
        } else {
            echo "Registration failed."; // Εάν η εγγραφή αποτύχει, εκτυπώνει μήνυμα σφάλματος
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="styling.css">
</head>
<body>
  <div class="header">
    <h2>Register</h2>
  </div>
  
  <form method="post" action="register.php">

    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" value="">
    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" value="">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
      Already a member? <a href="login.php">Sign in</a>
    </p>
  </form>
</body>
</html>
