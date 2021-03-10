<?php 
    session_start();
    require('connect.php');
    if(!isset($_SESSION['user_username'])){
        header("Location:signin.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&Berkshire+Swash&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="find_friends.css">
</head>

<body>
<div style='margin-top: 6%'></div>
    <?php 
        $user = $_SESSION['user_username'];
        $get_user = "select * from users where user_username = '$user'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);
        $user_username = $row['user_username'];
        $user_pass = $row['user_pass'];
        $user_name = $row['user_name'];
        $user_profile = $row['user_profile'];
        $user_gender = $row['user_gender'];
        require('header.php'); 
        if(isset($_SESSION['search'])){
            $search_query = $_SESSION['search'];
            $get_user = "select * from users where user_name like '%$search_query%'or user_username like '%$search_query%'";
        }
        else{
            $get_user = "SELECT * FROM USERS order by user_name DESC LIMIT 5";
        }
        $result = $con->query($get_user);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $all_username = $row['user_username'];
                if($all_username != $user_username){
                    $check = 10;
                    $friend_user = "select * from users_friend where user_username = '$user_username' ";
                    $result_friend = $con->query($friend_user);
                    if($result_friend->num_rows > 0) {
                        while($row_friend = $result_friend->fetch_assoc()) {
                            if($row['user_username'] == $row_friend['friend_username'] ){
                                $check = 1;
                                break;
                            }
                            else{
                                $check = 0;
                            }

                            
                            
                        }
                    }
                    else{
?>
                        <div class='card'>
                                    <img src='<?php echo $row['user_profile'] ?>'>
                                    <h1>
                                        <?php echo $row['user_name'] ?>
                                    </h1>
                                    <p>
                                        <?php echo $row['user_gender'] ?>
                                    </p>
                                    <a href="add_friends.php?id=<?php echo $row['user_username']; ?>">
                                        <p><button class='btn btn-success'>Add as friend</button></p>
                                    </a>
<?php
                    }
                    if($check == 1){
?>
                        <div class='card'>
                            <img src='<?php echo $row['user_profile'] ?>'>
                            <h1>
                                <?php echo $row['user_name'] ?>
                            </h1>
                            <p>
                                <?php echo $row['user_gender'] ?>
                            </p>
                            <a href="delete_friends.php?id=<?php echo $row['user_username']; ?>">
                                <p><button class='btn btn-danger'>Unfriend</button></p>
                            </a>
<?php
                    }
                    else if($check == 0){
?>
                        <div class='card'>
                                    <img src='<?php echo $row['user_profile'] ?>'>
                                    <h1>
                                        <?php echo $row['user_name'] ?>
                                    </h1>
                                    <p>
                                        <?php echo $row['user_gender'] ?>
                                    </p>
                                    <a href="add_friends.php?id=<?php echo $row['user_username']; ?>">
                                        <p><button class='btn btn-success'>Add as friend</button></p>
                                    </a>
<?php
                    }
                    echo"
                        </div><br>
                        ";
                }
            }
        }
    ?>
</body>
</html>
                                
                                