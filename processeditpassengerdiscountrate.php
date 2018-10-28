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
    if(isset($_GET['Adult']) & isset($_GET['Youth']) & isset($_GET['Disabled'])){
        $Adult=$_GET['Adult'];
        $Youth=$_GET['Youth'];
        $Disabled=$_GET['Disabled'];
        $update="update passengertype set DiscountRate='$Adult' where PassengerTypeID='1' ";
        $result=$mysqli->query($update);
        $update="update passengertype set DiscountRate='$Youth' where PassengerTypeID='2' ";
        $result=$mysqli->query($update);
        $update="update passengertype set DiscountRate='$Disabled' where PassengerTypeID='3' ";
        $result=$mysqli->query($update);
        header("Location:staffeditpassengertypediscountrate.php?feedback=1");
    }

?>