<?php
	require_once "../lib/start.php";
	require_once "top.php";
	
	if (isAdmin()) {
		$prices = getPrices();
		require_once "prices_data.php";
	} 
	else require_once "auth.php";
	require_once "footer.php";
?>