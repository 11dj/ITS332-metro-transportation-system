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
    if(isset($_GET['PassengerID']) & isset($_GET['addmoney'])){
        $PassengerID=$_GET['PassengerID'];
        $addmoney=$_GET['addmoney'];
        $getbalance="select * from passenger where PassengerID='$PassengerID'";
        $gbresult=$mysqli->query($getbalance);
        $row=$gbresult->fetch_array();
        $PassengerBalance=$row['PassengerBalance'];
        $PassengerBalance=$PassengerBalance+$addmoney;
        $update="update passenger set PassengerBalance='$PassengerBalance' where PassengerID='$PassengerID'";
        $updateresult=$mysqli->query($update);

        header("Location:staffeditmemberpassenger.php?PassengerID=$PassengerID&feedback=2");
    }
    else{
        header("Location:staffeditmemberpassenger.php");
    }
    ?>