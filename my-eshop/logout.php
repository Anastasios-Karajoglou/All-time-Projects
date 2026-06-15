<?php
session_start();
session_destroy(); // Καταστροφή της συνεδρίας

// Ανακατεύθυνση στην αρχική σελίδα ή στη σελίδα σύνδεσης
header("Location: index.php");
exit();
?>

<?php if (isset($_SESSION['username'])): ?>
    <li class="nav-item">
        <a class="nav-link" href="logout.php">Αποσύνδεση</a>
    </li>
<?php endif; ?>
