<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $uploaded_by = $_SESSION['user_id'];

    // Handle file uploads
    $book_file = $_FILES['book_file'];
    $cover_image = $_FILES['cover_image'];

    $book_file_path = '../uploads/books/' . basename($book_file['name']);
    $cover_image_path = '../uploads/covers/' . basename($cover_image['name']);

    move_uploaded_file($book_file['tmp_name'], $book_file_path);
    move_uploaded_file($cover_image['tmp_name'], $cover_image_path);

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO books (title, author, genre, description, file_path, cover_image, uploaded_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $genre, $description, $book_file_path, $cover_image_path, $uploaded_by]);

    header("Location: ../pages/admin.php");
}
?>