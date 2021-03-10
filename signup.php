<?php 
    session_start();
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <img class="wave" src="image/wave.png">
    <div class="backgroud">
        <img src="image/bg.svg">
    </div>
    <div class="signup-form">
        <div class="logo">
            <img src="image/logo.svg">
        </div>
        <h2 class="text-center">Create Account</h2>
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
        <form action="" method="post">
            <div class="form-group">
                <input name="username" type="text" autocomplete="off" required>
                <i class="fas fa-user fa-lg"></i>
                <div class="underline"></div>
                <label>Username</label>
            </div>
            <div class="form-group">
                <input name="pass1" type="password" autocomplete="off" required>
                <i class="fas fa-key fa-lg"></i>
                <div class="underline"></div>
                <label>Password</label>
            </div>
            <div class="form-group">
                <input name="pass2" type="password" autocomplete="off" required>
                <i class="fas fa-key fa-lg"></i>
                <div class="underline"></div>
                <label>Confirm password</label>
            </div>
            <div class="form-group">
                <input name="name" type="text" autocomplete="off" required>
                <i class="far fa-id-card fa-lg"></i>
                <div class="underline"></div>
                <label>Name</label>
            </div>
            <div class="form-gender">
                <i class="fas fa-venus-mars fa-lg"></i>
                <label>Gender</label>
                <select class="form-control" name="gender" required>
                    <option disabled="">Select a Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn" name="sign_up">Sign up</button>
            </div>
            <?php include("signup_user.php"); ?>
        </form>
        <br>
        <div class="text-center small" style="color: #67428B;">Already have an account?
            <a href="signin.php">Signin here</a>
        </div>
    </div>
</body>
</html>