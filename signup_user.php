<?php
    require('connect.php');
    if(isset($_POST['sign_up'])){
        $username = $_POST['username'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $errors = 0;
        if($name == ''){
            echo "<script>alert('We can not verify your name')</script>";
        }
        $check_user = "select * from users where user_username ='$username'";
        $run_user = mysqli_query($con, $check_user);
        $check = mysqli_num_rows($run_user);
        if($check ==1){
            $_SESSION['error'] = "This username is already in use.";
            header("Location: signup.php");
            $errors = 1;
        }
        else if ($pass1 != $pass2){
            $_SESSION['error'] = "Those passwords didn't match.";
            header("Location: signup.php");
            $errors = 1;
        }
        if($gender == 'Male')
            $profile_pic = "images/male.png";
        else if($gender == 'Female')
            $profile_pic = "images/female.png";
        if($errors == 0){
            $pass = md5($pass1);
            $insert = "insert into users (user_username, user_pass, user_name, user_profile, user_gender) 
            values ('$username', '$pass', '$name', '$profile_pic', '$gender')";
            $query = mysqli_query($con, $insert);
            if($query){
                echo "<script>alert('Congratulations $username, your account has been created successfully')</script>";
                echo "<script>window.open('signin.php','_self')</script>";
            }
            else{
                echo "<script>alert('Registration failed, try again!')</script>";
                echo "<script>window.open('signup.php','_self')</script>";
            }
        }
    }
?>