<?php
    include("header.html");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SneakerPulse</title>
    <link rel="stylesheet" href="style_contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>

    </nav>
    <div class="contact-container">
        <div class="text-container">
            <h1>Contact Us</h1>
            <br>
            <p>We'd love to hear from you! Whether you have a question, feedback, or just want to chat about sneakers, feel free to reach out. 
                <br>Your thoughts and inquiries are important to us. Fill out the form below, and we’ll get back to you as soon as possible.
                <br>Let's stay connected!</p>
        </div>
        <div class="form-container">
            <form action="contact.php" method="post">
                <label for="name">Name</label>
                <input type="text" name="username" placeholder="Adam" required><br>
                <label for="mailid">Email ID</label>
                <input type="email" name="mailid" placeholder="adam123@gmail.com" required><br>
                <label for="message">Message</label>
                <textarea id="text" name="message" rows="3" cols="25"></textarea><br>
                <input type="submit">
            </form>
        </div>
    </div>

</body>
</html>

<?php
    include("footer.html");
    include("database.php");
   

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $mailid = filter_input(INPUT_POST, "mailid", FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(empty($username)){
            echo "Enter valid name";
        }
        elseif(empty($mailid)){
            echo "Enter valid email";
        }
        elseif(empty($message)){
            echo "Cannot be empty";
        }
        else{
            $sql = "INSERT INTO users (name, mail, message)
                    VALUES ('$username','$mailid','$message')";

            if (mysqli_query($conn, $sql)) {
                // Redirect to a new page after successful insertion
                header("Location: contact.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
                        
        }
    }
     
    mysqli_close($conn);

?>