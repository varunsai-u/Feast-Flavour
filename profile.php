<?php
session_start(); // Start the session
include 'db.php'; // Connect to the database

if (!isset($_SESSION['email'])) {
    header("Location: loginpage/loginpage.php"); // Redirect if not logged in
    exit();
}

// Get user details
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="homepage/style.css" rel="stylesheet" defer/>
    <link href="profile.css" rel="stylesheet" defer/>
</head>
<body>
<nav class="navbar">
    <div id="logo">
        <img src="homepage/images/logo.png" alt="logo" />
        <a href="homepage/index.php"><h2>Feast & Flavour</h2></a>
    </div>
    <div id="menu">
        <a href="#">About us</a>
        
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-person"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        
    </div>
</nav>
    <div class="profile">
        <h1>Your Profile</h1>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['firstName']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['lastName']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <!-- Add more profile fields as needed -->
    </div>
    <footer class="footer">
    <p>&copy; 2024 Feast & Flavour. All rights reserved.</p>
</footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
