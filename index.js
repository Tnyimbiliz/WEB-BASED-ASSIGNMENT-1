
document.addEventListener("DOMContentLoaded", function() {


    //check if the username entered is available
    document.getElementById("user_name").addEventListener("input",function(){
        checkUsernameAvailability();
    });

    function checkUsernameAvailability(){

        var username = document.getElementById("user_name").value;

        //Check if username is available using AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if (xhr.readyState === XMLHttpRequest.DONE){
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    //update availability message
                    document.getElementById("usernameAvailability").innerText = response === "exists"? "Username already exists." : "Available";
                    document.getElementById("usernameAvailability").style.color = response === "exists"? "red" : "green";
                    document.getElementById("usernameAvailability").style.fontWeight = response === "exists"? "bold" : "1";

                    //change the name tage in the profile card
                    document.getElementById("nameTag").innerHTML = username;
                } else {
                    console.error("Error checking username availability. Please try again later.");
                }
            }
        };

        xhr.open("POST","db_ops.php",true); 
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.send("user_name_check="+username);

    }

    // Client-side validation
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
        // Prevent form submission
        event.preventDefault();

        // Perform validation
        var fullName = document.getElementById("full_name").value;
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var email = document.getElementById("email").value;

        // Check if full name has 2 or 3 words
        var nameWords = fullName.trim().split(' ');
        if (nameWords.length < 2 || nameWords.length > 3) {
            alert("Full name must contain 2 or 3 words.");
            return;
        }

        // Check if password is at least 8 characters long and contains one number and one special character
        var passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
        if (!passwordPattern.test(password)) {
            alert("Password must be at least 8 characters long and contain at least one number and one special character.");
            return;
        }

        // Check if password and confirm password match
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return;
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailPattern.test(email)) {
            alert("Invalid email format. e.g 'example@email.com'");
            return;
        }

        document.getElementById("registrationForm").submit();

    });

    // Check Gender based off username using the third-party API
    document.getElementById("genderButton").addEventListener("click", function() {
        var fullname = document.getElementById("full_name").value;

        var xhr = new XMLHttpRequest(); 
        xhr.onreadystatechange = function(){
            if (xhr.readyState === XMLHttpRequest.DONE){
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    if(data.gender === "MALE") {
                        document.getElementById("genderResult").textContent =  data.gender;
                        document.getElementById("genderResult").style.color =  "cyan";
                    }else if(data.gender === "FEMALE") {
                        document.getElementById("genderResult").textContent =  data.gender;
                        document.getElementById("genderResult").style.color =  "#FF007F";
                    }else if(data.gender === "NEUTRAL") {
                        document.getElementById("genderResult").textContent =  data.gender;
                        document.getElementById("genderResult").style.color =  "#CBC3E3";
                    } else {
                        document.getElementById("genderResult").textContent =  data.gender;
                        document.getElementById("genderResult").style.color =  "red";
                    }
                } else {
                    document.getElementById("genderResult").textContent = "";
                }
            }
        };
        xhr.open("POST","api_ops.php",true);
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.send("full_name="+ fullname);
    });

});

//update profile picture on the website
let profilePic = document.getElementById("profilePic");
    let inputFile = document.getElementById("input-file");

    inputFile.onchange = function(){
        profilePic.src = URL.createObjectURL(inputFile.files[0]);
    }

   
