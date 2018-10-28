<?php
	require_once('connectdb.php');
	if(isset($_POST['username']) & isset($_POST['password'])){
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$q = "select StaffUsername,StaffPSW from Staff where StaffUserName='$username'";
		$result = $mysqli->query($q) or trigger_error($mysqli->error."[$q]");
		// print_r($result);
			if($result->num_rows==0){
			header("Location:staffloginform.php?error=1");
			}	
		while($row = $result->fetch_array()){
			
			if ($row['StaffUsername']==$username & $row['StaffPSW']==$password){
				session_start();
				$_SESSION['timeout']=time()+1800;
				$_SESSION['staffusername']=$username;
				echo "login success as ".$_SESSION['staffusername'];
				header("Location:staffmainmenu.php");
			}
			else{
				header("Location:staffloginform.php?error=1");
			}
			
		}
	}
	else{
		header("Location:staffloginform.php");
	}





?>