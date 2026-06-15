<?php
session_start();
require 'config.php'; // Εισαγωγή της σύνδεσης με τη βάση δεδομένων

// Ελέγχει αν η φόρμα υποβλήθηκε μέσω POST αιτήματος
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['username']); // Παίρνει και αφαιρεί κενά από το input για το όνομα χρήστη/email
    $password = trim($_POST['password']); // Παίρνει και αφαιρεί κενά από το input για τον κωδικό πρόσβασης

    // Προετοιμασία SQL εντολής για ανάκτηση του χρήστη από τη βάση δεδομένων χρησιμοποιώντας το όνομα χρήστη ή το email
    $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$login, $login]); // Εκτέλεση της SQL εντολής με τις τιμές του login
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Ανάκτηση του αποτελέσματος ως συσχετιζόμενος πίνακας

    // Έλεγχος αν ο χρήστης υπάρχει και αν ο κωδικός πρόσβασης είναι σωστός
    if ($user && password_verify($password, $user['password'])) {
        // Ο κωδικός είναι σωστός, δημιουργία συνεδρίας
        $_SESSION['user_id'] = $user['id']; // Αποθήκευση του id του χρήστη στη συνεδρία
        $_SESSION['username'] = $user['username']; // Αποθήκευση του ονόματος χρήστη στη συνεδρία
        header("Location:index.php"); // Ανακατεύθυνση στην αρχική σελίδα
        exit(); // Τερματισμός του script
    } else {
        // Αν τα στοιχεία είναι λάθος, εμφάνιση μηνύματος σφάλματος
        $error_message = "Invalid username/email or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="styling.css">
</head>
<body>
  <div class="header">
    <h2>Login</h2>
  </div>
  <form method="post" action="login.php">
    <?php
      if (isset($error_message)) {
        echo '<div class="error">' . htmlspecialchars($error_message) . '</div>';
      }
    ?>
    <div class="input-group">
      <label>Username or Email</label>
      <input type="text" name="username" required>
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
</body>
</html>
