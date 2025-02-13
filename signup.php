<?php
include 'db.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $firstname = trim($_POST['firstname']);
    $secondname = trim($_POST['secondname']);
    $phone = trim($_POST['phone']);
    $role = 'user'; // Default role

    // Handle role assignment (if admin is assigning)
    if (isset($_POST['role']) && $_POST['role'] === 'admin' && isAdminUser()) {
        $role = 'admin';
    }

    // Handling profile photo upload
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $profile_photo = null;
    if (!empty($_FILES['profile_photo']['name'])) {
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION));
        $file_size = $_FILES['profile_photo']['size'];

        if (!in_array($file_ext, $allowed_ext)) {
            $error = "Error: Invalid file type. Only JPG, PNG, and GIF are allowed.";
        } elseif ($file_size > 2 * 1024 * 1024) {
            $error = "Error: File size too large. Max 2MB allowed.";
        } else {
            $new_filename = time() . "_" . basename($_FILES['profile_photo']['name']);
            $profile_photo = $upload_dir . $new_filename;
            if (!move_uploaded_file($_FILES['profile_photo']['tmp_name'], $profile_photo)) {
                $error = "Error: Failed to upload file.";
            }
        }
    }

    if (empty($error)) {
        try {
            $sql = "INSERT INTO users_data (username, email, password, firstname, secondname, phone, profile_photo, role) 
                    VALUES (:username, :email, :password, :firstname, :secondname, :phone, :profile_photo, :role)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $password,
                ':firstname' => $firstname,
                ':secondname' => $secondname,
                ':phone' => $phone,
                ':profile_photo' => $profile_photo,
                ':role' => $role
            ]);

            $success = "Account created successfully! Redirecting to login...";
            header("refresh:2; url=login.php");
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - eLibrary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h2 class="text-center">Signup</h2>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php elseif (!empty($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            <form action="signup.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="secondname" class="form-control" placeholder="Second Name" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                </div>
                <div class="mb-3">
                    <label for="profile_photo" class="form-label">Profile Photo</label>
                    <input type="file" name="profile_photo" class="form-control" accept="image/*">
                </div>
                <!-- Hidden role field for regular users -->
                <input type="hidden" name="role" value="user">
                <button type="submit" class="btn btn-primary w-100">Signup</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a>.</p>
        </div>
    </div>
</body>
</html>