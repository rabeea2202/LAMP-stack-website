<?php
$db_server = "db";
$db_user = "root";
$db_pass = "rootpassword";
$db_name = "mydb";


$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
