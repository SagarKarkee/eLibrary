<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

$book_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch();

if (!$book) {
    header("Location: search.php");
    exit();
}
include '../includes/header.php';
?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <img src="../uploads/covers/<?= $book['cover_image'] ?>" class="img-fluid" alt="Book Cover">
        </div>
        <div class="col-md-8">
            <h1><?= $book['title'] ?></h1>
            <p><strong>Author:</strong> <?= $book['author'] ?></p>
            <p><strong>Genre:</strong> <?= $book['genre'] ?></p>
            <p><strong>Description:</strong> <?= $book['description'] ?></p>
            <a href="../uploads/books/<?= $book['file_path'] ?>" class="btn btn-primary" download>Download Book</a>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>