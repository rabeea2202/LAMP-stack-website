<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SneakerPulse</title>
    
    <link rel="stylesheet" href="css/style_gallery.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div id="header">
            <img src="images/Sneaker-logo.jpg" width="100px" height="100px" alt="SneakerPuluse Logo">
            <h3> Step Up Your Game, One Sneaker at a Time</h3>
        </div>
    </header>
    <nav class="navbar">
        <ul>
        <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>

    </nav>
    <div id="gallery">
        <h1>Gallery</h1>
        <p>Explore our collection of sneakers from various brands and styles</p>
        <div class="gallery-grid">
        <?php
               
                $sql = "SELECT image, name, sname, comment FROM sneakers";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
        
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="gallery-item">';
                        echo '<img src="uploads/' . $row['image'] . '" alt="' . htmlspecialchars($row['sname']) . '">';
                        echo '<div class="overlay">';
                        echo '<div class="text">';
                        echo '<h2>' . htmlspecialchars($row['name']) . '</h2>';
                        echo '<p>' . htmlspecialchars($row['sname']) . '</p>';
                        echo '<p>' . htmlspecialchars($row['comment']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // no image
                    echo "<p>No images to display</p>";
                }

                mysqli_close($conn);
            ?>
        </div>
    </div>
    <footer>
    <div class="footer-content">
        <p>&copy; 2024 SneakerPulse. All rights reserved.</p>        
    </div>
    </footer>

</body>
</html>
