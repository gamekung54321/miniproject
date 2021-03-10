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
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class = "main-chat">
        <div class ="row">
            <div>
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
                ?>
            </div>
            <div class ="left-chat bg-dark">
                <?php 
                    $user_username = $_SESSION['user_username'];
                    $user = "select * from users";
                    $result = $con->query($user);
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                if($row['user_username'] != $user_username){
                                    $friend_user = "select * from users_friend where user_username = '$user_username' ";
                                    $result_friend = $con->query($friend_user);
                                    if($result_friend->num_rows > 0) {
                                        while($row_friend = $result_friend->fetch_assoc()) {
                                            if($row['user_username'] == $row_friend['friend_username'] ){
                ?>
                                                <ul>
                                                    <li>
                                                    <?php
                                                        if($row['log_in'] == 'Online'){
                                                    ?>
                                                            <div class='chat-left-img-online'>
                                                                <img src = '<?php echo $row['user_profile']; ?>'>
                                                            </div>
                                                            <div class ='chat-left-details'>
                                                                <p ><a href='home.php?user_name=<?php echo $row['user_name']; ?>'><?php echo $row['user_name']; ?></a></p>
                                                                <span class ='text-success'><i class='fa fa-circle' aria-hidden = 'true'></i> Online</span>
                                                            </div>
                                                    <?php
                                                        }
                                                        else{
                                                    ?>
                                                            <div class='chat-left-img-offline'>
                                                                <img src = '<?php echo $row['user_profile']; ?>'>
                                                            </div>
                                                            <div class ='chat-left-details'>
                                                                <p ><a href='home.php?user_name=<?php echo $row['user_name']; ?>'><?php echo $row['user_name']; ?></a></p>
                                                                <span class ='text-danger'><i class='fa fa-circle' aria-hidden = 'true'></i> Offline</span>
                                                            </div>
                <?php
                                                        }
                                                echo "
                                                    </li>
                                                </ul>
                                                ";
                                            }
                                        }
                                    }  
                                    else{
                                        
                                    }    
                                }
                            }
                        }
                ?>
            </div>
            <div class ="right-chat">
                <?php 
                    if(isset($_GET['user_name'])){
                        
                 ?>
                    <tr>
                        <div id="scrolling_to_bottom" class="right-header-contentChat">
                            <?php 
                                    $username = $_GET['user_name'];
                                    $user_username = $_SESSION['user_username'];
                                    $get = "select * from users where user_name = '$username'";
                                    $run = mysqli_query($con, $get);
                                    $row = mysqli_fetch_array($run);
                                    $u_username = $row['user_username'];
                                    $get_color = "select * from users_friend where user_username = '$user_username' AND friend_username = '$u_username'";
                                    $run_color = mysqli_query($con, $get_color);
                                    $row = mysqli_fetch_array($run_color);
                                    $color = $row['color_chat'];
                                    $update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status = 'read' WHERE sender_username ='$username' 
                                        AND receiver_username = '$user_name'");
                                    if(isset($_POST['search_chat'])){
                                        $search_chat = $_POST['msg_content'];
                                        $sel_msg = "select * from users_chat where msg_content like '%$search_chat%' ORDER by 1 ASC";
                                    }
                                    else{
                                        $sel_msg = "select * from users_chat where (sender_username = '$user_name' AND receiver_username = '$username')
                                    OR (receiver_username = '$user_name' AND sender_username = '$username') ORDER by 1 ASC";
                                    }
                                    
                                    $run_msg = mysqli_query($con, $sel_msg);
                                    while ($row = mysqli_fetch_array($run_msg)){
                                        $msg_id = $row['msg_id'];
                                        $sender_username = $row['sender_username'];
                                        $receiver_username = $row['receiver_username'];
                                        $msg_content = $row['msg_content'];
                                        $msg_date = $row['msg_date'];
                                        $msg_status = $row['msg_status'];
                            ?>
                            <ul>
                                <?php 
                                    if($user_name == $sender_username AND $username == $receiver_username){
                                        echo "
                                            <li>
                                                <div class = 'rightside-right-chat'>
                                                    <span>$user_name<small> $msg_date</small></span>
                                                    <br><br>
                                                    <p class ='conetent $color'>$msg_content</p>
                                                    <br><br><br>
                                                    <p style = 'margin-left: 31%;'>$msg_status
                                                        <a style = 'float: right; text-decoration:none; color: red;' href='delete_chat.php?id=$msg_id&user=$username'>delete</a>
                                                    </p>
                                                </div>
                                            </li>
                                        ";
                                    }
                                    else if($user_name == $receiver_username AND $username == $sender_username){
                                        echo "
                                            <li>
                                                <div class = 'rightside-left-chat'>
                                                    <span>$username <small> $msg_date</small></span>
                                                    <br><br>
                                                    <p class ='conetent'>$msg_content</p>
                                                </div>
                                            </li>
                                        ";
                                    }
                                ?>
                            </ul>
                            <?php 
                                }
                            ?>
                        </div>
                    </tr>
                    <tr>
                        <div class="right-chat-textbox">
                            <form class="form-inline" method="post">
                                <input type="text" class="form-control mr-sm-2" autocomplete="off" name="msg_content" placeholder = "Write your message........">
                                <button class="btn btn-primary mr-sm-2" name="submit"><i class="fas fa-location-arrow fa-lg"></i></button>
                                <button class="btn btn-secondary mr-sm-2" style = "border-radius: 50px;" name="search_chat"><i class="fas fa-search fa-lg"></i></button>
                                <h2 class = "mr-sm-2">|</h2>
                                <a href="?emoji=&#x1F600&user_name=<?php echo $username?>" class = "mr-sm-2" style="text-decoration:none"><h3>&#x1F600</h3></a>
                                <a href="?emoji=&#x1F47F&user_name=<?php echo $username?>" class = "mr-sm-2" style="text-decoration:none"><h3>&#x1F47F</h3></a>
                                <a href="?emoji=&#x2764&user_name=<?php echo $username?>" class = "mr-sm-2" style="text-decoration:none"><h3>&#x2764</h3></a>
                                <h2 class = "mr-sm-2">|</h2>
                                <a href="?color=bg-primary&user_name=<?php echo $username?>" class = "mr-sm-2" style="text-decoration:none"><i class='fa fa-circle fa-2x text-primary' aria-hidden = 'true'></i></a></p>
                                <a href="?color=bg-danger&user_name=<?php echo $username?>" class = "mr-sm-2" style="text-decoration:none"><i class='fa fa-circle fa-2x text-danger' aria-hidden = 'true'></i></a></p>
                                <a href="?color=bg-info&user_name=<?php echo $username?>" class = "mr-sm-2" style="text-decoration:none"><i class='fa fa-circle fa-2x text-info' aria-hidden = 'true'></i></a></p>      
                                <a href="?color=bg-warning&user_name=<?php echo $username?>" class = "mr-sm-2" style="text-decoration:none"><i class='fa fa-circle fa-2x text-warning' aria-hidden = 'true'></i></a></p>
                            </form>
                        </div>
                    </tr>
                <?php 
                    }
                    else{
                        echo "
                            <div class ='right-chat' style = 'height: 620px;'></div>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>
    <?php 
        if(isset($_GET['color'])){
            $username = $_GET['user_name'];
            $get = "select * from users where user_name = '$username'";
            $run_color = mysqli_query($con, $get);
            $row = mysqli_fetch_array($run_color);
            $u_username = $row['user_username'];
            $color = $_GET['color'];
            $insert = "update users_friend set color_chat = '$color' where user_username = '$user_username' AND friend_username = '$u_username'";
            $run_insert = mysqli_query($con, $insert);
            echo "<script>window.open('home.php?user_name=$username','_self')</script>";
        }
        if(isset($_GET['emoji'])){

            $msg = $_GET['emoji'];
            $username = $_GET['user_name'];
            if($msg == ""){
                
            }
            else {
                $insert_emoji = "insert into users_chat(sender_username, receiver_username, msg_content, msg_status, msg_date)
                    values('$user_name','$username','$msg', 'unread', NOW())";
                $run_emoji = mysqli_query($con, $insert_emoji);
                echo "<script>window.open('home.php?user_name=$username','_self')</script>";
            }
        }
        if(isset($_POST['submit'])){
            $msg = $_POST['msg_content'];
            if($msg == ""){
                
            }
            else {
                $user_username = $_SESSION['user_username'];
                $insert = "insert into users_chat(sender_username, receiver_username, msg_content, msg_status, msg_date)
                    values('$user_name','$username','$msg', 'unread', NOW())";
                $run_insert = mysqli_query($con, $insert);
                echo "<script>window.open('home.php?user_name=$username','_self')</script>";
            }
        }
    ?>
</body>
</html>