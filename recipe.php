<?php
session_start();
include 'db.php'; // Include the database connection

// Check if 'id' is present in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to an integer to prevent SQL injection

    // Prepare SQL statement to fetch the recipe using a prepared statement
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $recipe = $result->fetch_assoc(); // Get the recipe details
    } else {
        echo "<h2>Recipe not found!</h2>";
        exit();
    }

    $stmt->close();
} else {
    echo "<h2>No recipe selected!</h2>";
    exit();
}

// After this point, $recipe will have the details of the fetched recipe
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($recipe['name']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="homepage/style.css" rel="stylesheet" />
    <link href="recipe.css" rel="stylesheet"/>
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

<div class="recipe-details">
    <h1><?php echo htmlspecialchars($recipe['name']); ?></h1>
    <img src="images/<?php echo htmlspecialchars($recipe['image']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>" class="recipe-image" />
    <h2>Ingredients:</h2>
    <ul>
        <?php
        // Assuming $recipe['ingredients'] contains the string
        $ingredientsString = str_replace('\n', "\n", $recipe['ingredients']); // Replace literal \n with actual newlines
        $ingredients = preg_split('/\r\n|\r|\n/', $ingredientsString); // Split the string into an array

        // Display the ingredients
        foreach ($ingredients as $ingredient) {
            if (!empty(trim($ingredient))) { // Check if not empty after trimming
                echo "<li>" . htmlspecialchars(trim($ingredient)) . "</li>" ;
            }
        }
        ?>
    </ul>

    <h2>Instructions:</h2>
    <ol>
        <?php
        // Assuming $recipe['instructions'] contains the string
        $instructionsString = str_replace('\n', "\n", $recipe['instructions']); // Replace literal \n with actual newlines
        $instructions = preg_split('/\r\n|\r|\n/', $instructionsString); // Split the string into an array

        // Display the instructions
        foreach ($instructions as $step) {
            if (!empty(trim($step))) { // Check if not empty after trimming
                echo "<li>" . htmlspecialchars(trim($step)) . "</li>"; // Corrected to close <li> tag properly
            }
        }
        ?>
    </ol>
</div>
<footer class="footer">
    <p>&copy; 2024 Feast & Flavour. All rights reserved.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
