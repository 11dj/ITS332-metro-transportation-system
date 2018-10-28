<?php
	session_start();
	unset($_SESSION['member_CurrentTripNO']);
	header("Location:memberpassengermainmenu.php");
?>