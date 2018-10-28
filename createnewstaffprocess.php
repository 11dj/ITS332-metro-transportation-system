<?php
	require_once('connectdb.php');
	if(isset($_GET['StaffFullName']) & isset($_GET['StaffUsername']) & isset($_GET['StaffPSW']) & isset($_GET['StaffPSWconfirm']) )
	{
		if($_GET['StaffPSW'] != $_GET['StaffPSWconfirm']){
			header("Location:createnewstaff.php?error=1");
		}
		else{
			$StaffFullName=$_GET['StaffFullName'];
			$StaffUsername=$_GET['StaffUsername'];
			$StaffPSW=md5($_GET['StaffPSW']);
			$insert="insert into staff (StaffFullName, StaffUsername, StaffPSW) values('$StaffFullName','$StaffUsername','$StaffPSW')";
			$result = $mysqli->query($insert);
            if (!$result){
                die('Error: '.$insert." ". $mysqli->error);
            }
            else{
            	header("Location:staffloginform.php?error=5");
            }
	}

		}
		
	else{
		header("Location:createnewstaff.php");
	}
?>