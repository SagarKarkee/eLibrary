<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
include '../includes/db.php';

// Fetch all books
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll();
?>
<div class="container my-5">
    <h1 class="text-center">Admin Dashboard</h1>
    <a href="add_book.php" class="btn btn-primary mb-3">Add New Book</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['genre'] ?></td>
                    <td>
                        <a href="edit_book.php?id=<?= $book['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="../scripts/delete_book.php?id=<?= $book['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?>