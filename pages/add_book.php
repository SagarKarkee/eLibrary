<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
?>
<div class="container my-5">
    <h1 class="text-center">Add New Book</h1>
    <form action="../scripts/add_book.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="book_file" class="form-label">Upload Book (PDF)</label>
            <input type="file" class="form-control" id="book_file" name="book_file" required>
        </div>
        <div class="mb-3">
            <label for="cover_image" class="form-label">Upload Cover Image</label>
            <input type="file" class="form-control" id="cover_image" name="cover_image">
        </div>
        <button type="submit" class="btn btn-primary w-100">Add Book</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>