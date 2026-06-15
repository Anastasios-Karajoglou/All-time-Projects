<?php
$main_db_host  = '127.0.0.1';
$main_db_name    = 'eshop_cart_products';
$main_db_username  = 'Anastasis';
$main_db_password  = '123';

// Δημιουργία σύνδεσης με τη βάση δεδομένων των χρηστών
$main_db_conn = new mysqli($main_db_host, $main_db_username, $main_db_password, $main_db_name);
// Έλεγχος αν η σύνδεση με τη βάση δεδομένων απέτυχε

if ($main_db_conn->connect_error) {
    die("Connection failed: " . $main_db_conn->connect_error);// Εμφάνιση μηνύματος λάθους και διακοπή εκτέλεσης
}
?>
