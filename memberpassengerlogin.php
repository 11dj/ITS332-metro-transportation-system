Simulate smartcard contact<br>
<form action="memberpassengercheckinlogincheck.php" method="post">
	CardID:<input type="text" name="CardID"><br>
	CardAuthenPSW:<input type="text" name="CardAuthenPSW"><br>
	<input type="submit" value="Contact Card">
</form>
<?php
if(isset($_GET['error'])){
	if($_GET['error']==1){
		echo "Your smartcard authenicate data is invalid, please contact staff.";
	}
	if($_GET['error']==3){
		echo "You have logged out.";
	}
	if($_GET['error']==4){
		echo "Please authenticate with smartcard first.";
	}
}
?>