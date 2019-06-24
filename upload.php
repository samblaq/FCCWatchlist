<?php
    date_default_timezone_set('Africa/Accra');
    require('library/php-excel-reader/excel_reader2.php');
    require('library/SpreadsheetReader.php');
    require('library/SpreadsheetReader_XLSX.php');

    

    include("session.php");
    include("databaseConnection.php");

    if (!isset($_SESSION["PWID"])) {
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['upload'])) {
        $mimes = array('application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet','application/vnd.openxmlformats-officedocument.spreadsheet.sheet');

        if (in_array($_FILES["file"]["type"] , $mimes)) {
            $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);

            move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
            
            $Reader = new SpreadsheetReader($uploadFilePath);

            $totalSheet = count($Reader->Sheets());

            // echo "You have total ".$totalSheet." sheets";

            $html = "<table border='1'>";
            $html = "<tr><th>PWID</th><th>Name</th><th>Email</th></tr>";

            //Looping through sheets
            for ($i=0; $i < $totalSheet; $i++) { 
                $Reader->ChangeSheet($i);

                foreach ($Reader as $Row ) {
                    $html.= "<tr>";
                    $DON = isset($Row[0]) ? $Row[0]: '';
                    $Reg = isset($Row[1]) ? $Row[1]: '';
                    $Ref = isset($Row[2]) ? $Row[2]: '';
                    $IdType = isset($Row[3]) ? $Row[3]: '';
                    $IdNum = isset($Row[4]) ? $Row[4]: '';
                    $IndiEnti = isset($Row[5]) ? $Row[5]: '';
                    $Occupation = isset($Row[6]) ? $Row[6]: '';
                    $BirthPlace = isset($Row[7]) ? $Row[7]: '';
                    $LinkedTo = isset($Row[8]) ? $Row[8]: '';
                    $SubName = isset($Row[9]) ? $Row[9]: '';
                    $Alias = isset($Row[10]) ? $Row[10]: '';
                    $Address = isset($Row[11]) ? $Row[11]: '';
                    $City = isset($Row[12]) ? $Row[12]: '';
                    $Country = isset($Row[13]) ? $Row[13]: '';
                    $Month = isset($Row[14]) ? $Row[14]: '';
                    $Day = isset($Row[15]) ? $Row[15]: '';
                    $Year = isset($Row[16]) ? $Row[16]: '';
                    $BIC = isset($Row[17]) ? $Row[17]: '';
                    $Location = isset($Row[18]) ? $Row[18]: '';
                    $FurtherInfo = isset($Row[19]) ? $Row[19]: '';
                    $Contact = isset($Row[20]) ? $Row[20]: '';
                    $Other = isset($Row[21]) ? $Row[21]: '';

                    // $html.="<td>".$PID."</td>";
                    // $html.="<td>".$Name."</td>";
                    // $html.="<td>".$Email."</td>";
                    // $html.="</tr>";

                    $query_FileUpload = "INSERT INTO WatchList(DateOfNotice,Regulator,ReferenceNumber,IdType,IdNumber,IndividualEntity,Occupation,BirthPlace,LinkedTo,SubjectName,Alias,StreetResAdd,City,Country,DOBMonth,DOBDay,DOBYear,BIC,Location,FurtherInfo,TelContact,Others)
                     VALUES('".$DON."','".$Reg."','".$Ref."','".$IdType."','".$IdNum."','".$IndiEnti."','".$Occupation."','".$BirthPlace."','".$LinkedTo."','".$SubName."','".$Alias."','".$Address."','".$City."','".$Country."','".$Month."','".$Day."','".$Year."','".$BIC."','".$Location."','".$FurtherInfo."','".$Contact."','".$Other."')";
                    sqlsrv_query($conn , $query_FileUpload);
                }
            }

            $html.="</table>";

            $uploadSuccess = "File Uploaded Successfully";
        }
        else{
            $FileTypeError = "Sorry, File type not allowed - only Excel File Types";
            // die($FileTypeError);
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

       
            /* html{
                height:auto;
            } */
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
                    <h3>
                        Watchlist File Upload
                    </h3>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><strong>Upload a File</strong></h3>
                                </div>

                                <div class="body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="file" name="file" class='form-control'>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <input type="submit" class="form-control btn btn-info" name='upload' value='Upload'>
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


