<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
?>
<div class="container my-5">
    <h1 class="text-center">Search Books</h1>
    <div class="mb-3">
        <input type="text" class="form-control" id="search" placeholder="Search by title, author, or genre">
    </div>
    <div id="results" class="row"></div>
</div>
<script src="../assets/js/scripts.js"></script>
<?php include '../includes/footer.php'; ?>