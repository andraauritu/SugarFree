<?php
include 'config.php';
$title = $_POST['title'];
$description = $_POST['description'];
$ingredients = $_POST['ingredients'];
$instructions = $_POST['instructions'];
$category = $_POST['category'];
$user_id = $_POST['user_id'];
$sender = $_POST['sender'];

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "./uploads/" . $filename;

$sql = "INSERT INTO Submissions (title, description, ingredients, instructions, category, sender, user_id, image)
        VALUES ('$title', '$description', '$ingredients', '$instructions', '$category', '$sender', '$user_id', '$filename')";

$response = array(); 

if (move_uploaded_file($tempname, $folder)) {
    $response['imageUploaded'] = true;
} else {
    $response['imageUploaded'] = false;
}

if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);

?>

