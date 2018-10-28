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
    if(isset($_GET['stationtype']) & isset($_GET['stationnameen']) & isset($_GET['interchangablewithstationtypeid'])){
        $stationtype=$_GET['stationtype'];
        $stationnameen=$_GET['stationnameen'];
        $interchangablewithstationtypeid=$_GET['interchangablewithstationtypeid'];
        if($interchangablewithstationtypeid=="NO"){
            $q="insert into station (StationTypeID, StationNameEN) VALUES('$stationtype', '$stationnameen')";
            $result = $mysqli->query($q);
            if (!$result){
                die('Error: '.$q." ". $mysql->error);
            }
            header("Location:staffvieweditdeletestationbtsormrt.php");
        }
        else{
            $InterchangeWithStationID=$_GET['InterchangeWithStationID'];
            $q="insert into station (StationTypeID, StationNameEN, InterchangeWithStationTypeID, InterchangeWithStationID) VALUES('$stationtype', '$stationnameen', '$interchangablewithstationtypeid', '$InterchangeWithStationID')";
            $result = $mysqli->query($q);
            if (!$result){
                die('Error: '.$q." ". $mysqli->error);
            }
            else{
                header("Location:staffvieweditdeletestationbtsormrt.php");
            }
            
        }
    }
    else{
        header("Location:staffaddstation.php");
    }



?>