<?php
	require_once "../lib/start.php";
	require_once "top.php";
	
	if (isAdmin()) {		
		$orders = getOrders();	
		if (!isset($readonly)) $readonly = true;		
		if (isset($request["func"]) && $request["func"] == "edit") {
			$fd = getOrder($request["id"]);
		}
		else $fd = $request;		
		require_once "orders_data.php";
	} 
	else require_once "auth.php";	
	require_once "footer.php";
?>