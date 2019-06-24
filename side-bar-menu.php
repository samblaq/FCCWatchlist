 <?php
    // include('databaseconnection.php');
    // include("session.php");

    // $sqlRole = "SELECT role  FROM staff where PWID = '$Employee_FullName'";
    // $result = sqlsrv_query($conn, $sqlRole);

    // while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
    //     if($row['role'] == 'Admin'){
    //         echo"
                // <ul class='sidebar-menu'>
                //     <li>
                //         <a href='upload.php'>
                //             <i class='fas fa-file-upload'></i> <span> Upload CSV</span>
                //         </a>
                //     </li>
                //     <li>
                //         <a href='dump.php'>
                //             <i class='fas fa-eye'></i> <span> Watchlist</span>
                //         </a>
                //     </li>
                //     <li>
                //         <a href='create.php'>
                //             <i class='fas fa-user'></i> <span> Create User</span>
                //         </a>
                //     </li>
                //     <li>
                //         <a href='manage.php'>
                //             <i class='fas fa-users'></i> <span> Manage Users</span>
                //         </a>
                //     </li> 
                // </ul>              
    //         ";
    //     }else{
    //         echo"
    //         <ul class='sidebar-menu'>
    //             <li>
    //                 <a href='dump.php'>
    //                     <i class='fas fa-eye'></i> <span> Watchlist</span>
    //                 </a>
    //             </li>
    //         </ul>
    //         ";
    //     }
    // }
?>
<ul class='sidebar-menu'>
                    <li>
                        <a href='upload.php'>
                            <i class='fas fa-file-upload'></i> <span> Upload CSV</span>
                        </a>
                    </li>
                    <li>
                        <a href='dump.php'>
                            <i class='fas fa-eye'></i> <span> Watchlist</span>
                        </a>
                    </li>
                    <li>
                        <a href='create.php'>
                            <i class='fas fa-user'></i> <span> Create User</span>
                        </a>
                    </li>
                    <li>
                        <a href='manage.php'>
                            <i class='fas fa-users'></i> <span> Manage Users</span>
                        </a>
                    </li> 
                </ul>