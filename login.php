<?php
session_start();
include("db.php"); // Include database connection

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['email'] = $user['email'];
                header("Location: home.php"); // Redirect to home
                exit();
            } else {
                $error = "Invalid email or password!";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - eLibrary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
    background: linear-gradient(to right, #1B1F3B, #283593);
    color: white;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    width: 350px;
    padding: 20px;
    background: white;
    color: #333;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.btn-primary {
    background-color: #E8B923;
    border: none;
    font-weight: bold;
    padding: 10px;
}

.btn-primary:hover {
    background-color: #C89F1C;
}

.error-message {
    color: #D32F2F;
    font-size: 14px;
    margin-top: 10px;
}

input {
    padding: 10px;
    margin: 10px 0;
    width: 100%;
    border-radius: 5px;
    border: 1px solid #ccc;
}

    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-container text-center">
        <h3 class="mb-3">eLibrary Login</h3>
        <?php if (!empty($error)) { echo "<p class='error-message'>$error</p>"; } ?>
        <form method="POST">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3"><a href="signup.php">Create an Account</a></p>
    </div>
</div>

</body>
</html>
