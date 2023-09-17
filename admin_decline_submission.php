
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submission_id'])) {
  $submission_id = $_POST['submission_id'];

  $conn = mysqli_connect('localhost', 'andrauritu', 'numauita', 'sugarfree');

  $submission_sql = "SELECT * FROM submissions WHERE submission_id = $submission_id";
  $submission_result = mysqli_query($conn, $submission_sql);
  $submission_row = mysqli_fetch_assoc($submission_result);

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
