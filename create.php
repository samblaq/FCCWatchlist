<?php
    date_default_timezone_set('UTC');

    include("session.php");
    include("databaseConnection.php");

    // if (!isset($_SESSION["PWID"])) {
    //     header("Location: index.php");
    //     exit();
    // }
    
    if (isset($_POST['submit'])) {
        function sanitize($data){
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            $data = trim($data);
            return $data;
        }

        if (empty($_POST['PWID']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['role'])) {
            $EmptyField = "Please provide all details";
        }elseif (!is_numeric($_POST['PWID'])) {
            $notNumeric = "Please, Bank ID should be numeric";
        }elseif (strlen($_POST['password']) < 8) {
            $passwordLength = "Password length should be greater than 8 chars";
        }elseif(strlen($_POST['PWID']) != 7){
            $pwidLength = "Bank ID should be equal to 7 digits";
        }else{
            $PWID = sanitize($_POST['PWID']);
            $password = sanitize($_POST['password']);
            $name = sanitize($_POST['name']);
            $role = sanitize($_POST['role']);

            $sql_CreateUser = "INSERT INTO staff(name,PWID,password,role) VALUES('$name','$PWID','$password','$role')";
            $result = sqlsrv_query($conn,$sql_CreateUser);

            $UserSuccess = "User with ID - $PWID has successfully been created";
        }
    }

?>

<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <title>Admin - FCC WATCHLIST</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="assets/img/cropped-sc-touch-icon-192x192.png">
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="assets/web-fonts/css/all.min.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
        <style>
         #note {
            position: absolute;
            z-index: 101;
            top: 0;
            left: 0;
            right: 0;
            font-size: 16px;
            color: white;
            background: green;
            text-align: center;
            line-height: 3;
            overflow: hidden; 
            -webkit-box-shadow: 0 0 5px black;
            -moz-box-shadow:    0 0 5px black;
            box-shadow:         0 0 5px black;
        }

        @-webkit-keyframes slideDown {
            0%, 100% { -webkit-transform: translateY(-50px); }
            10%, 90% { -webkit-transform: translateY(0px); }
        }

        @-moz-keyframes slideDown {
            0%, 100% { -moz-transform: translateY(-50px); }
            10%, 90% { -moz-transform: translateY(0px); }
        }

        .cssanimations.csstransforms #note {
            -webkit-transform: translateY(-50px);
            -webkit-animation: slideDown 5s 1.0s 1 ease forwards;
            -moz-transform:    translateY(-50px);
            -moz-animation:    slideDown 5s 1.0s 1 ease forwards;
        }

        .cssanimations.csstransforms #close {
            display: none;
        }

        body{
            height:100%;
            width:100%;
        }
        </style>

        <style>
            th{
                background-color:powderblue;
            }
        </style>
    </head>
    <script src="assets/js/modernizr.custom.80028.js"></script>
    <body class="skin-black">
        <header class="header">
                <div class="logo">
                    FCC Admin
                </div>
            <nav class="navbar navbar-static-top" role="navigation">
            <?php include("errorandsuccessmessages.php"); ?>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <?php 
                            include("user-account-bar.php");
                        ?>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                <br>
                    <br>    
                    <?php include "side-bar-menu.php"; ?>
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Users
                    </h1>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3> Create User</h3>
                                    <br>
                                </div>

                                <div class="body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="fname" class="label-control">FullName</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="pwid" class="label-control">Bank ID</label>
                                            <input type="text" name="PWID" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="role" class="label-control">Role</label>
                                            <select name="role" id="role" class="form-control"> 
                                                <option value="0">-- Select Role --</option>
                                                <option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="label-control">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="Create User" class="btn btn-info form-control">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </aside> 
        </div>
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>


