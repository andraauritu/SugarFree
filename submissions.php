<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-md p-0 sticky-top " id="mainNavbar">
      <a href="#" class="navbar-brand">
        <img src="images/logo.png" alt="logo" id="imgLogo" class="img-fluid px-2">
      </a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navLinks">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="homepage.php" class=" nav-link" >Home</a></li>
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

<form action="submit.php" method="post" enctype="multipart/form-data" id="submissionForm">
	<label for="title">Title:</label>
	<input type="text" name="title" id="title" required>
	<br><br>
	<label for="description">Description:</label>
	<textarea name="description" id="description"></textarea>
	<br><br>
	<label for="ingredients">Ingredients: ( sepparate ingredients with ',' )</label>
	<textarea name="ingredients" id="ingredients" required></textarea>
	<br><br>
	<label for="instructions">Instructions: ( sepparate instructions with ';' )</label>
	<textarea name="instructions" id="instructions" required></textarea>
	<br><br>
	<label for="category">Category:</label>
	<select name="category" id="category" required>
		<option value="">Select a category</option>
		<option value="sugarFree">Sugar-free</option>
		<option value="glutenFree">Gluten-free</option>
		<option value="dairyFree">Dairy-free</option>
    </select>
	<br><br>
  <?php

    $user_id = $_SESSION['user_id'];
?>
	  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
   <!-- <input type="text" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" placeholder="<?php echo $user_id; ?>"> -->
    <label for="sender">Display Name:</label>
    <input type="text" name="sender" id="sender" required>
    <br><br>

    <label for="image">Image: ( please use square images )</label>
  <input type="file" name="uploadfile" id="uploadfile">
  <br><br>
  <div id="message"></div>

	<input type="submit" value="Submit Recipe"> 
</form>

<script src="navbar.js"></script>
<script src="displayMessage.js" ></script>


</body>
</html>