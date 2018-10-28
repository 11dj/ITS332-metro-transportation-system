<?php
	session_start();
	require_once('connectdb.php');
	if(isset($_SESSION['PassengerID'])){
		$PassengerTypeID=$_SESSION['PassengerTypeID'];
		$PassengerID=$_SESSION['PassengerID'];
	}
	else{
		header("Location:memberpassengerlogin.php?error=4");
	}
?>
Welcome! <?=$_SESSION['PassengerFirstName']?> <?=$_SESSION['PassengerLastName']?>.<br>
PassengerID : <?=$_SESSION['PassengerID']?><br>
PassengerCardID : <?=$_SESSION['PassengerCardID']?><br>
PassengerTypeID : (<?=$_SESSION['PassengerTypeID']?>)
<?php
	$getpassengertype="select * from passengertype where PassengerTypeID='$PassengerTypeID' ";
	$result=$mysqli->query($getpassengertype);
	$row=$result->fetch_array();
?>
<?=$row['PassengerTypeName']?>
<br>
Discount : <?=(1-$row['DiscountRate'])*100?>%<br>
<?php
	$getbl="select * from passenger where PassengerID='$PassengerID' ";
	$resultgetbl=$mysqli->query($getbl);
	$rowgetbl=$resultgetbl->fetch_array();
?>
PassengerBalance : <?=$rowgetbl['PassengerBalance']?><br><br>

PassengerEmail : <?=$_SESSION['PassengerEmail']?><br>
PassengerCitizenORPassportID : <?=$_SESSION['PassengerCitizenORPassportID']?><br>
PassengerBirthday : <?=$_SESSION['PassengerBirthday']?><br>
PassengerRegisterDate : <?=$_SESSION['PassengerRegDate']?><br>

<?php
//<a href="memberpassengercheckin.php">Go to check-in gate</a><br>
	if(isset($_GET['error'])){
		if($_GET['error']==1){
			echo "Error, not enough money. Ticket not bought";
		}
	}

?>
<br>
<a href="memberpassengervendingmachine.php">Go to vending machine</a><br>
<a href="memberpassengerlogout.php">Logout</a><br>

<?php
if(isset($_SESSION['member_CurrentTripNO'])){ 
	$TripNO=$_SESSION['member_CurrentTripNO'];
	$RouteID=$_SESSION['member_RouteID'];
	$StationTypeID=$_SESSION['member_StationTypeID'];
	$OStationID=$_SESSION['member_OStationID'];
	$DStationID=$_SESSION['member_DStationID'];
	$Cost=$_SESSION['member_Cost'];
	?>
<br>Ticket Found!<br><br>

<?php
	$q="select * from routenaming where RouteID='$RouteID'";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
?>
RouteID : <?=$_SESSION['member_RouteID']?> (<?=$row['RouteName']?>)<br>
<?php
	$q="select * from stationtype where StationTypeID='$StationTypeID'";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
?>
StationTypeID : <?=$_SESSION['member_StationTypeID']?> (<?=$row['StationTypeName']?>)<br>
<?php
	$q="select * from station where StationID='$OStationID'";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
?>
OStationID : <?=$_SESSION['member_OStationID']?> (<?=$row['StationNameEN']?>) <br>
<?php
	$q="select * from station where StationID='$DStationID'";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
?>
DStationID : <?=$_SESSION['member_DStationID']?> (<?=$row['StationNameEN']?>) <br>
Cost : <?=$_SESSION['member_Cost']?><br>

<br>
<a href="membercheckin.php">Check-in Gate</a><br>
<a href="memberdiscardticket.php">Discard Ticket</a><br>
<?php } ?>