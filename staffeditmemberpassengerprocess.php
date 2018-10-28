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
    if(isset($_GET['PassengerID'])){
        $PassengerID=$_GET['PassengerID'];
    }
    else{
        header("staffeditmemberpassenger.php");
    }
    $q="select * from passenger where PassengerID='$PassengerID'";
    $result=$mysqli->query($q);
    $row=$result->fetch_array();
    $PassengerBirthday=$row['PassengerBirthday'];
    if($row['PassengerID']==NULL){
        header("Location:staffeditmemberpassenger.php?error=1");
    }
?>
<?php
    if(isset($_GET['isdisable']) & isset($_GET['PassengerFirstName']) & isset($_GET['PassengerLastName']) & isset($_GET['PassengerEmail']) ){
        $PassengerID=$_GET['PassengerID'];
        $PassengerFirstName=$_GET['PassengerFirstName'];
        $PassengerLastName=$_GET['PassengerLastName'];
        $PassengerEmail=$_GET['PassengerEmail'];
        $isdisable=$_GET['isdisable'];
        if($isdisable=="yes"){
            $PassengerTypeID=3;
        }
        else{
            $age = date_diff(date_create($PassengerBirthday), date_create('now'))->y;
            if($age<=12){
                $PassengerTypeID=2;
            }
            else{
                $PassengerTypeID=1;
            }
        }
        $update="update passenger set PassengerFirstName='$PassengerFirstName ', PassengerLastName='$PassengerLastName', PassengerEmail='$PassengerEmail', PassengerTypeID='$PassengerTypeID' where PassengerID='$PassengerID'";
        $result=$mysqli->query($update);
        if (!$result){
                die('Error: '.$update." ". $mysqli->error);
            }
            else{
                header("Location:staffeditmemberpassenger.php?PassengerID=$PassengerID&feedback=1");
            }
    }
    else{
        header("Location:staffeditmemberpassenger.php");
    }
?>
