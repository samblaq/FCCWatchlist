<?php
	$serverName = "SAMMY";
	$connectionInfo = array("Database" =>"FCC" , "UID"=>"FCCWATCHLIST" , "PWD" => "FCCWATCHLIST2019");

	$conn = sqlsrv_connect($serverName , $connectionInfo);

	if(!$conn){
		echo "Connection could not be established.<br />";
		die(print_r(sqlsrv_errors() , true));
	}

?>