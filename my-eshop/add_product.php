<?php
session_start(); // Ξεκινάει μια νέα συνεδρία
include('eshop_cart_products.php'); // Συμπεριλαμβάνει το αρχείο διαμόρφωσης της βάσης δεδομένων

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Έλεγχος εάν η φόρμα υποβάλλεται με μέθοδο POST
    $name = $_POST['name']; // Ανάκτηση ονόματος προϊόντος από τη φόρμα
    $description = $_POST['description']; // Ανάκτηση περιγραφής προϊόντος από τη φόρμα
    $price = $_POST['price']; // Ανάκτηση τιμής προϊόντος από τη φόρμα
    $category = $_POST['category']; // Ανάκτηση κατηγορίας προϊόντος από τη φόρμα

    // Χειρισμός ανέβασματος αρχείου
    $target_dir = "uploads/"; // Κατάλογος όπου θα αποθηκευτούν οι εικόνες
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Διαδρομή προς την ανεβασμένη εικόνα
    $uploadOk = 1; // Σημαία που υποδεικνύει επιτυχία ή αποτυχία του ανεβάσματος αρχείου
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Τύπος αρχείου εικόνας
    $error_message = ""; // Μήνυμα σφάλματος

    // Έλεγχος εάν το αρχείο εικόνας είναι πραγματική εικόνα ή ψεύτικη
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $error_message .= "File is not an image.<br>"; // Προσθήκη μηνύματος σφάλματος
        $uploadOk = 0;
    }

    // Έλεγχος μεγέθους αρχείου
    if ($_FILES["image"]["size"] > 500000) {
        $error_message .= "Sorry, your file is too large.<br>"; // Προσθήκη μηνύματος σφάλματος
        $uploadOk = 0;
    }

    // Επιτρεπόμενοι τύποι αρχείων
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $error_message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>"; // Προσθήκη μηνύματος σφάλματος
        $uploadOk = 0;
    }

    // Έλεγχος εάν η μεταβλητή $uploadOk έχει τεθεί σε 0 από κάποιο σφάλμα
    if ($uploadOk == 0) {
        $error_message .= "Sorry, your file was not uploaded.<br>"; // Προσθήκη μηνύματος σφάλματος
    // Εάν όλα είναι εντάξει, προσπαθήστε να ανεβάσετε το αρχείο
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;

            // Εκτέλεση εντολής SQL για εισαγωγή νέου προϊόντος
            $sql = "INSERT INTO products (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $main_db_conn->prepare($sql);
            $stmt->bind_param("ssiss", $name, $description, $price, $category_id, $image);

            if ($stmt->execute()) {
                $success_message = "New product added successfully"; // Επιτυχής προσθήκη νέου προϊόντος
            } else {
                $error_message .= "Error: " . $sql . "<br>" . $main_db_conn->error; // Μήνυμα σφάλματος
            }

            $stmt->close();
        } else {
            $error_message .= "Sorry, there was an error uploading your file.<br>";
        }
    }
}

$main_db_conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Προσθήκη Προϊόντος</title>
    <link rel="stylesheet" href="stylescss">
</head>
<body>
    <div class="container mt-5">
        <h2>Προσθήκη Προϊόντος</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Όνομα Προϊόντος:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Περιγραφή Προϊόντος:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Τιμή Προϊόντος:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="category">Κατηγορία Προϊόντος:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="CPU">CPU</option>
                    <option value="GPU">GPU</option>
                    <option value="Motherboard">Motherboard</option>
                    <option value="RAM">RAM</option>
                    <option value="Storage">Storage</option>
                    <option value="Power Supply">Power Supply</option>
                    <option value="Case">Case</option>
                    <option value="Cooling">Cooling</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Εικόνα Προϊόντος:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Προσθήκη Προϊόντος</button>
            <a href="index.php" class="btn btn-secondary">Επιστροφή στην Αρχική</a>
        </form>
    </div>
</body>
</html>
