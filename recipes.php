<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
<link rel="stylesheet" href="styles/styles.css">
  <title>Recipes</title>
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-md p-0 sticky-top " id="mainNavbarInRecipes">
      <a href="homepage.php" class="navbar-brand">
        <img src="images/logo.png" alt="logo" id="imgLogo" class="img-fluid px-2">
      </a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navLinks">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="homepage.php" class=" nav-link" >Home</a></li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" href="recipes.php">
                      Recipes
              </a>
              <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="recipes.php?category=all">All Recipes</a>
                  <a class="dropdown-item" href="recipes.php?category=sugarFree">Sugar-Free</a>
                  <a class="dropdown-item "  href="recipes.php?category=dairyFree">Dairy-Free</a>
                  <a class="dropdown-item " href="recipes.php?category=glutenFree">Gluten-Free</a>
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
  <?php
include('config.php');
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$sql = "SELECT * FROM `Recipes`";
if ($category != 'all') {
  $sql .= " WHERE `category` = '$category'";
}
$result = mysqli_query($conn, $sql);

echo '<div class="container"><div class="row">';
while ($row = mysqli_fetch_assoc($result)) {
  echo '<div class="d-flex col-md-4">';
      echo '<div class="recipe">';
        echo '<img src="./uploads/' . $row['image'] . '" alt="' . $row['title'] . '" id="uploadedImg">';
        echo '<h2>' . $row['title'] . '</h2>';
        echo '<p>' . 'Sent by: '. $row['sender'] . '</p>';
        echo '<p class="">' . $row['description'] . '</p>';

          echo '<button class="btn  see-recipe-btn">See Recipe</button>'; 
          echo '<div class="hidden">';
          echo ' <h4 class="ingredients">Ingredients</h4>'; 
          echo '<ul class="ingredients">';
          $ingredients = explode(",", $row['ingredients']);
          foreach ($ingredients as $ingredient) {
            echo '<li >' . $ingredient . '</li>';
          }
          echo '</ul>';
          echo ' <h4 class="instructions">Instructions</h4>'; 
          echo '<ol class="instructions">';
          $instructions = explode(";", $row['instructions']);
          foreach ($instructions as $instruction) {
            echo '<li >' . $instruction . '</li>';
          }
          echo '</ol>';

         echo '</div>';
  echo '</div>';
  echo '</div>';
}
echo '</div></div>';

mysqli_close($conn);
?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="navbar.js"></script>
    <script>
  let seeRecipeBtns = document.querySelectorAll('.see-recipe-btn');
  seeRecipeBtns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      let recipeDetails = this.nextElementSibling;
      recipeDetails.classList.toggle('hidden');
    });
  });
</script>

</body>
</html>