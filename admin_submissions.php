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

  <title>Accept/Decline</title>
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-md p-0 sticky-top " id="mainNavbar">
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
<?php

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
  require_once "config.php";

  $sql = "SELECT * FROM submissions";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Title</th><th>Ingredients</th><th>Instructions</th><th>Submitted By</th><th>Action</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['title'] . "</td>";
      echo "<td>" . $row['ingredients'] . "</td>";
      echo "<td>" . $row['instructions'] . "</td>";

        $user_id = $row['user_id'];
        $user_sql = "SELECT * FROM users WHERE user_id=$user_id";
        $user_result = mysqli_query($conn, $user_sql);
        $user_row = mysqli_fetch_assoc($user_result);
        if ($user_row != null) {
        echo "<td>" . $user_row['username'] . "</td>";
        } else {
        echo "<td>Unknown user</td>";
        }

      echo "<td><form action='admin_accept_submission.php' method='POST' id='actionBts'><input type='hidden' name='submission_id' value='" . $row['submission_id'] . "'><button type='submit' class='submitting'>Accept</button></form>";
      echo "<form action='admin_decline_submission.php' method='POST'  id='actionBts'><input type='hidden' name='submission_id' value='" . $row['submission_id'] . "'><button type='submit' class='submitting'>Decline</button></form></td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "No submissions found.";
  }

  mysqli_close($conn);
} else {
  header('Location: login.php');
  exit();
}
?>

</body>
</html>
