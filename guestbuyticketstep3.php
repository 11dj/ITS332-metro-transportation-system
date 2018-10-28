<?php
	require_once('connectdb.php');
	session_start();
	if(isset($_GET['RouteID'])){
		$RouteID=$_GET['RouteID'];
		
		$Step=$_GET['Step'];
		$Cost=0;
		$Costarray=array();
		//Get OStationID
		$getostationid="select * from route where RouteID='$RouteID' and ScheduleID='1' and Step='$Step' ";
		$resultgetostationid=$mysqli->query($getostationid);
		$rowgetostationid=$resultgetostationid->fetch_array();
		$OStationID=$rowgetostationid['OStationID'];
        $getstationtype="select * from station where StationID='$OStationID' ";
        $resgetstationtype=$mysqli->query($getstationtype);
        $rowgetstationtype=$resgetstationtype->fetch_array();

        $StationTypeID=$rowgetstationtype['StationTypeID'];


	}
	else{
		header("Location:guestbuyticketstep1.php");
	}
?>
Select destination station<br>
<form action="processguestbuyticket.php">
<input type="hidden" name="RouteID" value="<?=$RouteID?>">
<input type="hidden" name="StationTypeID" value="<?=$StationTypeID?>">
<input type="hidden" name="Step" value="<?=$Step?>">
<input type="hidden" name="OStationID" value="<?=$OStationID?>">
<select name="DStationIDandStep">
<?php
$x=0;
$getdstationid="select * from route where RouteID='$RouteID' and ScheduleID='1' and Step>='$Step' ";
$resultgetdstationid=$mysqli->query($getdstationid);
while($row1=$resultgetdstationid->fetch_array()){ ;?>
    <option value="<?=$row1['DStationID']?>,<?=$x?>"><?=$row1['DStationID']?> : 
    <?php 

    $DStationID=$row1['DStationID'];
    	$getstationname="select * from station where StationID='$DStationID'  ";
    	$resultgetstationname=$mysqli->query($getstationname);
    	$row2=$resultgetstationname->fetch_array();
    	$getinitialcost="select * from initialcost where InitialCostID='$StationTypeID' ";
    	$resultgetinitialcost=$mysqli->query($getinitialcost);
    	$rowgetinitialcost=$resultgetinitialcost->fetch_array();
    	$Cost=$rowgetinitialcost['InitialCostValue'];
    	for($i=$Step;$i<=$row1['Step'];$i++){
    		$getcostbystep="select * from route where Step='$i' and RouteID='$RouteID' and ScheduleID='1'";
    		$resultgetcostbystep=$mysqli->query($getcostbystep);
    		$rowgetcostbystep=$resultgetcostbystep->fetch_array();
    		$Cost=$Cost+$rowgetcostbystep['Cost'];
    		// echo $Cost;
    		
    	}
    	array_push($Costarray, $Cost);
    	$x++

    ?>
    <?=$row2['StationNameEN']?>, Cost : <?=$Cost?></option>
    <?php } ?>
</select>
<br>

<input type="submit" value="Buy Ticket">
<?php
	$_SESSION['Costarray']=$Costarray;
	// print_r($_SESSION['Costarray']);
?>
