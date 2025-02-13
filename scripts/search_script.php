<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];

    $stmt = $pdo->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ? OR genre LIKE ?");
    $stmt->execute(["%$query%", "%$query%", "%$query%"]);
    $books = $stmt->fetchAll();

    if ($books) {
        foreach ($books as $book) {
            echo "<div class='col-md-4 mb-3'>
                    <div class='card'>
                        <img src='../uploads/covers/{$book['cover_image']}' class='card-img-top' alt='Book Cover'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$book['title']}</h5>
                            <p class='card-text'>{$book['author']}</p>
                            <a href='book.php?id={$book['id']}' class='btn btn-primary'>View Details</a>
                        </div>
                    </div>
                </div>";
        }
    } else {
        echo "<p class='text-center'>No books found.</p>";
    }
}
?>