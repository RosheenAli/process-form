<?php

// define variables and set to emppty values
$name=$email=$password="";
$nameErr=$emailErr=$passwordErr="";

//function to sanitize data

function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return$data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //validate name
    if (empty($_POST["name"])) {
        $nameErr="Name Is Required";
    } else{
        $name=test_input($_POST["name"]);
        //check if number contains letters and white spaces
        if(!preg_match("/^[a-zA-Z-']*$/",$name)) {
            $nameErr="Only letters and white space allowed";
        }
    }
}

//validate email
if (empty($_POST["email"])) {
    $emailErr="Email Is Required";
} else{
    $email=test_input($_POST["email"]);
    // check if email is well formed
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $emailErr=" invalid email format";
    }
}
//validate password
if (empty($_POST["password"])) {
    $emailErr="Password is required Is Required";
} else{
    $password=test_input($_POST["password"]);
    //check password strength minimum 8 characters,atleast 1 number)
    if(strlen($password)<8|| !preg_match("/[0-9]/", $password)) {
        $passwordErr="pasword must be atleast 8 characters long and include atleast one number";
    }
    }

    // if no errors ,process the data (e.g., save to a data base)
    if (empty($nameErr)&&empty($emailErr)&&empty($passwordErr)) {
        echo"Form submitted successfully!";
        // here you would typically insert data into a database.
    }
?>
