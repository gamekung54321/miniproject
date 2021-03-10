<?php 
    require('connect.php');
    if(isset($_POST['sign_in'])){
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $errors = 0;
        if($errors == 0){
            $pass = md5($pass);
            $select_user = "select * from users where user_username = '$username' AND user_pass='$pass'";
            $query = mysqli_query($con, $select_user);
            $check_user = mysqli_num_rows($query);
            if($check_user == 1){
                $_SESSION['user_username'] = $username;
                $update_msg = mysqli_query($con, "UPDATE users SET log_in ='Online' WHERE user_username = '$username'");
                $user = $_SESSION['user_username'];
                $get_user = "select * from users where user_username = '$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);
                $user_name = $row['user_name'];
                echo "<script>window.open('home.php','_self')</script>";
            }
            else{
                $_SESSION['error'] = "Check your email and password.";
                header("Location: signin.php");
                $errors = 1;
            }
        }
    }
?>