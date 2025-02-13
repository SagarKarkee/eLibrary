<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        
    </style>
   
</head>
<body>
<?php include 'nav.php'; ?> 
    <div class="container">
        <h1>Welcome to My Website</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <p class="logged-in">Hello, <?php echo $user['username']; ?>!</p>
        <?php else: ?>
            <p>Please <a href="login.php">login</a> or <a href="signup.php">signup</a> to continue.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?> 
</body>
</html>