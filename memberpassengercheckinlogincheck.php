<?php
	session_start();
	require_once('connectdb.php');
	if(isset($_POST['CardID']) & isset($_POST['CardAuthenPSW'])){
		$CardID=$_POST['CardID'];
		$CardAuthenPSW=$_POST['CardAuthenPSW'];
		$q = "select * from passenger where PassengerCardID='$CardID'";
		$result = $mysqli->query($q) or trigger_error($mysqli->error."[$q]");
		// print_r($result);
			if($result->num_rows==0){
			header("Location:memberpassengerlogin.php?error=1");
			}	
		while($row = $result->fetch_array()){
			
			if ($row['PassengerCardID']==$CardID & $row['PassengerCardAuthen']==$CardAuthenPSW){
				
				$PassengerID=$row['PassengerID'];
				$PassengerTypeID=$row['PassengerTypeID'];
				$PassengerCitizenORPassportID=$row['PassengerCitizenORPassportID'];
				$PassengerFirstName=$row['PassengerFirstName'];
				$PassengerLastName=$row['PassengerLastName'];
				$PassengerEmail=$row['PassengerEmail'];
				$PassengerBalance=$row['PassengerBalance'];
				$PassengerRegDate=$row['PassengerRegDate'];
				//checkbirthday
				$PassengerBirthday=$row['PassengerBirthday'];
				$_SESSION['PassengerBirthday']=$PassengerBirthday;
				$_SESSION['PassengerID']=$PassengerID;
				$_SESSION['PassengerCitizenORPassportID']=$PassengerCitizenORPassportID;
				$_SESSION['PassengerFirstName']=$PassengerFirstName;
				$_SESSION['PassengerLastName']=$PassengerLastName;
				$_SESSION['PassengerEmail']=$PassengerEmail;
				$_SESSION['PassengerCardID']=$CardID;
				$_SESSION['PassengerRegDate']=$PassengerRegDate;
        		if($PassengerTypeID==3){
            	$PassengerTypeID=3;
            	$_SESSION['PassengerTypeID']=$PassengerTypeID;
       		 	}
        		else{
            		$age = date_diff(date_create($PassengerBirthday), date_create('now'))->y;
            		if($age<=12){
                	$PassengerTypeID=2;
           			}
            		else{
                	$PassengerTypeID=1;
            		}
            		$updatepassengertypeid="update passenger set PassengerTypeID='$PassengerTypeID' where PassengerID='$PassengerID' ";
            		$resultupdatepassengertypeid=$mysqli->query($updatepassengertypeid);
            		$_SESSION['PassengerTypeID']=$PassengerTypeID;
            	}

				
				$_SESSION['CardID']=$CardID;
				$_SESSION['CardID']=$CardID;
				echo "login success as ".$_SESSION['CardID'];
				header("Location:memberpassengermainmenu.php");
			}
			else{
				header("Location:memberpassengerlogin.php?error=1");
			}
			
		}
	}
	else{
		header("Location:memberpassengerlogin.php");
	}





?>