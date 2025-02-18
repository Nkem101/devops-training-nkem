<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $media_type = $_POST['media_type'];
    $media_url = "";

    if(($media_type == 'image' || $media_type == 'video') && isset($_FILES['media']) && $_FILES['media']['error'] == 0) {
        $uploadDir = "uploads/";
        if(!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = basename($_FILES['media']['name']);
        $targetFile = $uploadDir . time() . "_" . $fileName;
        if(move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
            $media_url = $targetFile;
        } else {
            echo "Error uploading file.";
        }
    }
    
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, description, media_type, media_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $title, $description, $media_type, $media_url);
    if($stmt->execute()){
        header("Location: index.php");
        exit;
    } else {
        echo "Error posting blog.";
    }
    $stmt->close();
}
?>
