<?php
session_start(); // Ξεκινάει μια νέα συνεδρία 

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Ελέγχει αν η φόρμα υποβλήθηκε με τη μέθοδο POST
    // Λήψη δεδομένων φόρμας
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Έλεγχος αν το όνομα χρήστη υπάρχει ήδη
    $conn = new mysqli('localhost', 'root', '', 'eshop_users'); // Σύνδεση με τη βάση δεδομένων
    if ($conn->connect_error) {
        die("Σφάλμα σύνδεσης: " . $conn->connect_error); // Εμφάνιση μηνύματος λάθους και διακοπή εκτέλεσης αν αποτύχει η σύνδεση
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?"); // Προετοιμασία δήλωσης για έλεγχο του ονόματος χρήστη
    $stmt->bind_param("s", $username); // Δέσμευση παραμέτρου
    $stmt->execute(); // Εκτέλεση της δήλωσης
    $result = $stmt->get_result(); // Λήψη αποτελέσματος
    if ($result->num_rows > 0) { // Έλεγχος αν βρέθηκαν αποτελέσματα
        echo "Το όνομα χρήστη υπάρχει ήδη."; // Εμφάνιση μηνύματος αν το όνομα χρήστη υπάρχει ήδη
        $stmt->close(); // Κλείσιμο της δήλωσης
        $conn->close(); // Κλείσιμο της σύνδεσης
        exit(); // Διακοπή εκτέλεσης
    }
    $stmt->close(); // Κλείσιμο της δήλωσης

    // Κρυπτογράφηση του κωδικού πρόσβασης
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Εισαγωγή νέου χρήστη στη βάση δεδομένων
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)"); // Προετοιμασία δήλωσης εισαγωγής
    $stmt->bind_param("sss", $username, $hashed_password, $email); // Δέσμευση παραμέτρων
    if ($stmt->execute()) { // Εκτέλεση της δήλωσης
        $_SESSION['username'] = $username; // Ορισμός της συνεδρίας του χρήστη
        header("Location: index.php"); // Ανακατεύθυνση στην αρχική σελίδα
        exit(); // Διακοπή εκτέλεσης
    } else {
        echo "Σφάλμα: " . $stmt->error; // Εμφάνιση μηνύματος λάθους αν η εισαγωγή αποτύχει
    }
    $stmt->close(); // Κλείσιμο της δήλωσης
    $conn->close(); // Κλείσιμο της σύνδεσης
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
