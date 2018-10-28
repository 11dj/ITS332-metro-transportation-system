<?php
	require_once('connectdb.php');
	session_start();
	if(isset($_SESSION['member_CurrentTripNO']) & isset($_GET['ArrivalTime']) & isset($_GET['timealter'])){ 
		$TripNO=$_SESSION['member_CurrentTripNO'];
		$RouteID=$_SESSION['member_RouteID'];
		$StationTypeID=$_SESSION['member_StationTypeID'];
		$OStationID=$_SESSION['member_OStationID'];
		$DStationID=$_SESSION['member_DStationID'];
		$Cost=$_SESSION['member_Cost'];

		$timealter=$_GET['timealter'];
		$ArrivalTime=$_GET['ArrivalTime'];
		$ArrivalTimealtered=date('Y-m-d H:i:s', strtotime($ArrivalTime)+$timealter);
		$update="update triprecordregistereduser set ArriveTime='$ArrivalTimealtered' where TripNo='$TripNO'";
		$updresult=$mysqli->query($update);
	}
	else{
		header("Location:membercheckout.php");
	}
?>
Thank you for using our service.<br>
<a href="memberpassengermainmenu.php">Member Passenger Mainmenu</a>
<?php
	unset($_SESSION['member_CurrentTripNO']);
?>
