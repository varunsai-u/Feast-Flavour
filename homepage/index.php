<?php
session_start();
include '../db.php'; // Connect to the database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feast & Flavour</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" defer/>
</head>
<body>
<nav class="navbar">
    <div id="logo">
        <img src="images/logo.png" alt="logo" />
        <h2>Feast & Flavour</h2>
    </div>
    <div id="menu">
        <a href="#">About us</a>
        <?php if (isset($_SESSION['email'])): ?>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-person"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../profile.php">Profile</a>
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="../loginpage/loginpage.php">Sign in</a>
        <?php endif; ?>
    </div>
</nav>
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1>Discover Your Next Favorite Recipe!</h1>
        <p>Easy, Delicious Recipes for Every Occasion</p>
        <a href="#recipes" class="cta-button">Explore Recipes</a>
    </div>
</section>
<section class="search-section">
    <form action="../search_results.php" method="GET">
        <input type="text" name="query" placeholder="Search for recipes..." class="search-input" required>
        <button type="submit" class="search-button">Search</button>
    </form>
</section>

<section class="add-recipe-section">
    <h2>Add Your Own Recipe!</h2>
    <p>Share your favorite recipes with the world and inspire others to try something new!</p>
    <a href="../add_recipe.php" class="add-recipe-button">Add Recipe</a>
</section>

<div class="recipes" id="recipes">
    
    <h2 id="rar">Recently added recipes</h2>
    <div class="rarp">
    <?php
    // Query to fetch recent recipes
    $sql = "SELECT id, name, image FROM recipes ORDER BY created_at DESC LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display each recipe preview
        while ($row = $result->fetch_assoc()) {
            echo "<div class='recipe-item'>";
            echo "<a href='../recipe.php?id=" . $row['id'] . "'>";
            echo "<img src='../images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
            echo "<h3>" . $row['name'] . "</h3>";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No recipes found!</p>";
    }
    ?>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<footer class="footer">
    <p>&copy; 2024 Feast & Flavour. All rights reserved.</p>
</footer>


</body>
</html>

