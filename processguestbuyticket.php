<?php
	require_once('connectdb.php');
	session_start();
	if(isset($_GET['RouteID'])){
		$RouteID=$_GET['RouteID'];
		$StationTypeID=$_GET['StationTypeID'];
		

            $DStationIDandStep = $_GET['DStationIDandStep'];
            $DStationIDandStep_explode = explode(',', $DStationIDandStep);
            $DStationID=$DStationIDandStep_explode[0];
			$Step=$DStationIDandStep_explode[1];

		$OStationID=$_GET['OStationID'];
	
		
		$Cost=$_SESSION['Costarray'][$Step];
		
		$q="call guestbuyticket($RouteID, $StationTypeID, $OStationID, $DStationID, $Cost)";
		$result=$mysqli->query($q);
		$row=$result->fetch_array();
		$guestCurrentTripNO=$row['currentTripNO'];
		$_SESSION['guest_CurrentTripNO']=$guestCurrentTripNO;
		$_SESSION['guest_RouteID']=$RouteID;
		$_SESSION['guest_StationTypeID']=$StationTypeID;
		$_SESSION['guest_OStationID']=$OStationID;
		$_SESSION['guest_DStationID']=$DStationID;
		$_SESSION['guest_Cost']=$Cost;
		header("Location:guestpassengermainmenu.php");
	}
	else{
		header("Location:guestbuyticketstep1.php");
	}
?>