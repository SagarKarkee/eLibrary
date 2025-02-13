<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
?>
<div class="container my-5">
    <h1 class="text-center">Welcome, <?= $_SESSION['role'] === 'admin' ? 'Admin' : 'Student' ?></h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Browse Books</h5>
                    <a href="search.php" class="btn btn-primary w-100">Search Books</a>
                </div>
            </div>
        </div>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Books</h5>
                        <a href="admin.php" class="btn btn-success w-100">Admin Panel</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>