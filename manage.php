<?php
    date_default_timezone_set('UTC');

    include("session.php");
    include("databaseConnection.php");

    if (!isset($_SESSION["PWID"])) {
        header("Location: index.php");
        exit();
    }

    $sql_staff = "SELECT * FROM staff";
    $result = sqlsrv_query($conn, $sql_staff);
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
        <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/web-fonts/css/all.min.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">

        <style>
            th{
                background-color:powderblue;
            }
        </style>
    </head>
    <body class="skin-black">
        <header class="header">
                <div class="logo">
                    FCC Admin
                </div>
            <nav class="navbar navbar-static-top" role="navigation">
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
                    </h1>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3>Manage Users</h3>
                                    <br>
                                </div>

                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="users" class="table table-striped table-bordered">
                                            <?php
                                            // print_r($result);
                                                if ($result > 0) {
                                                    echo"
                                                        <thead>
                                                            <tr>
                                                                <th>Bank ID</th>
                                                                <th>Full Name</th>
                                                                <th>Password</th>
                                                                <th>Role</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    ";
                                                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                                                        echo"
                                                            <tr>
                                                                <td>".$row['PWID']."</td>
                                                                <td>".$row['name']."</td>
                                                                <td>".$row['password']."</td>
                                                                <td>".$row['role']."</td>
                                                                <form action=''EditUser.php?id=".$row['id']."'' method='POST'>
                                                                    <td style='text-align:center'>
                                                                        <a href='EditUser.php?id=".$row['id']."' class='btn btn-warning btn-xs'><i class='fas fa-edit'></i> Edit</a> &nbsp&nbsp
                                                                        <a href=".$row['id']." class='btn btn-danger btn-xs'><i class='fas fa-trash'></i> Delete</a>
                                                                    </td> 
                                                                <form>
                                                                
                                                            </tr>
                                                        ";
                                                    }
                                                }else{
                                                    echo "Oops you have no records !!!";
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </aside> 
        </div>
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        
        <script>
            $(document).ready(function(){
                $('#users').DataTable();
            });                                                
        </script>
    </body>
</html>


