<?php include 'header.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afri-code</title>
    <link rel="icon" href="favicon.png">
    <link rel="stylesheet" href="script.css">
</head>
<body>

<div class="container">
    <h2 id="registrationTitle">Registration Form</h2>
    <form id="registrationForm" action="db_ops.php" method="post" enctype="multipart/form-data">
        <div class="hero">
            <div class="card">
                <img src="profile.jpg" id="profilePic">
                <p id="nameTag"></p>
                <label for="input-file" id="input-label">Upload Image</label>
                <input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file" name="image" required>
            </div>
        </div>
        <input type="text" id="full_name" name="full_name" required placeholder="Full name">

        <button type="button" id="genderButton">Check Gender</button>
        <div id="genderResult" style="font-weight:bold;"></div>

        <input type="text" id="user_name" name="user_name" required placeholder="Username"><br>
        <span id="usernameAvailability"></span><br>

        <input type="date" id="birthdate" name="birthdate" required>
        <!--
        <button type="button" id="actorButton">check Actor</button>
        <div id="actorResult"></div>
        -->

        <input type="tel" id="phone" name="phone" required placeholder="Phone number">

        <input type="text" id="address" name="address" required placeholder="Address">

        <input type="password" id="password" name="password" required placeholder="Password">

        <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm Password">
        
        <input type="email" id="email" name="email" required placeholder="Email">

        <button type="submit" name="register" class="register" value="Register">Register</button>
    </form>
</div>
<script src="index.js"></script>
</body>
</html>


<?php include 'footer.php'; ?>