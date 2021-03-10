<?php 
    session_start();
    require('connect.php');
    if(!isset($_SESSION['user_username'])){
        header("Location:signin.php");
        exit();
    }
    $user = $_SESSION['user_username'];
    $get_user = "select * from users where user_username = '$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);
    $user_username = $row['user_username'];
    $insert = "insert into users_friend (user_username, friend_username)values ('$user_username', '{$_GET['id']}')";
    $query = mysqli_query($con, $insert);
    if($query){
        echo "<script>window.open('find_friends.php','_self')</script>";
    }
?>