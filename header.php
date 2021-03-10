<?php 
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
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <a class='navbar-brand' href='home.php'><i class="fas fa-home fa-2x"></i></a>
        <form class="form-inline" action="" method="post">
            <input class="form-control mr-sm-2" type="text" name="search_query" autocomplete="off" placeholder="Search Friends">
            <button class="btn btn-success " type="submit" name = "search_btn" style="border-radius: 50%;"><i class="fas fa-search fa-lg"></i></button>
        </form>
        <div class="ml-auto">
            <form action="" method="post">
                <ul class="navbar-nav">
                    <li class="nav-time">
                        <div class = "right-bar-img">
                            <img src=<?php echo "$user_profile"; ?> >
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class ="user_name" ><?php echo "$user_name" ?></div>
                    </li>
                    <li class="nav-item">
                        <a class='nav-link' href="account_settings.php"><i class="fas fa-cog fa-2x icon_setting"></i></a>
                    </li>
                    <li class = "nav-item" style = "padding-top: 5px;">
                        <button name="logout" class="btn btn-danger">Logout</button>
                    </li>
                </ul>
            </form>
        </div>
        
    </nav>
</body>
<?php 
    if(isset($_POST['logout'])){
        $update_msg = mysqli_query($con,"UPDATE users SET log_in = 'Offline' WHERE user_name ='$user_name'");
        header("Location:logout.php");
        exit();
    }

    if(isset($_POST['search_btn'])){
        $_SESSION['search'] = $_POST['search_query'];
        echo "<script> window.open('find_friends.php', '_self')</script>";
    }
?>
</html>