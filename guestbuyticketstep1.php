<?php
	require_once('connectdb.php');
	session_start();
?>
Select route you want to buy ticket<br>
<form action="guestbuyticketstep2.php" method="get">
<select name="routeid">
<?php
$getrouteid="select rn.RouteID, rn.RouteName from routenaming as rn";
$resultgetrouteid=$mysqli->query($getrouteid);
while($rowrouteid=$resultgetrouteid->fetch_array()){ ?>
    <option value="<?=$rowrouteid['RouteID']?>"><?=$rowrouteid['RouteID']?> : <?=$rowrouteid['RouteName']?>
<?php
        $rid=$rowrouteid['RouteID'];
        $checkbtsormrt="select * from station where StationID=(Select OStationID from route where RouteID='$rid' LIMIT 0,1) ";
        $rbtsormrt=$mysqli->query($checkbtsormrt);
        $rowbtsormrt=$rbtsormrt->fetch_array();
        // print_r($rbtsormrt);
        // echo $rowbtsormrt['StationTypeID'];
        if($rowbtsormrt['StationTypeID']==1){
        	$StationTypeID=1;
            echo "(BTS)";
        }
        if($rowbtsormrt['StationTypeID']==2){
        	$StationTypeID=2;
            echo "(MRT)";
        }
    ?>
    </option>
    <?php } ?>
</select>
<br>

<input type="submit" value="Next">
<?php
    $route="select * from route r, routenaming rn where ScheduleID='1' and r.RouteID=rn.RouteID and Step=1";
    $result=$mysqli->query($route);
?>
<table border=1>
 <tr>
    <td>Route#</td>
    <td>Type</td>
    <td>RouteName</td>
    <td>Stations</td>
 </tr>
<?php
    while($rowshowroute=$result->fetch_array()){
?>
 <tr>
    <td><?=$rowshowroute['RouteID'] ?></td>
    <td>
    <?php
        $rid=$rowshowroute['RouteID'];
        $checkbtsormrt="select * from station where StationID=(Select OStationID from route where RouteID='$rid' LIMIT 0,1) ";
        $rbtsormrt=$mysqli->query($checkbtsormrt);
        $rowbtsormrt=$rbtsormrt->fetch_array();
        // print_r($rbtsormrt);
        // echo $rowbtsormrt['StationTypeID'];
        if($rowbtsormrt['StationTypeID']==1){
            // $StationTypeID=1;
            echo "BTS";
        }
        if($rowbtsormrt['StationTypeID']==2){
            // $StationTypeID=2;
            echo "MRT";
        }
    ?>    


    </td>
    <td><?=$rowshowroute['RouteName'] ?></td>
    <td>
        <?php
            $rid=$rowshowroute['RouteID'];
            
            $getmaxstep="select max(Step) from route where RouteID='$rid' and ScheduleID='1' ";
            $resultmaxstep=$mysqli->query($getmaxstep);
            $rowmaxstep=$resultmaxstep->fetch_array();
            $maxstep=$rowmaxstep['max(Step)'];
            $stationlist="select * from route r, station s where RouteID='$rid' and ScheduleID='1' and r.OStationID=s.StationID";
            $resultstationlist=$mysqli->query($stationlist);
            while($rowstationlist=$resultstationlist->fetch_array()){
                echo $rowstationlist['StationNameEN']." -> ";
                if($maxstep==$rowstationlist['Step']){
                    $getfinalstation="select * from route as r, station as s where r.Step='$maxstep' and RouteID='$rid' and ScheduleID='1' and r.DStationID=s.StationID";
                    $resultfinalstation=$mysqli->query($getfinalstation);
                    $rowfinalstation=$resultfinalstation->fetch_array();
                    echo $rowfinalstation['StationNameEN'];                }
            }

        ?>
    </td>
 </tr>
 <?php } ?>
</table>