<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  // Redirect to login page or show an error message
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submission_id'])) {
  $submission_id = $_POST['submission_id'];

  // Connect to database
  $conn = mysqli_connect('localhost', 'andrauritu', 'numauita', 'sugarfree');

  // Get submission details
  $submission_sql = "SELECT * FROM submissions WHERE submission_id = $submission_id";
  $submission_result = mysqli_query($conn, $submission_sql);
  $submission_row = mysqli_fetch_assoc($submission_result);

// Insert recipe into recipes table
$title = mysqli_real_escape_string($conn, $submission_row['title']);
$description = mysqli_real_escape_string($conn, $submission_row['description']);
$ingredients = mysqli_real_escape_string($conn, $submission_row['ingredients']);
$instructions = mysqli_real_escape_string($conn, $submission_row['instructions']);
$category = mysqli_real_escape_string($conn, $submission_row['category']);
$sender = mysqli_real_escape_string($conn, $submission_row['sender']);
$image_name = mysqli_real_escape_string($conn, $submission_row['image']);
$recipe_sql = "INSERT INTO recipes (title, description, ingredients, instructions, category, sender, image) 
  VALUES ('$title', '$description', '$ingredients', '$instructions', '$category', '$sender', '$image_name')";
mysqli_query($conn, $recipe_sql);
  $submission_delete_sql = "DELETE FROM submissions WHERE submission_id = $submission_id";
  mysqli_query($conn, $submission_delete_sql);

  mysqli_close($conn);

  header('Location: admin_submissions.php');
  exit();
} else {
  header('HTTP/1.1 400 Bad Request');
  exit();
}
?>
