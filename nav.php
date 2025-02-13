<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
   
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fa;
    color: #333;
    display: flex;
    flex-direction: column;
    min-height: 100vh; 
}


.navbar {
    background-color:rgb(44, 80, 66);
    padding: 10px 20px;
    display: flex;
    justify-content: space-between; 
    align-items: center;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
}

.nav-links li {
    display: inline;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 15px;
}

.nav-links a:hover {
    background-color: #3498db;
    border-radius: 5px;
}

/* Logo styling */
.logo img {
    height: 60px; 
}

.container {
    width: 80%;
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
    flex-grow: 1;
}


h1 {
    font-size: 36px;
    color: #2c3e50;
    margin-bottom: 20px;
}


p {
    font-size: 18px;
    line-height: 1.5;
    margin-bottom: 15px;
}


a {
    color: #3498db;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}


.logged-in {
    font-weight: bold;
    font-size: 20px;
}


/* 
@media (max-width: 768px) {
    .container {
        width: 90%;
    }

    h1 {
        font-size: 28px;
    }

    p {
        font-size: 16px;
    }

    .nav-links {
        flex-direction: column;
        gap: 10px;
    }

    .nav-links a {
        font-size: 16px;
    }

    .logo img {
        height: 30px; 
    }
} */

    </style>
</head>
<body>
    <nav class="navbar">
        
        <div class="logo">
            <!-- <p>My Website</p> -->
            <img src="./image/logo.png" alt="Website Logo" />
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">View Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    </div>
</body>
</html>