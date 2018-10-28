<?php
	require_once('connectdb.php');
	session_start();
	if(!isset($_SESSION['timeout']) | !isset($_SESSION['staffusername']))
	{
    header('Location: staffloginform.php?error=4');
    exit;
	}
	else
	{
    if($_SESSION['timeout'] + 30 * 60 < time()){
        header('Location: staffloginform.php?error=2');
    }
    else{
        $_SESSION['timeout']=time();
    }
    $staffusername=$_SESSION['staffusername'];
}
?>
<?php
    if(isset($_GET['stationtype']) & isset($_GET['totalstep']) & isset($_GET['totalstartingtime']) & isset($_GET['routename'])){
        $stationtype=$_GET['stationtype'];
        $totalstep=$_GET['totalstep'];
        $totalstartingtime=$_GET['totalstartingtime'];
        $routename=$_GET['routename'];
    }
    else{
        header("Location:staffaddrouteandschedule.php");
    }
?>
<?php
//Get latest routeID
$getlatestrouteid="select max(RouteID) from route";
$resultlatestrouteid = $mysqli->query($getlatestrouteid);
$rowlatestrouteid = $resultlatestrouteid->fetch_array();
// echo $rowlatestrouteid['max(RouteID)'];
// print_r($rowlatestrouteid);
if($rowlatestrouteid['max(RouteID)']==NULL){
    $RouteID=1;
}
else{
    $RouteID=$rowlatestrouteid['max(RouteID)']+1;
}
// echo $RouteID;

    //ScheduleID loop
    for($ScheduleID=1; $ScheduleID<=$totalstartingtime; $ScheduleID++){
        $departtimeoriginroute=date('H:i:s', strtotime($_GET['startingtime'.$ScheduleID]));
        $DepartTime=$departtimeoriginroute;
        for($Step=1; $Step<=$totalstep-1; $Step++){
            $OStationID=$_GET['stationstep'.$Step];
            $stepfordest=$Step+1;
            $DStationID=$_GET['stationstep'.$stepfordest];
            $Cost=$_GET['cost'.$Step];
            if($Step>1){
                // $DepartTime=$ArrivalTime;
                $DepartTime=date('H:i:s', strtotime($ArrivalTime)+$_GET['timepauseatstation'.$Step]);
            }
            $ArrivalTime=date('H:i:s', strtotime($DepartTime)+$_GET['timetonextdest'.$Step]);
            // $ArrivalTime=$DepartTime+$_GET['timetonextdest'.$Step]+$_GET['timepauseatstation'.$Step];
            $insert="insert into route (RouteID, ScheduleID, Step, OStationID, DStationID, Cost, DepartTime, ArrivalTime) values('$RouteID', '$ScheduleID', '$Step', '$OStationID', '$DStationID', '$Cost', '$DepartTime', '$ArrivalTime')";
            $result = $mysqli->query($insert);
            if (!$result){
                die('Error: '.$insert." ". $mysqli->error);
            }
            else{
                header("Location:staffviewdeleterouteandschedule.php");
            }
        }
    }
$insertrn="insert into routenaming (RouteID, RouteName) values('$RouteID', '$routename')";
            $result = $mysqli->query($insertrn);
            if (!$result){
                die('Error: '.$insertrn." ". $mysqli->error);
            } 
            else{
                header("Location:staffviewdeleterouteandschedule.php");
            }
            
?>