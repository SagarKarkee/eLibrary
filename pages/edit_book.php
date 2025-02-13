<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

$book_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch();

if (!$book) {
    header("Location: admin.php");
    exit();
}
include '../includes/header.php';
?>
<div class="container my-5">
    <h1 class="text-center">Edit Book</h1>
    <form action="../scripts/update_book.php" method="POST">
        <input type="hidden" name="id" value="<?= $book['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $book['title'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="<?= $book['author'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" value="<?= $book['genre'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= $book['description'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Book</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>