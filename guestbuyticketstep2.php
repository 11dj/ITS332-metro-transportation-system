<?php
	require_once('connectdb.php');
	session_start();
	if(isset($_GET['routeid'])){
		$RouteID=$_GET['routeid'];
	}
	else{
		header("Location:guestbuyticketstep1.php");
	}
?>
Select origin station<br>
<form action="guestbuyticketstep3.php">
<input type="hidden" name="RouteID" value="<?=$RouteID?>">

<select name="Step">
<?php
$getostationid="select * from route where RouteID='$RouteID' and ScheduleID='1' ";
$resultgetostationid=$mysqli->query($getostationid);
while($row1=$resultgetostationid->fetch_array()){ ?>
    <option value="<?=$row1['Step']?>"><?=$row1['OStationID']?> : 
    <?php 
    $OStationID=$row1['OStationID'];
    	$getstationname="select * from station where StationID='$OStationID' ";
    	$resultgetstationname=$mysqli->query($getstationname);
    	$row2=$resultgetstationname->fetch_array();
    ?>
    <?=$row2['StationNameEN']?></option>
    <?php } ?>
</select>
<br>
<input type="submit" value="Next">