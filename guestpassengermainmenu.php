<?php
	require_once('connectdb.php');
	session_start();
?>
<a href="guestbuyticketstep1.php">Buy Ticket</a><br>
<?php
if(isset($_SESSION['guest_CurrentTripNO'])){ 
	$TripNO=$_SESSION['guest_CurrentTripNO'];
	$RouteID=$_SESSION['guest_RouteID'];
	$StationTypeID=$_SESSION['guest_StationTypeID'];
	$OStationID=$_SESSION['guest_OStationID'];
	$DStationID=$_SESSION['guest_DStationID'];
	$Cost=$_SESSION['guest_Cost'];
	?>
<br>Ticket Found!<br><br>

<!-- Trip# : <?=$_SESSION['guest_CurrentTripNO']?><br> -->
<?php
	$q="select * from routenaming where RouteID='$RouteID'";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
?>
RouteID : <?=$_SESSION['guest_RouteID']?> (<?=$row['RouteName']?>)<br>
<?php
	$q="select * from stationtype where StationTypeID='$StationTypeID'";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
?>
StationTypeID : <?=$_SESSION['guest_StationTypeID']?> (<?=$row['StationTypeName']?>)<br>
<?php
	$q="select * from station where StationID='$OStationID'";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
?>
OStationID : <?=$_SESSION['guest_OStationID']?> (<?=$row['StationNameEN']?>) <br>
<?php
	$q="select * from station where StationID='$DStationID'";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
?>
DStationID : <?=$_SESSION['guest_DStationID']?> (<?=$row['StationNameEN']?>) <br>
Cost : <?=$_SESSION['guest_Cost']?><br>

<br>
<a href="guestcheckin.php">Check-in Gate</a><br>
<a href="guestdiscardticket.php">Discard Ticket</a><br>
<?php } ?>