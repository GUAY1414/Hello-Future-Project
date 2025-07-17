<?php
    
    require "config/db.php";

    $username           = $_POST['uname'];
    $password           = $_POST['pword'];
    $confirmpass   = $_POST['cfpword'];
    $firstname          = $_POST['fname'];
    $lastname           = $_POST['lname'];

    if($password != $confirmpass){
        echo "<script>
        alert('Passwords do not match');
        location.href='register.php';
        </script>";
    }else{
        echo "<script>
        alert('Registration successful!');
        location.href='login.php';
        </script>";
    }

?>