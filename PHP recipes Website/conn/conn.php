<?php 

$servername = 'localhost'; // Ορισμός του ονόματος του διακομιστή, συνήθως 'localhost'
$username = 'root'; // Ορισμός του ονόματος χρήστη για τη σύνδεση στη βάση δεδομένων
$password = ''; // Ορισμός του κωδικού πρόσβασης για τη σύνδεση στη βάση δεδομένων
$db = 'food_recipe_db'; // Ορισμός του ονόματος της βάσης δεδομένων που θέλουμε να συνδεθούμε

try {
    $conn =  new PDO("mysql:host=$servername;dbname=$db", $username, $password); // Προσπάθεια σύνδεσης στη βάση δεδομένων χρησιμοποιώντας το PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ορισμός του τρόπου αντιμετώπισης σφαλμάτων ως εξαιρέσεις
    echo 'Connection successful'; // Εάν η σύνδεση επιτύχει, εκτύπωση μηνύματος επιτυχούς σύνδεσης
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage(); // Εάν υπάρξει σφάλμα κατά τη σύνδεση, εκτύπωση του σφάλματος
}

?>

