<?php
	require_once "../lib/start.php";
	require_once "top.php";
	if (isAdmin()) {
		$utm_source = getAllCol("utm_source", "lan_camps");
		$utm_campaign = getAllCol("utm_campaign", "lan_camps");
		$utm_content = getAllCol("utm_content", "lan_camps");
		$utm_term = getAllCol("utm_term", "lan_camps");
		$split = getAllCol("split", "lan_orders");
		
		require_once "statistics_data.php";	
	}
	else require_once "auth.php";
	require_once "footer.php";
?>