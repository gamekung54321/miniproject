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
            <form action="" method="post" enctype='multipart/form-data'>
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td class="active" colspan="6">
                            <h2>Change Profile</Canvas></h2>
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
                    <tr align="center">
                        <td colspan="6">
                            <img style='widht: 200px; height: 200px;' src='<?php echo $user_profile ?>'>
                        </td>

                    </tr>
                    <td style="font-weight: bold;">Change Your Profile</td>
                    <td>
                        <input type='file' name='u_image' size='60'>
                    </td>
                    <tr align="center">
                        <td colspan="6">
                            <input type="submit" name="update_profile" value="Update Profile" class="btn btn-info" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['update_profile'])){
                    $image = $_FILES['u_image']['name'];
                    $image_tmp = $_FILES['u_image']['tmp_name'];
                    $random_number = rand(1,100);
                    if($image == ''){
                        $_SESSION['error'] = "Please Select Profile.";
                        echo"<script>window.open('upload.php','_self')</script>";
                        
                    }
                    else{
                        move_uploaded_file($image_tmp,"images/$image.$random_number");
                        $update = "update users set user_profile = 'images/$image.$random_number' where user_username = '$user'";
                        $run = mysqli_query($con, $update);
                        if($run){
                            $_SESSION['success'] = "Your profile is changed.";
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