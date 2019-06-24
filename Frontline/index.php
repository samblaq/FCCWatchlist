<?php
    date_default_timezone_set('UTC');

    include("databaseConnection.php");

    $sql_Watchlist = "SELECT * FROM WatchList";
    $result = sqlsrv_query($conn,$sql_Watchlist);

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard One | Notika - Notika Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        Hello
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="list-inline nav navbar-nav notika-top-nav">
                            <li class="nav-item">
                                Hello
                            </li>
                            <li class="nav-item">
                                Hello
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3>Hello World</h3>
                    </div>

                    <div class="body">
                        <div class="table-responsive">
                            <table id="watchlist" class="table table-striped table-bordered">
                                <?php
                                // print_r($result);
                                    if ($result > 0) {
                                        echo"
                                            <thead>
                                                <tr>
                                                    <th>Date of Notice</th>
                                                    <th>Regulator</th>
                                                    <th>Reference Number</th>
                                                    <th>Individual/Entity</th>
                                                    <th>LinkedTo</th>
                                                    <th>Subject Name</th>
                                                    <th>Alias</th>
                                                    <th>Country</th>
                                                    <th>Further Info</th>
                                                </tr>
                                            </thead>
                                        ";
                                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                                            echo"
                                                <tr>
                                                    <td>".$row['DateOfNotice']."</td>
                                                    <td>".$row['Regulator']."</td>
                                                    <td>".$row['ReferenceNumber']."</td>
                                                    <td>".$row['IndividualEntity']."</td>
                                                    <td>".$row['LinkedTo']."</td>
                                                    <td>".$row['SubjectName']."</td>
                                                    <td>".$row['Alias']."</td>
                                                    <td>".$row['Country']."</td>
                                                    <td>".$row['FurtherInfo']."</td>
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
    </div>
   
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018 
                                        . All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
    <!-- jquery
        ============================================ -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    
    <script>
        $(document).ready(function(){
            $('#watchlist').DataTable();
        });                                                
    </script>
</body>

</html>