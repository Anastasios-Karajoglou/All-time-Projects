<?php
$users_db_host  = '127.0.0.1';
$users_db_name    = 'eshop_users';
$users_db_username  = 'Anastasis';
$users_db_password  = '123';

// Δημιουργία σύνδεσης με τη βάση δεδομένων των χρηστών
$users_db_conn = new mysqli($users_db_host, $users_db_username, $users_db_password, $users_db_name);

// Έλεγχος αν η σύνδεση με τη βάση δεδομένων απέτυχε
if ($users_db_conn->connect_error) {
    die("Connection failed: " . $users_db_conn->connect_error);// Εμφάνιση μηνύματος λάθους και διακοπή εκτέλεσης
}
?>
