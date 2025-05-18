<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SneakerPulse</title>
    
    <link rel="stylesheet" href="css/style.css">
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
    <div id="intro">
        <div class="overlay"></div>
        <h1>Welcome to SneakerPulse</h1>
        <p>Your ultimate hub for sneaker enthusiasts. Share, explore, and rate the coolest kicks!</p>
        <button class="open-button" onclick="openForm()">Share Your Sneaker</button>
    </div>

    <div class="form-popup" id="myForm">
        <form action="index.php" class="form-container" method="post" enctype="multipart/form-data">
          <h1>Upload Sneaker Image</h1>
      
          <label for="username"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="username" required>
      
          <label for="sneaker"><b>Sneaker</b></label>
          <input type="text" placeholder="Enter Sneaker Name" name="sneaker" required>

          <label for="message"><b>Comment</b></label>
          <textarea name="cmt" id="text" rows="3" cols="25" ></textarea><br>

          <label for="image"><b>Choose File</b></label><br><br>
          <input type="file" name="image" required><br><br>

          <button type="submit" class="btn">Upload</button>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>


    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }  

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 SneakerPulse. All rights reserved.</p>        
        </div>
    </footer>

</body>
</html>

<?php
    include("database.php");
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $sneaker = filter_input(INPUT_POST, "sneaker", FILTER_SANITIZE_SPECIAL_CHARS);
        $cmt = filter_input(INPUT_POST, "cmt", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $folder = 'uploads/'.$image_name;

        if(empty($username)){
            echo "Enter valid name";
        }
        elseif(empty($sneaker)){
            echo "Enter valid sneaker name";
        }
        elseif(empty($cmt)){
            echo "Cannot be empty";
        }
        elseif(empty($image_name)){
            echo "Image required";
        }
        else{
            if (move_uploaded_file($tmp_name, $folder)) {
                // Prepare the SQL query
                $sql = "INSERT INTO sneakers (name, sname, comment, image)
                        VALUES ('$username','$sneaker','$cmt','$image_name')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                //upload right format image
                echo "Failed to upload image.";
            }
        }
    }
     
    mysqli_close($conn);
?>
