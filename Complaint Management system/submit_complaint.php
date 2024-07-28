<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("INSERT INTO complaints (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $description);
    
    if ($stmt->execute()) {
        echo "Complaint submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<form method="POST">
    Title: <input type="text" name="title" required><br>
    Description: <textarea name="description" required></textarea><br>
    <button type="submit">Submit Complaint</button>
</form>
