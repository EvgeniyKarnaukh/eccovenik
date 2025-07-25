<?php
	require_once "../lib/start.php";
	require_once "top.php";
	
	if (isAdmin()) {
		$counts = getAllCounts();
		require_once "index_data.php";
	} 
	else require_once "auth.php";
	require_once "footer.php";
?>