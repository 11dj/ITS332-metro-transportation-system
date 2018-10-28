<?php
session_start();
	require_once('connectdb.php');
    if(isset($_GET['PassengerID']) & isset($_GET['addmoney'])){
        $PassengerID=$_GET['PassengerID'];
        $addmoney=$_GET['addmoney'];
        $getbalance="select * from passenger where PassengerID='$PassengerID'";
        $gbresult=$mysqli->query($getbalance);
        $row=$gbresult->fetch_array();
        $PassengerBalance=$row['PassengerBalance'];
        $PassengerBalance=$PassengerBalance+$addmoney;
        $update="update passenger set PassengerBalance='$PassengerBalance' where PassengerID='$PassengerID'";
        $updateresult=$mysqli->query($update);

        header("Location:memberpassengervendingmachine.php?PassengerID=$PassengerID&feedback=2");
    }
    else{
        header("Location:memberpassengervendingmachine.php");
    }
    ?>