<?php

//connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//image
$file_name = $_FILES['image']['name'];
$tempname = $_FILES['image']['tmp_name'];
$folder = 'uploads/'.$file_name;


$insertQuery = "INSERT INTO users(full_name,user_name,email,address,phone,birthdate,password, image_name)
                VALUES ('$full_name','$user_name','$email','$address','$phone','$birthdate','$password','$file_name');";

if($conn->query($insertQuery) == TRUE){
    header("Location: index.php");
}else{
    echo "Error: ".$conn->error;
}