<?php
	require_once "../lib/start.php";
	require_once "top.php";
	
	if (isAdmin()) {
		$users = getUsers();	
		if (!isset($readonly)) $readonly = true;
		if (isset($request["func"]) && $request["func"] == "edit") {
			$fd = getUser("id", $request["id"]);
		}
		else $fd = $request;		
		require_once "files_data.php";
	} 
	else require_once "auth.php";	
	require_once "footer.php";
?>