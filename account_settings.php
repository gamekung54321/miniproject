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
        $error = 0;
        require('header.php'); 
    ?>
    <div class="row">
        <div class="col-sm-2">
        </div>

        <div class="col-sm-8" style="margin-top: 6%">
            <form action="" method="post">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td class="active" colspan="6">
                            <h2>Change Account Settings</Canvas></h2>
                            <?php if(true) { ?>
                            <?php if (isset($_SESSION['success'])) : ?>
                            <div class='alert alert-success'>
                                <strong>
                                    <?php 
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            ?>
                                </strong>

                            </div>
                            <?php endif ?>
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
                        <td style="font-weight: bold;">Change Your Username</td>
                        <td>
                            <input type="text" name="u_username" class="form-control" autocomplete="off" required
                                value="<?php echo $user_username;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div style="text-align: center;">
                                <button class="btn btn-success" name="change_profile"
                                    style="height: auto; width: 50%; font-size: 15px;">
                                    <i class="fa fa-user fa-lg"></i> Change Your Profile
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Change Your Name</td>
                        <td>
                            <input type="text" name="u_name" class="form-control" autocomplete="off" required
                                value="<?php echo $user_name;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Change Your Gender</td>
                        <td>
                            <select name="u_gender" class="form-control">
                                <option>
                                    <?php echo $user_gender; ?>
                                </option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div style="text-align: center;">
                                <button class="btn btn-success" name="change_pass"
                                    style="height: auto; width: 50%; font-size: 15px; text-align: center;">
                                    <i class="fa fa-key fa-lg"></i> Change Your Password
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="6">
                            <input class="btn btn-info" type="submit" value="Update" name="update"></input>
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['change_profile'])){
                    echo "<script> window.open('upload.php', '_self')</script>";
                }
                if(isset($_POST['change_pass'])){
                    echo "<script> window.open('change_password.php', '_self')</script>";
                }
                if(isset($_POST['update'])){
                    $u_username = $_POST['u_username'];
                    $u_name = $_POST['u_name'];
                    $u_gender = $_POST['u_gender'];
                    $check_user = "select * from users where user_username ='$u_username'";
                    $run_user = mysqli_query($con, $check_user);
                    $check = mysqli_num_rows($run_user);
                    if($check ==1){
                        if($u_username != $user){
                            $_SESSION['error'] = "This username is already in use.";
                        echo "<script> window.open('account_settings.php', '_self')</script>";
                        $error = 1;
                        }
                    }
                    if($error == 0){
                        $update = "update users set user_username = '$u_username', user_name = '$u_name', user_gender = '$u_gender' where user_username = '$user'";
                        $run = mysqli_query($con, $update);
                        if($run){
                            $_SESSION['user_username'] = $u_username;
                            $_SESSION['success'] = "Your account is changed.";
                            echo "<script> window.open('account_settings.php', '_self')</script>";
                        }
                    }
                }
                ?>
        </div>
        <div class="col-sm 2">
        </div>
    </div>
</body>

</html>