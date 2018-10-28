<?php
	require_once('connectdb.php');
	session_start();
	if(isset($_GET['RouteID']) & isset($_SESSION['PassengerID']) ){
			//get balance
		$PassengerID=$_SESSION['PassengerID'];
	$getbl="select * from passenger where PassengerID='$PassengerID' ";
    $resultgetbl=$mysqli->query($getbl);
    $rowgetbl=$resultgetbl->fetch_array();
    	$PassengerBalance=$rowgetbl['PassengerBalance'];
		

		$RouteID=$_GET['RouteID'];
		$StationTypeID=$_GET['StationTypeID'];
		
            $DStationIDandStep = $_GET['DStationIDandStep'];
            $DStationIDandStep_explode = explode(',', $DStationIDandStep);
            $DStationID=$DStationIDandStep_explode[0];
			$Step=$DStationIDandStep_explode[1];

		$OStationID=$_GET['OStationID'];
	
		
		$Cost=$_SESSION['Costarray'][$Step];

		if($PassengerBalance-$Cost<0){
			header("Location:memberpassengermainmenu.php?error=1");
		}
		else{
			$newpassengerbalance=$PassengerBalance-$Cost;
		$deductmoney="update passenger set PassengerBalance='$newpassengerbalance' where PassengerID='$PassengerID'";
		//echo $deductmoney;
		$re=$mysqli->query($deductmoney);
		
		$q="call memberbuyticket($RouteID, $StationTypeID, $OStationID, $DStationID, $Cost, $PassengerID)";
	
		$result=$mysqli->query($q);
		$row=$result->fetch_array();
		$memberCurrentTripNO=$row['currentTripNO'];
		$_SESSION['member_CurrentTripNO']=$memberCurrentTripNO;
		$_SESSION['member_RouteID']=$RouteID;
		$_SESSION['member_StationTypeID']=$StationTypeID;
		$_SESSION['member_OStationID']=$OStationID;
		$_SESSION['member_DStationID']=$DStationID;
		$_SESSION['member_Cost']=$Cost;
		
		header("Location:memberpassengermainmenu.php");
		}

		
	}
	else{
		header("Location:memberbuyticketstep1.php");
	}
?>