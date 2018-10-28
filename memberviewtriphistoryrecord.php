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
Trip History Record for PassengerID : <?=$PassengerID?>, <?=$_SESSION['PassengerFirstName']?> <?=$_SESSION['PassengerLastName']?><br>
<table border=1>
    <tr>
        <td>RouteID</td>
        <td>StationTypeID</td>
        <td>OStationID</td>
        <td>DStationID</td>
        <td>Cost</td>
        <td>DepartTime</td>
        <td>ArriveTime</td>
    </tr>
    <?php
    $q="select * from triprecordregistereduser where PassengerID='$PassengerID' order by TripNo desc";
    $result=$mysqli->query($q);
    while($row=$result->fetch_array()){
    $RouteID=$row['RouteID'];
    $StationTypeID=$row['StationTypeID'];
    $OStationID=$row['OStationID'];
    $DStationID=$row['DStationID'];?>
    <tr>
        <td>(<?=$row['RouteID']?>)
        <?php
            $q="select * from routenaming where RouteID='$RouteID'";
            $r=$mysqli->query($q);
            $s=$r->fetch_array();
        ?>
        <?=$s['RouteName']?>
        </td>
        <td>(<?=$row['StationTypeID']?>)
        <?php
            $q="select * from stationtype where StationTypeID='$StationTypeID'";
            $r=$mysqli->query($q);
            $s=$r->fetch_array();
        ?>
        <?=$s['StationTypeName']?>
        </td>
        <td>(<?=$row['OStationID']?>)<?php
            $q="select * from station where StationID='$OStationID'";
            $r=$mysqli->query($q);
            $s=$r->fetch_array();
        ?>
        <?=$s['StationNameEN']?>
        </td>
        <td>(<?=$row['DStationID']?>) 
            <?php
            $q="select * from station where StationID='$DStationID'";
            $r=$mysqli->query($q);
            $s=$r->fetch_array();
            ?>
        <?=$s['StationNameEN']?>
        </td>
        <td><?=$row['Cost']?></td>
        <td><?=$row['DepartTime']?></td>
        <td><?=$row['ArriveTime']?></td>
    </tr>
<?php } ?>
</table>



