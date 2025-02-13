<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login page if not an admin
    exit();
}

include("db.php");

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $isbn = trim($_POST['isbn']);
    
    if (!empty($title) && !empty($author) && !empty($isbn)) {
        try {
            $sql = "INSERT INTO books (title, author, isbn) VALUES (:title, :author, :isbn)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":author", $author, PDO::PARAM_STR);
            $stmt->bindParam(":isbn", $isbn, PDO::PARAM_STR);
            $stmt->execute();
            $error = "Book added successfully!";
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields!";
    }
}

// Fetch all books to display
$books = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - eLibrary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Admin Dashboard</h1>
        <h3>Add a New Book</h3>
        <?php if (!empty($error)) { echo "<div class='alert alert-warning'>$error</div>"; } ?>
        <form method="POST">
            <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Book Title" required>
            </div>
            <div class="mb-3">
                <input type="text" name="author" class="form-control" placeholder="Author" required>
            </div>
            <div class="mb-3">
                <input type="text" name="isbn" class="form-control" placeholder="ISBN" required>
            </div>
            <button type="submit" name="add_book" class="btn btn-primary">Add Book</button>
        </form>

        <h3 class="my-4">Manage Books</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($book = $books->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                        <td>
                            <a href="edit_book.php?id=<?php echo $book['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="delete_book.php?id=<?php echo $book['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
