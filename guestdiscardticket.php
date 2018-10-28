<?php
	session_start();
	unset($_SESSION['guest_CurrentTripNO']);
	header("Location:guestpassengermainmenu.php");
?>