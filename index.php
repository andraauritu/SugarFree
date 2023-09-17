<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
	<title>SugarFree</title>

</head>
<body >
  <nav class="navbar navbar-dark navbar-expand-md p-0 fixed-top " id="mainNavbar">
      <a href="index.php" class="navbar-brand">
        <img src="images/logo.png" alt="logo" id="imgLogo" class="img-fluid px-2">
      </a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navLinks">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="index.php" class=" nav-link" >Home</a></li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" href="recipes.php">
                      Recipes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="recipes.php?category=all">All Recipes</a>
                  <a class="dropdown-item" href="recipes.php?category=sugarFree">Sugar-Free</a>
                  <a class="dropdown-item" href="recipes.php?category=dairyFree">Dairy-Free</a>
                  <a class="dropdown-item" href="recipes.php?category=glutenFree">Gluten-Free</a>
              </div>
          </li>
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <li class="nav-item"><a href="admin_submissions.php" class=" nav-link">Submissions</a></li>
          <?php endif; ?>
          <?php if (isset($_SESSION['username'])): ?>
            <li class="nav-item"><a class=" nav-link" href="logout.php">Logout</a></li>
            <li class="nav-item"><a href="submissions.php" class=" nav-link">Submit Recipe</a></li>

          <?php else: ?>
            <li class="nav-item"><a href="login.php" class=" nav-link">Login</a></li>
            <li class="nav-item"><a href="register.php" class=" nav-link">Register</a></li>
          <?php endif; ?>
        </ul>
      </div>
  </nav>

  <section class="container-fluid px-0">
    <div class="row align-items-center">
      <div class="col-md-6 px-0 order-2 order-md-1">
      <div id="headingGroup" class="text-white text-center  mt-5">

        <?php if (isset($_SESSION['username'])): ?>
          <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <?php else: ?>
          <h1>Welcome to SugarFree!</h1>
        <?php endif; ?>
        <h2>Glad to have you here! :) </h2>
        <h2>Below are some of our favorite recipes:</h2>
        </div>
      </div>
      <div class="col-md-6 px-0 order-1 ">
                <img class="img-fluid" src="images/muffin.png" alt="">
            </div>      
      
    </div>

  </section>
  <section class="container-fluid px-0">
    <div class="row align-items-center content">
      <div class="col-md-6  px-0">
        <img src="uploads/bananabread.png" alt="" class="img-fluid recipe-image">
      </div>
      <div class="col-md-6 text-center  px-0">
          <div class="row justify-content-center mx-0 my-0">
          <div class="col-10 col-lg-8 blurb mt-5 mb-5 mb-md-0 p-0 m-0">
                        <?php
                        include 'config.php';                        
                        $sql = "SELECT * FROM recipes WHERE recipe_id=38";
                        $result = $conn->query($sql);
                          while($row = $result->fetch_assoc()) {
                            $description = $row['description'];
                            echo '<p id="recipe-description" style="display:none">' . $description . '</p>';
                            echo '<h3 id="recipe-title">' . $row['title'] . '</h3>';
                            echo ' <h4 class="ingredients" id="recipeSubTitles">Ingredients</h4>'; 
                            echo '<ul class="ingredients">';
                            $ingredients = explode(",", $row['ingredients']);
                            foreach ($ingredients as $ingredient) {
                              echo '<li >' . $ingredient . '</li>';
                            }
                            echo '</ul>';
                            echo ' <h4 class="instructions" id="recipeSubTitles">Instructions</h4>'; 
                            echo '<ol class="instructions">';
                            $instructions = explode(";", $row['instructions']);
                            foreach ($instructions as $instruction) {
                              echo '<li >' . $instruction . '</li>';
                            }
                            echo '</ol>';

                          }

                        $conn->close();
                        ?>

            </div>
            </div>
        </div>
      </div>            
  </section>

  <section class="container-fluid px-0">
    <div class="row align-items-center content">
      <div class="col-md-6 text-center  px-0 order-2 order-md-1">
          <div class="row justify-content-center mx-0 my-0">
          <div class="col-10 col-lg-8 blurb mt-5 mb-5 mb-md-0 p-0 m-0">
                        <?php
                        include 'config.php';
                        $sql = "SELECT * FROM recipes WHERE recipe_id=42";
                        $result = $conn->query($sql);
                          while($row = $result->fetch_assoc()) {
                            $description = $row['description'];
                            echo '<p id="recipe-description" style="display:none">' . $description . '</p>';
                            echo '<h3 id="recipe-title">' . $row['title'] . '</h3>';
                            echo ' <h4 class="ingredients" id="recipeSubTitles">Ingredients</h4>'; 
                            echo '<ul class="ingredients">';
                            $ingredients = explode(",", $row['ingredients']);
                            foreach ($ingredients as $ingredient) {
                              echo '<li >' . $ingredient . '</li>';
                            }
                            echo '</ul>';
                            echo ' <h4 class="instructions" id="recipeSubTitles">Instructions</h4>'; 
                            echo '<ol class="instructions">';
                            $instructions = explode(".", $row['instructions']);
                            foreach ($instructions as $instruction) {
                              echo '<li >' . $instruction . '</li>';
                            }
                            echo '</ol>';

                          }
      
                        $conn->close();
                        ?>
            </div>
            </div>
        </div>
        <div class="col-md-6  px-0 order-1 order-md-2">
        <img src="uploads/brownie.png" alt="" class="img-fluid recipe-image">
      </div>
      </div>            
  </section>

  <section class="container-fluid px-0">
    <div class="row align-items-center content">
      <div class="col-md-6  px-0 theParent">
        <img src="uploads/waffles.png" alt="" class="img-fluid recipe-image">
      </div>
      <div class="col-md-6 text-center  px-0">
          <div class="row justify-content-center mx-0 my-0">
          <div class="col-10 col-lg-8 blurb mt-5 mb-5 mb-md-0 p-0 m-0">
                        <?php
                        include 'config.php';
                        $sql = "SELECT * FROM recipes WHERE recipe_id=40";
                        $result = $conn->query($sql);
                          while($row = $result->fetch_assoc()) {
                            $description = $row['description'];
                            echo '<div id="recipe-description" style="display:none">' . $description . '</div>';
                            echo '<h3 id="recipe-title">' . $row['title'] . '</h3>';
                            echo ' <h4 class="ingredients" id="recipeSubTitles" >Ingredients</h4>'; 
                            echo '<ul class="ingredients">';
                            $ingredients = explode(",", $row['ingredients']);
                            foreach ($ingredients as $ingredient) {
                              echo '<li >' . $ingredient . '</li>'; }
                            echo '</ul>';
                            echo ' <h4 class="instructions" id="recipeSubTitles">Instructions</h4>'; 
                            echo '<ol class="instructions">';
                            $instructions = explode(";", $row['instructions']);
                            foreach ($instructions as $instruction) {
                              echo '<li >' . $instruction . '</li>'; }
                            echo '</ol>';
                          }
                        $conn->close();
                        ?>
            </div>
            </div>
        </div>
      </div>            
  </section>     
  <script src="textOnImage.js"> </script>
             
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="navbar.js"></script>

</body>
</html>
