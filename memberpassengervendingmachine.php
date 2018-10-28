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
<a href="memberbuyticketstep1.php">Buy Ticket</a><br>
<a href="memberviewtriphistoryrecord.php">View Trip History Record</a><br>
<form action="memberpassengeraddmoneyprocess.php">
<input type="hidden" name="PassengerID" value="<?=$PassengerID?>" >
	Add money amount : <input type="text" name="addmoney"><br>
	<input type="submit" value="Add money">
</form><br>
<?php
	if(isset($_GET['feedback'])){
		if($_GET['feedback']==2){
			echo "Money added.";
		}
	}

?>