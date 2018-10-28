<?php
	require_once('connectdb.php');
	session_start();
	if(isset($_SESSION['member_CurrentTripNO'])){ 
		$TripNO=$_SESSION['member_CurrentTripNO'];
		$RouteID=$_SESSION['member_RouteID'];
		$StationTypeID=$_SESSION['member_StationTypeID'];
		$OStationID=$_SESSION['member_OStationID'];
		$DStationID=$_SESSION['member_DStationID'];
		$Cost=$_SESSION['member_Cost'];
	}
	else{
		header("Location:memberpassengermainmenu.php");
	}
	$getcheckintimes="select * from route where RouteID='$RouteID' and OStationID='$OStationID' ";
	$resultcheckintimes=$mysqli->query($getcheckintimes);
	
	$getostationname="select * from station where StationID='$OStationID' ";
	$resultgetostationname=$mysqli->query($getostationname);
	$rowgetostationname=$resultgetostationname->fetch_array();
?>
You are getting on <br>
Origin station : <?=$rowgetostationname['StationNameEN']?> (<?=$OStationID?>)<br>
Here are times when train arrives this station 
<form action="membercheckout.php" method="get">
<table border="1">
<?php
	date_default_timezone_set("Asia/Bangkok");
	$i=1;
	while($rowcheckintimes=$resultcheckintimes->fetch_array()){
	?>	
	<tr>
		<td><input type="radio"
		<?php
			if($i==1){
				echo " checked ";
			}
		?>
		 name="SchIDANDDepartTime" value="<?=$rowcheckintimes['ScheduleID']?>,<?=$rowcheckintimes['DepartTime']?>"></td>
		<td><?=$rowcheckintimes['DepartTime']?></td>
	</tr>
<?php
	$i++; }
?>
</table>
To make simulation realistic, you should select time that is nearest to current time.<br>
You may alter time in second such as +15, -27.<br>
Because in reality, train don't arrive exactly on schedule.<br>
Or leave the textbox as 0 to have no time alteration.<br>
<input type="text" name="timealter" value="0">
<input type="submit" value="Check In">
</form>

