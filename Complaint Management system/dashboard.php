<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT c.id, u.username, c.title, c.description, c.status, c.created_at FROM complaints c JOIN users u ON c.user_id = u.id");

echo "<h1>Complaints Dashboard</h1>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>User</th><th>Title</th><th>Description</th><th>Status</th><th>Created At</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>" . $row['created_at'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
