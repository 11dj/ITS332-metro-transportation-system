<?php
	require_once('connectdb.php');
	session_start();
	if(isset($_SESSION['guest_CurrentTripNO']) & isset($_GET['ArrivalTime']) & isset($_GET['timealter'])){ 
		$TripNO=$_SESSION['guest_CurrentTripNO'];
		$RouteID=$_SESSION['guest_RouteID'];
		$StationTypeID=$_SESSION['guest_StationTypeID'];
		$OStationID=$_SESSION['guest_OStationID'];
		$DStationID=$_SESSION['guest_DStationID'];
		$Cost=$_SESSION['guest_Cost'];

		$timealter=$_GET['timealter'];
		$ArrivalTime=$_GET['ArrivalTime'];
		$ArrivalTimealtered=date('Y-m-d H:i:s', strtotime($ArrivalTime)+$timealter);
		$update="update triprecordunregistereduser set ArrivalTime='$ArrivalTimealtered' where TripNo='$TripNO'";
		$updresult=$mysqli->query($update);
	}
	else{
		header("Location:guestcheckout.php");
	}
?>
Thank you for using our service.<br>
<a href="guestpassengermainmenu.php">Guest Passenger Mainmenu</a>
<?php
	unset($_SESSION['guest_CurrentTripNO']);
?>
