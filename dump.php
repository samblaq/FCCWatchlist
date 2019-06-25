<?php
    date_default_timezone_set('UTC');

    include("session.php");
    include("databaseConnection.php");

    if (!isset($_SESSION["PWID"])) {
        header("Location: index.php");
        exit();
    }

    $sql_Watchlist = "SELECT * FROM WatchList";
    $result = sqlsrv_query($conn, $sql_Watchlist);
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
                    <?php 
                    include "side-bar-menu.php"; 
                    $filtered_array = [];
                    ?>
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Dump
                    </h1>
                    <!-- <a href="#" id="test" onClick="" class="btn btn-warning">Download</a> -->
                    <a href="#" onClick = "" class="btn btn-warning">Download</a>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3>SCB FCC Internal Watchlist Dump</h3>
                                </div>

                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="myTable" class="watchlist table table-striped table-bordered">
                                            <?php
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
                </section>
            </aside> 
        </div>
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        
        <script>
            function generatePDF(data1){
                console.log(data1);
                $.ajax({
                    url: "pdfgen.php",
                    type: "POST",
                    data: {filtered: JSON.stringify(data1)},
                    dataType: 'json',
                    success: function(data){
                        alert('success '+data);
                    },
                    error: function(err){
                        alert('error '+err[0]);
                    }
                });
                
            }
        </script>


         <script>
        function fnExcelReport(){
            var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
            tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
            tab_text = tab_text + '<x:Name>Client Engagement</x:Name>';
            tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
            tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
            tab_text = tab_text + "<table border='1px'>";
            tab_text = tab_text + $('#myTable').html();
            tab_text = tab_text + '</table></body></html>';
            var data_type = 'data:application/vnd.ms-excel';
            $('#test').attr('href' , data_type + ', ' + encodeURIComponent(tab_text));
            $('#test').attr('download', 'ClientEngagement.xls');
        }
    </script>

    <script>
        var table = $('.watchlist').DataTable({

        })  

table.on('search.dt', function() {
    // number of filtered rows
    // console.log(table.rows( { filter : 'applied'} ).nodes().length);
    // filtered rows data as arrays
    // console.log(table.rows( { filter : 'applied'} ).data()); 
        
    filtered_array = table.rows( { filter : 'applied'} ).data();
    
    generatePDF(filtered_array);
    // console.log($filtered_array);
    
})
    </script>    
    </body>
</html>


