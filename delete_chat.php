<?php 
    session_start();
    require('connect.php');
    if(!isset($_SESSION['user_username'])){
        header("Location:signin.php");
        exit();
    }
    $username = $_GET['user'];
    $delete = "delete from users_chat where msg_id = '{$_GET['id']}'";
    $query = mysqli_query($con, $delete);
    if($query){
        echo "<script>window.open('home.php?user_name=$username','_self')</script>";
    }
?>