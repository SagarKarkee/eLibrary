<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, genre = ?, description = ? WHERE id = ?");
    $stmt->execute([$title, $author, $genre, $description, $id]);

    header("Location: ../pages/admin.php");
}
?>