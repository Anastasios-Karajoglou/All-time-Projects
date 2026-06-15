<?php
include('../conn/conn.php');

// Ελέγχει αν το αναγνωριστικό της συνταγής είναι ορισμένο και αν τα πεδία της φόρμας έχουν υποβληθεί
if (isset($_POST['tbl_recipe_id']) && isset($_POST['recipe_name']) && isset($_POST['tbl_category_id']) && isset($_POST['recipe_ingredients']) && isset($_POST['recipe_procedure'])) {

    $recipeID = $_POST['tbl_recipe_id'];
    $updateRecipeName = $_POST['recipe_name'];
    $updateRecipeCategory = $_POST['tbl_category_id'];
    $updateRecipeIngredients = $_POST['recipe_ingredients'];
    $updateRecipeProcedure = $_POST['recipe_procedure'];

    // Ελέγχει αν έχει ανέβει νέο αρχείο εικόνας
    if ($_FILES['recipe_image']['tmp_name'] != "") {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($_FILES['recipe_image']['name']);
        
        // Μετακινεί το ανεβασμένο αρχείο εικόνας στον καθορισμένο κατάλογο
        if (move_uploaded_file($_FILES['recipe_image']['tmp_name'], $targetFile)) {
            // Ενημέρωση των πληροφοριών της συνταγής συμπεριλαμβανομένης και της εικόνας
            $stmt = $conn->prepare("UPDATE tbl_recipe SET recipe_name = ?, tbl_category_id = ?, recipe_image = ?, recipe_ingredients = ?, recipe_procedure = ? WHERE tbl_recipe_id = ?");
            $stmt->execute([$updateRecipeName, $updateRecipeCategory, $_FILES['recipe_image']['name'], $updateRecipeIngredients, $updateRecipeProcedure, $recipeID]);
        } else {
            // Χειρισμός σφάλματος μεταφοράς αρχείου
            echo "<script>
            alert('Failed to upload image.'); 
            window.location.href = 'http://localhost/project/index.php#food';
            </script>";
            exit();
        }
    } else {
        // Ενημέρωση των πληροφοριών της συνταγής χωρίς αλλαγή στην εικόνα
        $stmt = $conn->prepare("UPDATE tbl_recipe SET recipe_name = ?, tbl_category_id = ?, recipe_ingredients = ?, recipe_procedure = ? WHERE tbl_recipe_id = ?");
        $stmt->execute([$updateRecipeName, $updateRecipeCategory, $updateRecipeIngredients, $updateRecipeProcedure, $recipeID]);
    }

    // Ανακατεύθυνση πίσω στην κύρια σελίδα μετά την ενημέρωση
    echo "<script>
    alert('Updated Successfully'); 
    window.location.href = 'http://localhost/project/index.php#food';
    </script>";
    exit();
} else {
    // Χειρισμός μη έγκυρου αιτήματος
    echo "<script>
    alert('Invalid request.'); 
    window.location.href = 'http://localhost/project/index.php#food';
    </script>";
    exit();
}
?>
