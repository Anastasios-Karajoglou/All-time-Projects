<?php 
// Ξεκινάμε τη συνεδρία
session_start();
// Συμπεριλαμβάνουμε το αρχείο σύνδεσης με τη βάση δεδομένων
include('conn/conn.php'); 
// Συμπεριλαμβάνουμε το αρχείο για τα μοντάλ
include('assets/modal.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TastyBytes</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand ml-5" href="index.php">TastyBytes</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#category">Food Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#food">Food List</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0 mr-5">
            <?php 
            // Έλεγχος εάν ο χρήστης έχει συνδεθεί
            if(isset($_SESSION['user_id'])) {
               // Ο χρήστης έχει συνδεθεί, εμφάνιση επιλογής προβολής προφιλ και αποσύνδεσης
                echo '<a class="nav-link" href="view-account.php">View Profile</a>
                      <a class="nav-link" href="logout.php">Log Out</a>';
            } else {
                  // Ο χρήστης δεν έχει συνδεθεί, εμφάνιση επιλογών εγγραφής και σύνδεσης
                echo '<a class="nav-link" href="register.php">Register</a>
                      <a class="nav-link" href="login.php">Log In</a>';
            }
            ?>
        </div>
    </div>
</nav>

</body>

</html>


<section id="home"> <!-- Ενότητα αρχικής σελίδας -->
        <div class="main"> <!-- Κύρια περιοχή -->
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel"> <!-- Κυλιόμενη παρουσίαση εικόνων -->
                <ol class="carousel-indicators"> <!-- Δείκτες κυλιόμενης παρουσίασης -->
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li> <!-- Ενεργό σημείο -->
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li> <!-- Σημείο 2 -->
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li> <!-- Σημείο 3 -->
                </ol>
                <div class="carousel-inner"> <!-- Εσωτερικός κύλινδρος -->
                    <div class="carousel-item active"> <!-- Ενεργή εικόνα -->
                        <img src="image/bg4.jpg" class="d-block w-100" alt="..."> <!-- Εικόνα -->
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="caption"><strong>Welcome to TastyBytes</strong></h1>
                            <p class="caption caption-p">Create delicious recipes with ease using our interactive web application. Simply input the dishes you intend to cook, along with their corresponding ingredients and step-by-step procedures, to ensure a seamless and delightful cooking experience.</p> <!-- Κείμενο -->
                        </div>
                    </div>
                    <div class="carousel-item"> <!-- Δεύτερη εικόνα -->
                        <img src="image/bg3.jpg" class="d-block w-100" alt="..."> <!-- Εικόνα -->
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="caption"><strong>Welcome to TastyBytes</strong></h5>
                            <p class="caption caption-p">Cooking is a journey of discovery, where each recipe is a passport to new flavors and unforgettable experiences.</p> <!-- Κείμενο -->
                        </div>
                    </div>
                    <div class="carousel-item"> <!-- Τρίτη εικόνα -->
                        <img src="image/bg5.jpg" class="d-block w-100" alt="..."> <!-- Εικόνα -->
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="caption"><strong>Welcome to TastyBytes</strong></h1>
                            <p class="caption caption-p">In the kitchen, as in life, every dish holds a secret ingredient: passion. Let your culinary journey ignite your senses and nourish your soul.</p> <!-- Κείμενο -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5"> <!-- Κοντέινερ με περιεχόμενο -->
                <div class="row"> <!-- Σειρά -->
                    <div class="col-md-4 mb-4"> <!-- Στήλη 1 -->
                        <div class="card"> <!-- Κάρτα -->
                            <img src="image/card1.jpg" class="card-img-top" alt="..."> <!-- Εικόνα κάρτας -->
                            <div class="card-body">
                                <h4 class="card-title text-center"><strong>Ingredients List</strong></h4> <!-- Τίτλος κάρτας -->
                                <p class="card-text text-center">This should be detailed and include important information to tell the user how much of each ingredient they should be using.</p> <!-- Κείμενο κάρτας -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4"> <!-- Στήλη 2 -->
                        <div class="card"> <!-- Κάρτα -->
                            <img src="image/card2.jpg" class="card-img-top" alt="..."> <!-- Εικόνα κάρτας -->
                            <div class="card-body">
                                <h4 class="card-title text-center"><strong>Foods List</strong></h4> <!-- Τίτλος κάρτας -->
                                <p class="card-text text-center">This is typically the name of the food the user will be making when they follow the recipe.</p> <!-- Κείμενο κάρτας -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4"> <!-- Στήλη 3 -->
                        <div class="card"> <!-- Κάρτα -->
                            <img src="image/card3.jpg" class="card-img-top" alt="..."> <!-- Εικόνα κάρτας -->
                            <div class="card-body">
                                <h4 class="card-title text-center"><strong>Prodedures</strong></h4> <!-- Τίτλος κάρτας -->
                                <p class="card-text text-center">These are the steps the user should take and are numbered and ordered chronologically in the way they should be done.</p> <!-- Κείμενο κάρτας -->
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </section>

   <!-- Περιοχή Κατηγοριών -->
<section id="category"> 
    <div class="container mt-5"> <!-- Κοντέινερ με περιεχόμενο -->
        <div class="row"> <!-- Σειρά -->
            <div class="col-md-4 mb-4"> <!-- Στήλη 1 -->
                <div class="card"> <!-- Κάρτα -->
                    <img src="image/breakfast.jpg" class="card-img-top" alt="..." style="height: 240px"> <!-- Εικόνα κάρτας -->
                    <div class="card-body">
                        <h5 class="card-title text-center"><strong>Breakfast Recipes</strong></h5> <!-- Τίτλος κάρτας -->
                        <a class="btn btn-dark btn-block" data-toggle="modal" data-target="#breakfastModal">View List</a> <!-- Κουμπί προβολής λίστας -->
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4"> <!-- Στήλη 2 -->
                <div class="card"> <!-- Κάρτα -->
                    <img src="image/lunch.jpg" class="card-img-top" alt="..." style="height: 240px"> <!-- Εικόνα κάρτας -->
                    <div class="card-body">
                        <h5 class="card-title text-center"><strong>Lunch Recipes</strong></h5> <!-- Τίτλος κάρτας -->
                        <a class="btn btn-dark btn-block" data-toggle="modal" data-target="#lunchModal">View List</a> <!-- Κουμπί προβολής λίστας -->
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4"> <!-- Στήλη 3 -->
                <div class="card"> <!-- Κάρτα -->
                    <img src="image/dinner.jpg" class="card-img-top" alt="..." style="height: 240px"> <!-- Εικόνα κάρτας -->
                    <div class="card-body">
                        <h5 class="card-title text-center"><strong>Dinner Recipes</strong></h5> <!-- Τίτλος κάρτας -->
                        <a class="btn btn-dark btn-block" data-toggle="modal" data-target="#dinnerModal">View List</a> <!-- Κουμπί προβολής λίστας -->
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4"> <!-- Στήλη 4 -->
                <div class="card"> <!-- Κάρτα -->
                    <img src="image/appetizer.jpg" class="card-img-top" alt="..." style="height: 240px"> <!-- Εικόνα κάρτας -->
                    <div class="card-body">
                        <h5 class="card-title text-center"><strong>Appetizer Recipes</strong></h5> <!-- Τίτλος κάρτας -->
                        <a class="btn btn-dark btn-block" data-toggle="modal" data-target="#appetizerModal">View List</a> <!-- Κουμπί προβολής λίστας -->
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4"> <!-- Στήλη 5 -->
                <div class="card"> <!-- Κάρτα -->
                    <img src="image/dessert.jpeg" class="card-img-top" alt="..." style="height: 240px"> <!-- Εικόνα κάρτας -->
                    <div class="card-body">
                        <h5 class="card-title text-center"><strong>Dessert Recipes</strong></h5> <!-- Τίτλος κάρτας -->
                        <a class="btn btn-dark btn-block" data-toggle="modal" data-target="#dessertModal">View List</a> <!-- Κουμπί προβολής λίστας -->
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4"> <!-- Στήλη 6 -->
                <div class="card"> <!-- Κάρτα -->
                    <img src="image/fastfood.jpg" class="card-img-top" alt="..." style="height: 240px"> <!-- Εικόνα κάρτας -->
                    <div class="card-body">
                        <h5 class="card-title text-center"><strong>Fast Food Recipes</strong></h5> <!-- Τίτλος κάρτας -->
                        <a class="btn btn-dark btn-block" data-toggle="modal" data-target="#fastFoodModal">View List</a> <!-- Κουμπί προβολής λίστας -->
                    </div>
                </div>
            </div>
        </div>   
    </div>
</section>

    <!-- Ενότητα για τις λίστες φαγητών -->
<section id="food"> 
    <div class="card card-food-list"> <!-- Κάρτα για την παρουσίαση των λιστών φαγητών -->
        <h1 class="text-center"><strong>Food Lists</strong></h1> <!-- Τίτλος της κάρτας -->
        <div class="mt-4"> <!-- Απόσταση από τον τίτλο -->
            <div class="row"> <!-- Σειρά -->
                <?php if(isset($_SESSION['user_id'])): ?> <!-- Έλεγχος για την ύπαρξη σύνδεσης χρήστη -->
                <div class="col-md-2 mr-auto"> <!-- Στήλη για το πλήκτρο προσθήκης συνταγής -->
                    <button type="button" class="btn btn-add-food btn-secondary" data-toggle="modal" data-target="#addRecipeModal">Add Recipe</button>
                </div>
                <?php endif; ?>
                <div class="col-md-2"> <!-- Στήλη για το πεδίο αναζήτησης -->
                    <input class="form-control p-4" type="text" id="searchInput" placeholder="Search...">
                </div>
            </div>
        </div>

        <table id="foodListTable" class="table table-responsive mt-4" style="text-align:center;"> <!-- Πίνακας για την παρουσίαση της λίστας φαγητών -->
            <thead> <!-- Κεφαλίδα πίνακα -->
                <tr> <!-- Σειρά κεφαλίδας -->
                <th scope="col" style="width: 5%;">Food ID</th> <!-- Κεφαλίδα για τον αριθμό ταυτοποίησης φαγητού -->
                <th scope="col" style="width: 10%;">Recipe Image</th> <!-- Κεφαλίδα για την εικόνα της συνταγής -->
                <th scope="col" style="width: 10%;">Recipe Name</th> <!-- Κεφαλίδα για το όνομα της συνταγής -->
                <th scope="col" style="width: 10%;">Category</th> <!-- Κεφαλίδα για την κατηγορία της συνταγής -->
                <th scope="col" style="width: 10%;">Action</th> <!-- Κεφαλίδα για τις ενέργειες πάνω στη συνταγή -->
                </tr>
            </thead>
            <tbody> <!-- Σώμα πίνακα -->
            
                    <!-- Προετοιμασία ερωτήματος προς τη βάση δεδομένων -->
                <?php 
                    
                $stmt = $conn->prepare(" 
                    SELECT * 
                    FROM 
                        `tbl_recipe`
                    LEFT JOIN
                        `tbl_category` ON
                        `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` 
                    ");
                $stmt->execute(); // Εκτέλεση ερωτήματος προς τη βάση δεδομένων //

                $result = $stmt->fetchAll(); // Λήψη αποτελεσμάτων //

                foreach ($result as $row) { //Επανάληψη για κάθε σειρά αποτελεσμάτων //
                    $recipeID = $row['tbl_recipe_id']; 
                    $categoryID = $row['tbl_category_id'];
                    $categoryName = $row['category_name'];
                    $recipeImage = $row['recipe_image'];
                    $recipeName = $row['recipe_name'];
                    $recipeIngredients = $row['recipe_ingredients'];
                    $recipeProcedure = $row['recipe_procedure'];
                    ?>

                    <tr>
                        <th id="recipeID-<?= $recipeID ?>"><?php echo $recipeID ?></th>
                        <td id="recipeImage-<?= $recipeID ?>"><img src="http://localhost/project/uploads/<?php echo $recipeImage ?>" class="img-fluid" style="height: 50px; width: 90px" alt="Recipe Image"></td>
                        <td id="recipeName-<?= $recipeID ?>"><?php echo $recipeName ?></td>
                        <td id="categoryName-<?= $recipeID ?>"><?php echo $categoryName ?></td>
                        <td id="recipeIngredients-<?= $recipeID ?>" hidden><?php echo $recipeIngredients ?></td>
                        <td id="recipeProcedure-<?= $recipeID ?>" hidden><?php echo $recipeProcedure ?></td>
                       
                        <td>
                            <button type="button" onclick="view_recipe('<?php echo $recipeID ?>')" title="View"><i class="fa-solid fa-list p-1"></i></button> <!-- κουμπι για Προβολή -->
                            <?php if(isset($_SESSION['user_id'])): ?>
                            <button type="button" onclick="update_recipe('<?php echo $recipeID ?>')" title="Edit"><i class="fa-solid fa-pencil p-1"></i></button> <!--κουμπι για Προβολή -->
                            <button type="button" onclick="delete_recipe('<?php echo $recipeID ?>')" title="Delete"><i class="fa-solid fa-trash p-1"></i></button> <!--κουμπι για Προβολή -->
                            <?php endif; ?>
                        </td>
                    </tr>

                    <?php
                }
                ?>
                
            </tbody>
        </table>
    </div>
</section>
    
<script src="assets/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</body>
</html>