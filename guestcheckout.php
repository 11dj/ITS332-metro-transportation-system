<?php
	require_once('connectdb.php');
	session_start();
	if(isset($_SESSION['guest_CurrentTripNO']) & isset($_GET['SchIDANDDepartTime']) & isset($_GET['timealter'])){ 
		$TripNO=$_SESSION['guest_CurrentTripNO'];
		$RouteID=$_SESSION['guest_RouteID'];
		$StationTypeID=$_SESSION['guest_StationTypeID'];
		$OStationID=$_SESSION['guest_OStationID'];
		$DStationID=$_SESSION['guest_DStationID'];
		$Cost=$_SESSION['guest_Cost'];

		$SchIDANDDepartTime=$_GET['SchIDANDDepartTime'];
		$SchIDANDDepartTimeExploded=explode(",",$SchIDANDDepartTime);
		$ScheduleID=$SchIDANDDepartTimeExploded[0];
		$DepartTime=$SchIDANDDepartTimeExploded[1];


		$timealter=$_GET['timealter'];
		$DepartTimealtered=date('Y-m-d H:i:s', strtotime($DepartTime)+$timealter);
		//echo $DepartTimealtered;
		$update="update triprecordunregistereduser set DepartTime='$DepartTimealtered' where TripNo='$TripNO'";
		$updresult=$mysqli->query($update);
	}
	else{
		header("Location:guestcheckin.php");
	}
	$getcheckintimes="select * from route where RouteID='$RouteID' and DStationID='$DStationID' and ScheduleID='$ScheduleID' ";
	// echo $getcheckintimes;
	$resultcheckintimes=$mysqli->query($getcheckintimes);
	$rowcheckintimes=$resultcheckintimes->fetch_array();
	$getostationname="select * from station where StationID='$DStationID' ";
	$resultgetostationname=$mysqli->query($getostationname);
	$rowgetostationname=$resultgetostationname->fetch_array();
	// print_r($rowcheckintimes['ArrivalTime']);
?>
You will checkout at station (<?=$DStationID?>) <?=$rowgetostationname['StationNameEN']?><br>
Ideal time for checkout is <?=$rowcheckintimes['ArrivalTime']?><br>
<form action="guestcheckoutcompleted.php" method="get">
<input type="hidden" name="ArrivalTime" value="<?=$rowcheckintimes['ArrivalTime']?>">
You may alter time in second such as +15, -27.<br>
Because in reality, train don't arrive exactly on schedule.<br>
Or leave the textbox as 0 to have no time alteration.<br>
<input type="text" name="timealter" value="0">
<input type="submit" value="Check Out">
</form>