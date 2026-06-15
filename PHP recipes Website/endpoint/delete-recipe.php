<?php
include('../conn/conn.php');

if (isset($_GET['recipe'])) {
    $recipeID = $_GET['recipe'];

// Ανάκτηση στο όνομα αρχείου εικόνας συνταγής
    $stmt = $conn->prepare("SELECT `recipe_image` FROM `tbl_recipe` WHERE `tbl_recipe_id` = ?");
    $stmt->execute([$recipeID]);
    $row = $stmt->fetch();

    $recipeImage = $row['recipe_image'];

    // Διαγράφη της συνταγής από τη βάση δεδομένων
    $stmt = $conn->prepare("DELETE FROM `tbl_recipe` WHERE `tbl_recipe_id` = ?");
    if ($stmt->execute([$recipeID])) {
        // Διαγράφη του σχετικού αρχείου εικόνας
        if (!empty($recipeImage)) {
            $imagePath = "../uploads/" . $recipeImage;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

    // Ανακατεύθυνση στη σελίδα όπου θέλετε να εμφανιστεί η ενημερωμένη λίστα συνταγών
    echo "<script>
        alert('Deleted Successfully'); 
        window.location.href = 'http://localhost/project/index.php#food';
        </script>";
        exit();
    } else {
    // Χειρισμός σφάλματος βάσης δεδομένων      
    echo "<script>
        alert('Failed to delete recipe.'); 
        window.location.href = 'http://localhost/project/index.php#food';
        </script>";
        exit();
    }
} else {
    // Χειρισμός μη έγκυρου αιτήματος
    echo "<script>
    alert('Invalid request.'); 
    window.location.href = 'http://localhost/project/index.php#food';
    </script>";
    exit();
}
?>
