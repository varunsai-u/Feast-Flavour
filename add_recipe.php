<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: loginpage/loginpage.php");
    exit();
}

include 'db.php'; // Connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data, replacing \r\n with \n
    $name = $conn->real_escape_string($_POST['name']);
    $ingredients = $conn->real_escape_string(str_replace("\r\n", "\n", $_POST['ingredients']));
    $instructions = $conn->real_escape_string(str_replace("\r\n", "\n", $_POST['instructions']));

    $imagePath = NULL;

    // Handle image upload if an image file was provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Sanitize file name and check allowed file extensions
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = 'images/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath = $newFileName;
            } else {
                echo "<p style='color:red;'>Error: Unable to save uploaded file.</p>";
            }
        } else {
            echo "<p style='color:red;'>Allowed file types: " . implode(", ", $allowedfileExtensions) . "</p>";
        }
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO recipes (name, ingredients, instructions, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $ingredients, $instructions, $imagePath);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Recipe added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Recipe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="homepage/style.css" rel="stylesheet" defer>
    <link href="add_recipe.css" rel="stylesheet" defer>
</head>
<body>
<nav class="navbar">
    <div id="logo">
        <img src="homepage/images/logo.png" alt="logo" />
        <a href="homepage/index.php"><h2>Feast & Flavour</h2></a>
    </div>
    <div id="menu">
        <a href="#">About us</a>
        <?php if (isset($_SESSION['email'])): ?>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-person"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="loginpage/loginpage.php">Sign in</a>
        <?php endif; ?>
    </div>
</nav>

    <div class="add-recipe-container">
        <h2>Add a New Recipe</h2>
        <form action="add_recipe.php" method="POST" enctype="multipart/form-data">
            <label for="name">Recipe Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="ingredients">Ingredients (Enter each ingredient on a new line):</label><br>
            <textarea name="ingredients" id="ingredients" rows="5" cols="40"></textarea><br>

            <label for="instructions">Instructions:</label>
            <textarea id="instructions" name="instructions" rows="10" cols="50" required></textarea><br>

            <label for="image">Recipe Image:</label>
            <input type="file" id="image" name="image" accept="image/*"><br>

            <button type="submit" name="submit">Add Recipe</button>
        </form>
    </div>
    <footer class="footer">
    <p>&copy; 2024 Feast & Flavour. All rights reserved.</p>
</footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
