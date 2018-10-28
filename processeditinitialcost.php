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
    if(isset($_GET['BTS']) & isset($_GET['MRT'])){
        $BTS=$_GET['BTS'];
        $MRT=$_GET['MRT'];
        $update="update initialcost set InitialCostValue='$BTS' where InitialCostID='1' ";
        $result=$mysqli->query($update);
        $update="update initialcost set InitialCostValue='$MRT' where InitialCostID='2' ";
        $result=$mysqli->query($update);
        header("Location:staffeditinitialcost.php?feedback=1");
    }

?>