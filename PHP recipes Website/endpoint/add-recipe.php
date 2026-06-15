<?php
session_start();
include('../conn/conn.php');

// Έλεγχος αν ο χρήστης έχει συνδεθεί
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('You must be logged in to add a recipe.'); 
        window.location.href = 'http://localhost/tastybytes/login.php';
        </script>";
    exit();
}

if (isset($_POST['submit'])) {
     // Καθαρισμός και επικύρωση των δεδομένων εισόδου
    $recipeName = htmlspecialchars($_POST['recipe_name']);
    $recipeCategory = htmlspecialchars($_POST['tbl_category_id']);
    $recipeIngredients = htmlspecialchars($_POST['recipe_ingredients']);
    $recipeProcedure = htmlspecialchars($_POST['recipe_procedure']);

   // Έλεγχος εάν όλα τα απαιτούμενα πεδία έχουν συμπληρωθεί
    if (empty($recipeName) || empty($recipeCategory) || empty($recipeIngredients) || empty($recipeProcedure)) {
        echo "<script>
            alert('Please fill in all required fields.'); 
            window.location.href = 'http://localhost/tastybytes/index.php#food';
            </script>";
        exit();
    }

    // Έλεγχος εάν έχει ανέβει ένα αρχείο
    if (!isset($_FILES['recipe_image'])) {
        echo "<script>
            alert('Please select an image.'); 
            window.location.href = 'http://localhost/tastybytes/index.php#food';
            </script>";
        exit();
    }

    $recipeImageName = $_FILES['recipe_image']['name'];
    $recipeImageTmpName = $_FILES['recipe_image']['tmp_name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($recipeImageName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Έλεγχος εάν το αρχείο εικόνας είναι πραγματική εικόνα ή ψεύτικη εικόνα
    $check = getimagesize($recipeImageTmpName);
    if ($check === false) {
        echo "<script>
            alert('File is not an image.'); 
            window.location.href = 'http://localhost/tastybytes/index.php#food';
            </script>";
        exit();
    }

    // Έλεγχος μεγέθους αρχείου
    if ($_FILES["recipe_image"]["size"] > 500000) {
        echo "<script>
            alert('Sorry, your file is too large.'); 
            window.location.href = 'http://localhost/tastybytes/index.php#food';
            </script>";
        exit();
    }

    // Επιτρέπονται μόνο κάποιες μορφές αρχείων
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script>
            alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); 
            window.location.href = 'http://localhost/tastybytes/index.php#food';
            </script>";
        exit();
    }

    // Έλεγχος εάν το αρχείο υπάρχει ήδη
    if (file_exists($target_file)) {
        echo "<script>
            alert('Sorry, file already exists.'); 
            window.location.href = 'http://localhost/tastybytes/index.php#food';
            </script>";
        exit();
    }

    // Ανέβασμα του αρχείου εικόνας
    if (move_uploaded_file($recipeImageTmpName, $target_file)) {
        
        // Εισαγωγή συνταγής στη βάση δεδομένων
        $stmt = $conn->prepare("INSERT INTO `tbl_recipe` (`tbl_recipe_id`, `tbl_category_id`, `recipe_image`, `recipe_name`, `recipe_ingredients`, `recipe_procedure`) VALUES (NULL, :recipeCategory, :recipeImage, :recipeName, :recipeIngredients, :recipeProcedure)");
        $stmt->bindParam(':recipeCategory', $recipeCategory);
        $stmt->bindParam(':recipeImage', $recipeImageName);
        $stmt->bindParam(':recipeName', $recipeName);
        $stmt->bindParam(':recipeIngredients', $recipeIngredients);
        $stmt->bindParam(':recipeProcedure', $recipeProcedure);

        if ($stmt->execute()) {
            echo "<script>
                alert('Successfully Added'); 
                window.location.href = 'http://localhost/tastybytes/index.php#food';
                </script>";
            exit();
        } else {
            echo "<script>
                alert('Failed to add recipe.'); 
                window.location.href = 'http://localhost/tastybytes/index.php#food';
                </script>";
            exit();
        }
    } else {
        echo "<script>
            alert('Failed to upload image.'); 
            window.location.href = 'http://localhost/tastybytes/index.php#food';
            </script>";
        exit();
    }
} else {
    echo "<script>
        alert('Access denied.'); 
        window.location.href = 'http://localhost/tastybytes/index.php#food';
        </script>";
    exit();
}
?>
