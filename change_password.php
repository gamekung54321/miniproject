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
</head>
<body>
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
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8" style="margin-top: 6%;">
            <form action="" method="post">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td class="active" colspan="6">
                            <h2>Change Password</Canvas></h2>
                            <?php if(true) { ?>
                            <?php if (isset($_SESSION['error'])) : ?>
                            <div class='alert alert-danger'>
                                <strong>
                                    <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                                </strong>

                            </div>
                            <?php endif ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Current Password</td>
                        <td>
                            <input type="password" name="current_pass" id="mypass" class="form-control" required placeholder="Current Password"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">New Password</td>
                        <td>
                            <input type="password" name="u_pass1" id="mypass" class="form-control" required placeholder="New Password"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Confirm Password</td>
                        <td>
                            <input type="password" name="u_pass2" id="mypass" class="form-control" required placeholder="Confirm Password"/>
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="6">
                            <input type="submit" name="change" value="Change" class="btn btn-info"/>
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
            if(isset($_POST['change'])){
                $c_pass = $_POST['current_pass'];
                $pass1 = $_POST['u_pass1'];
                $pass2 = $_POST['u_pass2'];
                $user = $_SESSION['user_username'];
                $c_pass = md5($c_pass);
                $get_user = "select * from users where user_username = '$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);
                $user_password = $row['user_pass'];
                if($c_pass !== $user_password){
                    $_SESSION['error'] = "Your Old password didn't match.";
                    echo "<script> window.open('change_password.php', '_self')</script>";
                }
                if($pass1 != $pass2){
                    $_SESSION['error'] = "Your New password didn't match with confirm password.";
                    echo "<script> window.open('change_password.php', '_self')</script>";
                }
                
                if($pass1 == $pass2 AND $c_pass == $user_password){
                    $pass1 = md5($pass1);
                    $update_pass = mysqli_query($con, "UPDATE users SET user_pass='$pass1' WHERE user_username ='$user'");
                    $_SESSION['success'] = "Your password is changed.";
                    echo "<script> window.open('account_settings.php', '_self')</script>";
                }
            }
            ?>
        </div>
        <div class="col-sm 2">
        </div>
    </div>
</body>
</html>