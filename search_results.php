<?php
session_start();
include 'db.php'; // Include the database connection

// Get the search term from the URL
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Results for "<?php echo htmlspecialchars($query); ?>"</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="homepage/style.css" rel="stylesheet" defer/>
    <link href="search_results.css" rel="stylesheet" defer/>
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

<section class="search-results-section">
    <h2>Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>

    <div class="recipesdisplay">
        <?php
        if ($query) {
            // Query the database to search for recipes by name
            $sql = "SELECT id, name, image FROM recipes WHERE name LIKE '%$query%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display each matching recipe as a div with image and name
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='recipeItem'>";
                    echo "<a href='recipe.php?id=" . $row['id'] . "'>";
                    echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No recipes found for \"$query\".</p>";
            }
        } else {
            echo "<p>Please enter a search term.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</section>
<footer class="footer">
    <p>&copy; 2024 Feast & Flavour. All rights reserved.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
