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

//check if username is valid with the help of AJAX
if(isset($_POST['user_name_check'])) {
    $user_name = $_POST['user_name_check'];

    $selectQuery = "SELECT * FROM users WHERE user_name='$user_name';";
    $result = $conn->query($selectQuery);

    if($result->num_rows>0){
        echo "exists";
    } else {
        echo "available";
    }
}

else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //user details
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password = md5($password);

    //image
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'uploads/'.$file_name;

    $checkUserName = "SELECT * FROM users WHERE user_name = '$user_name';";
    $result = $conn->query($checkUserName);

    //if the username is already in user
    if($result->num_rows>0){
        echo "username already in use";
    }
    else{
        $checkEmail = "SELECT * FROM users WHERE email='$email';";
        $result = $conn->query($checkEmail);

        //if the email is already in user
        if($result->num_rows>0){
            echo "This Email is already in use";
        }
        else{
            //inserting data into the database
            $insertQuery = "INSERT INTO users(full_name,user_name,email,address,phone,birthdate,password, image_name)
            VALUES ('$full_name','$user_name','$email','$address','$phone','$birthdate','$password','$file_name');";

            if($conn->query($insertQuery) == TRUE){
                header("Location: index.php");
            }else{
                echo "Error: ".$conn->error;
            }
        }
    }
}

