<?php

/* ************************************************************
::: Version: 1.0.0
::: Created: 18.09.2021
***************************************************************
*
*
******* :: ФУНКЦИИ :: *******
::: 1.0 ПОДКЛЮЧЕНИЕ К БД
::: 2.0 АВТОРИЗАЦИЯ
::: 3.0 ОПЕРАЦИИ С ТАБЛИЦЕЙ ЗАКАЗОВ ( lan_orders)
::: 4.0 ОПЕРАЦИИ С ТАБЛИЦЕЙ КЛИЕНТОВ( lan_users )
::: 5.0 ОПЕРАЦИИ С ТАБЛИЦЕЙ КАМПАНИЙ( lan_camps )
::: 6.0 ОТПРАВКА ПИСЕМ НА ПОЧТУ
::: 7.0 СТАТИСТИКА НА ГЛАВНОЙ СТРАНИЦЕ АДМИНПАНЕЛИ
::: 8.0 СЧЁТЧИКИ ПОСЕЩЕНИЙ ( lan_visits )
::: 9.0 ЯНДЕКС ДИРЕКТ
::: 10.0 ОБЩИЕ ФУНКЦИИ
****************************** */

/* ******************************
::: 1.0 ПОДКЛЮЧЕНИЕ К БД
****************************** */

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$mysqli->set_charset("utf8");
	
/* ******************************
::: 2.0 АВТОРИЗАЦИЯ
****************************** */

	function isAdmin($login = false, $password = false) {
		if (!$login) $login = isset($_SESSION["login"]) ? $_SESSION["login"] : false;
		if (!$password) $password = isset($_SESSION["password"]) ? $_SESSION["password"] : false;
		return mb_strtolower($login) === mb_strtolower(ADM_LOGIN) && $password === ADM_PASSWORD;
	}
	
	function login($login, $password) {
		$password = hashSecret($password);
		if (isAdmin($login, $password)) {
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			return true;
		}
		return false;
	}
	
	function logout() {
		unset($_SESSION["login"]);
		unset($_SESSION["password"]);
	}
	
/* ******************************
::: 3.0 ОПЕРАЦИИ С ТАБЛИЦЕЙ ЗАКАЗОВ ( lan_orders )
****************************** */

	/* функция дабавления в таблицу нового заказа */
	/* на входе - ассоциативный массив $data */	
	function addOrder($data) {
		return addRow("lan_orders", $data);
	}
	
	/* функция обновления записи в таблице */
	/* на входе - идентификатор записи $id */
	/* на входе - ассоциативный массив $data */	
	function setOrder($field, $value, $data) {
		return setRow("lan_orders", $field, $value, $data);
	}
	
	/* функция удаления записи в таблице */
	/* на входе - идентификатор записи $id, которую нужно удалить */	
	function deleteOrder($id) {
		return deleteRow("lan_orders", $id);
	}
	
	/* функция получения всех заказов кроме оплаченных */
	/* и аннулированных  */
	function getOrders() {
		$query = "SELECT *, `lan_orders`.`id` as `order_id` FROM `lan_orders` LEFT JOIN `lan_camps` ON `lan_camps`.`id` = `lan_orders`.`camp_id` WHERE `date_pay` IS NULL AND `date_cancel` IS NULL ORDER BY `date_order` DESC";
		$result = getTable($query);
		if (!$result) return array();
		foreach($result as $key => $row) {
			$result[$key]["price"] = ($row["price"]) ? $row["price"]."р." : "нет";
			$result[$key]["date_order"] = ($row["date_order"]) ? date(FORMAT_DATE, $row["date_order"]) : null;
			$result[$key]["date_confirm"] = ($row["date_confirm"]) ? date(FORMAT_DATE, $row["date_confirm"]) : null;
			$result[$key]["date_pay"] = ($row["date_pay"]) ? date(FORMAT_DATE, $row["date_pay"]) : null;
			$result[$key]["date_cancel"] = ($row["date_cancel"]) ? date(FORMAT_DATE, $row["date_cancel"]) : null;
		}
		return $result;
	}
	
	/* функция получения данных конкретного заказа */
	/* на входе - идентификатор заказа $id */	
	function getOrder($id) {
		if (!is_numeric($id)) exit;
		global $mysqli;
		$query = "SELECT * FROM `lan_orders` WHERE `id` = '".$mysqli->real_escape_string($id)."'";
		return getRow($query);
	}
	
	/* функция подсчёта общего количества заказов */
	function allOrders() {
		global $mysqli;
		$query = "SELECT COUNT(`id`) FROM `lan_orders` WHERE `date_pay` IS NULL AND `date_cancel` IS NULL";
		return getCell($query);		
	}
	
/* ******************************
::: 4.0 ОПЕРАЦИИ С ТАБЛИЦЕЙ КЛИЕНТОВ ( lan_users )
****************************** */	
	
	/* функция дабавления в таблицу нового клиента */
	/* на входе - ассоциативный массив $data */	
	function addUser($data) {
		return addRow("lan_users", $data);
	}
	
	/* функция обновления записи в таблице */
	/* на входе - идентификатор записи $id */
	/* на входе - ассоциативный массив $data */	
	function setUser($field, $value, $data) {
		return setRow("lan_users", $field, $value, $data);
	}	
	
	/* функция удаления записи в таблице */
	/* на входе - идентификатор записи $id, которую нужно удалить */
	function deleteUser($id) {
		return deleteRow("lan_users", $id);
	}
	
	/* функция получения всех клиентов */
	function getUsers() {
		$query = "SELECT * FROM `lan_users` ORDER BY `id` DESC";
		$result = getTable($query);
		if (!$result) return array();
		foreach($result as $key => $row) {
			$result[$key]["date_birth"] = ($row["date_birth"]) ? date(FORMAT_DATE, $row["date_birth"]) : null;
			$result[$key]["date_register"] = ($row["date_register"]) ? date(FORMAT_DATE, $row["date_register"]) : null;
			$result[$key]["ip"] = ($row["ip"]) ? long2ip($row["ip"]) : null;
		}
		return $result;
	}
	
	/* функция получения данных конкретного клиента */
	/* $key - название поля в таблице */	
	/* $value - значение поля в таблице */	
	function getUser($key, $value) {
		global $mysqli;
		$query = "SELECT * FROM `lan_users` WHERE `$key` = '".$mysqli->real_escape_string($value)."'";
		$result = getRow($query);
		if ($key == "id") {
			$result["date_register"] = date(FORMAT_DATE, $result["date_register"]);
			$result["date_birth"] = ($result["date_birth"]) ? date(FORMAT_DATE, $result["date_birth"]) : null;
			$result["ip"] = ($result["ip"]) ? long2ip($result["ip"]) : null;
		}
		return $result;
	}	
	
	/* функция подсчёта общего количества клиентов */
	function allUsers() {
		global $mysqli;
		$query = "SELECT COUNT(`id`) FROM `lan_users`";
		return getCell($query);		
	}
	
	/* функция поиска клиента в таблице */
	/* $phone - телефон пользователя */
	/* $email - эл. адрес пользователя */
	function isUser($phone, $email = false) {		
		global $mysqli;
		if ($phone) {
			$query = "SELECT * FROM `lan_users` WHERE `phone` = '".$mysqli->real_escape_string($phone)."'";
			if ($email) $query .= " OR `email` = '".$mysqli->real_escape_string($email)."'";
		}
		return getRow($query);
	}
	
	/* функция проверки: нет ли такого клиента в таблице */
	/* $phone - телефон пользователя */
	/* $email - эл. адрес пользователя */
	/* $id - идентификатор пользователя (исключение) */
	function isNotFindedUser($phone, $email = false, $id = false) {
		global $mysqli;
		$query = "SELECT COUNT(*) as count FROM `lan_users` WHERE (`phone` = '".$mysqli->real_escape_string($phone)."')";
		if (isset($email) && $email) {
			$query = substr($query, 0, -1);
			$query .= " OR `email` = '".$mysqli->real_escape_string($email)."')";
		}
		if (isset($id) && is_numeric($id)) {
			$query .= " AND `id` NOT IN ('".$id."')";
		}
		if (getCell($query) == 0) return true;
		return false;
	}
	
/* ******************************
::: 5.0 ОПЕРАЦИИ С ТАБЛИЦЕЙ РЕКЛАМНЫХ КАМПАНИЙ ( lan_camps )
****************************** */	
	
	/* функция добавления в таблицу данных рекламной */
	/* кампании? с которой пришёл человек */
	/* на входе - ассоциативный массив $data */	
	function addCamp($data) {
		return addRow("lan_camps", $data);
	}	
	
	/* функция получения ID рекламной кампании */
	/* на входе - ассоциативный массив $data */	
	function getCampID($data) {
		global $mysqli;
		$query = "SELECT * FROM `lan_camps` WHERE ";
		foreach ($data as $key => $value) {
			if ($value == null) $query .= "`$key` IS NULL AND ";
			else $query .= "`$key` = '".$mysqli->real_escape_string($value)."' AND ";
		}
		$query = substr($query, 0, -5);
		return getCell($query);
	}
	
	function getAllCol($field, $table) {
		$query = "SELECT DISTINCT `$field` FROM `$table` WHERE `$field` IS NOT NULL";
		$array = getTable($query);
		$column = array();
		foreach ($array as $key => $value) {
			$column[] = $array[$key][$field];
		}
		return array_values($column);
	}
	
/* ******************************
::: 6.0 ОТПРАВКА ПИСЕМ НА ПОЧТУ
****************************** */		
	
	/* функция отправки письма о новом заказе */
	/* $data - ассоциативный массив с данными */	
	/* $email - электронный адрес администратора */	
	/* $comment - комментарий относительно пользователя: */	
	/* - новый человек */	
	/* - уже делал(-а) заявку ранее */	
	function sendMailOrder($data, $email, $comment = false) {
		($comment)? $comment : $comment = null;
		
		$subject = "Новый заказ с лендинга";
		
		$date_order = date(FORMAT_DATE, $data["date_order"]);
		
		$msg = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
		$msg .= "Новый заказ от ".$date_order.".<br />Заказчик - ".$data["name"]." ".$comment.".<br />Телефон ".$data["phone"].".<br />---<br />Письмо сгенерировано автоматически";
		$msg .= '</body></html>';
		
		$headers = array();
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-Type: text/html; charset="UTF-8"';
		$headers[] = 'Content-Transfer-Encoding: 7bit';
		$headers[] = 'From: sales@landing-page.one';
		$headers[] = 'X-Mailer: PHP v'.phpversion();
		
		mail($email, '=?UTF-8?B?'.base64_encode($subject).'?=', $msg, implode("\r\n", $headers));
	}
	
	/* функция отправки письма о сообщении из формы обратной связи */
	/* $data - ассоциативный массив с данными */
	/* $email - электронный адрес администратора */
	/* $comment - комментарий относительно пользователя: */
	/* - новый человек */
	/* - уже делал(-а) заявку ранее */
	function sendMailMessage($data, $email, $comment = false) {
		($comment)? $comment : $comment = null; 
		
		$subject = "Сообщение с лендинга";
		
		$date = date(FORMAT_DATE, $data["date_order"]);
		
		$msg = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
		$msg .= '</body></html>';
		$msg .= "Новое сообщение от ".$date.".<br />Телефон отправителя ".$data["phone"].".<br />---<br />".$data["message"]."<br />---<br />Письмо сгенерировано автоматически";
		
		$headers = array();
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-Type: text/html; charset="UTF-8"';
		$headers[] = 'Content-Transfer-Encoding: 7bit';
		$headers[] = 'From: sales@landing-page.one';
		$headers[] = 'X-Mailer: PHP v'.phpversion();
		
		mail($email, '=?UTF-8?B?'.base64_encode($subject).'?=', $msg, implode("\r\n", $headers));
	}
	
/* ******************************
::: 7.0 СТАТИСТИКА НА ГЛАВНОЙ СТРАНИЦЕ АДМИНПАНЕЛИ
****************************** */	
	
	function getCountOrders($data_st = false) {
		return getDataForOrders($data_st);
	}
	
	function getCountConfirmOrders($data_st = false) {
		return getDataForOrders($data_st, true, "date_confirm");
	}
	
	function getCountPayOrders($data_st = false) {
		return getDataForOrders($data_st, true, "date_pay");
	}
	
	function getCountCancelOrders($data_st = false) {
		return getDataForOrders($data_st, true, "date_cancel");
	}
	
	function getSumOrders($data_st = false) {
		return getDataForOrders($data_st, false);
	}
	
	function getSumConfirmOrders($data_st = false) {
		return getDataForOrders($data_st, false, "date_confirm");
	}
	
	function getSumPayOrders($data_st = false) {
		return getDataForOrders($data_st, false, "date_pay");
	}
	
	function getSumCancelOrders($data_st = false) {
		return getDataForOrders($data_st, false, "date_cancel");
	}
	
	function getDataForOrders($data_st, $count = true, $field = false) {
		if ($count) $count = "COUNT(`id`)";
		else $count = "SUM(`price`)";
		$query = "SELECT $count FROM `lan_orders` ";
		$where = getWhereForOrders($data_st);
		if ($field) {
			$temp = "`$field` IS NOT NULL";
			if ($where) $where .= " AND $temp";
			else $where = $temp;
		}
		if ($where) $query .= " WHERE $where";
		$result = getCell($query);
		if (!$result) return 0;
		return $result;
	}
	
	function getWhereForOrders($data_st) {
		if (!count($data_st)) return "";
		global $mysqli;
		foreach ($data_st as $key => $value) $data_st["key"] = $mysqli->real_escape_string($value);
		$log = $data_st["log"];		
		$where = "";
		$ft = "";		
		if ($data_st["from"] || $data_st["to"]) {
			if ($data_st["from"]) {
				$ft = "`date_order` > '".$data_st["from"]."'";
			}
			if ($data_st["to"]) {
				$temp = "`date_order` < '".$data_st["to"]."'";
				if ($ft) $ft .= " AND $temp";
				else $ft = $temp;
			}
		}		
		$where_camps = "";
		$utms = array();		
		$utms["utm_source"] = $data_st["utm_source"];
		$utms["utm_campaign"] = $data_st["utm_campaign"];
		$utms["utm_content"] = $data_st["utm_content"];
		$utms["utm_term"] = $data_st["utm_term"];		
		foreach ($utms as $key => $value) {
			if ($value) {
				if ($where_camps) $where_camps .= " $log `$key` = '$value'";
				else $where_camps = "`$key` = '$value'";
			}
		}		
		$sc = "";		
		if ($data_st["split"] || $where_camps) {
			if ($data_st["split"]) {
				$sc = "`split` = '".$data_st["split"]."'";
			}
			if ($where_camps) {
				$temp = "`camp_id` IN (SELECT id FROM `lan_camps` WHERE $where_camps)";
				if ($sc) $sc .= " $log $temp";
				else $sc = $temp;
			}
		}		
		if ($ft) $where = "($ft)";
		if ($sc) {
			if ($where) $where .= " AND ($sc)";
			else $where = $sc;
		}		
		return $where;
	}

/* ******************************
::: 8.0 СЧЁТЧИКИ ПОСЕЩЕНИЙ ( lan_visits )
****************************** */	
	
	function getAllCounts() {
		$query = "SELECT * FROM `lan_counts`";
		return getTable($query);
	}
	
	function getCount($id) {
		$query = "SELECT `count` FROM `lan_counts` WHERE `id` = $id";
		return getCell($query);
	}
	
	function getAllOrders() {
		$query = "SELECT COUNT(*) FROM `lan_orders`";
		return getCell($query);
	}
	
	function setCount($id, $count_array) {
		return setRow("lan_counts", "id", $id, $count_array);
	}
	
	function addVisitor($data) {
		return addRow("lan_visitors", $data);
	}
	
	function countVisitors($id) {
		$query = "SELECT COUNT(*) FROM `lan_visitors`";
		$count = getCell($query);
		$count_array = array("count" => $count);
		return setRow("lan_counts", "id", $id, $count_array);
	}
	
/* ******************************
::: 9.0 яндекс директ
****************************** */	

	function sendRequest($params, $obj, $method) {
		$request = array(
			"method" => $method,
			"params" => $params
		);
		$request = json_encode($request);
		$opts = array(
			"http" => array(
				"header" => "Content-Type: application/json; charset=utf-8\r\nAuthorization: Bearer ".DIRECT_TOKEN."\r\nAccept-Language: en\r\n",
				"method" => "POST",
				"content" => $request
			)
		);
		$context = stream_context_create($opts);
		$result = json_decode(file_get_contents("https://api.direct.yandex.com/json/v5/$obj", false, $context));
		return $result;
	}
	
	function getCampsYandexDirect($from, $to) {
		$query = "SELECT * FROM `lan_camps` WHERE `utm_source` = 'YandexDirect' AND `date` > '$from' AND `date` < '$to'";
		return getTable($query);
	}
	
/* ******************************
::: 10.0 ОБЩИЕ ФУНКЦИИ
****************************** */	
	
	function getCell($query) {
		global $mysqli;
		$result_set = $mysqli->query($query);
		if (!$result_set) return false;
		$arr = $result_set->fetch_array();
		$result_set->close();
		return $arr[0];
	}
	
	function getRow($query) {
		global $mysqli;
		$result_set = $mysqli->query($query);
		if (!$result_set) return false;
		$row = $result_set->fetch_assoc();
		$result_set->close();
		return $row;
	}
	
	function getCol($query) {
		global $mysqli;
		$result_set = $mysqli->query($query);
		if (!$result_set) return false;
		$col = array_values($result_set->fetch_assoc());
		$result_set->close();
		if ($col) return $col;
		return false;
	}
	
	function getTable($query) {
		global $mysqli;
		$result_set = $mysqli->query($query);
		if (!$result_set) return false;
		$result = array();
		while ($row = $result_set->fetch_assoc()) {
			$result[] = $row;
		}
		$result_set->close();
		return $result;
	}
	
	function addRow($table, $data) {
		global $mysqli;
		$query = "INSERT INTO `$table` (";
		foreach ($data as $key => $value) $query .= "`$key`,";
		$query = substr($query, 0, -1);
		$query .= ") VALUES (";
		foreach ($data as $value) {
			if (empty($value)) $query .= "null,";
			else $query .= "'".$mysqli->real_escape_string($value)."',";
		}
		$query = substr($query, 0, -1);
		$query .= ")";
		$result_set = $mysqli->query($query);
		if (!$result_set) return false;
		return $mysqli->insert_id;
	}
	
	function setRow($table, $field, $value, $data) {
		global $mysqli;
		$query = "UPDATE `$table` SET ";
		foreach ($data as $key => $val) {
			$query .= "`$key`=";
			if (empty($val)) $query .= "NULL,";
			else $query .= "'".$mysqli->real_escape_string($val)."',";
		}
		$query = substr($query, 0, -1);
		$query .= " WHERE `$field` = '$value'";
		return $mysqli->query($query);
	}
	
	function deleteRow($table, $id) {
		if (!is_numeric($id)) exit;
		global $mysqli;
		$query = "DELETE FROM `$table` WHERE `id`='$id'";
		if ($mysqli->query($query)) return true;
	}	
	
	function xss($data) {
		if (is_array($data)) {
			$escaped = array();
			foreach ($data as $key => $value) {
				$escaped[$key] = xss($value);
			}
			return $escaped;
		}
		return trim(htmlspecialchars($data));
	}
	
	function redirect($link) {
		header("Location: $link");
		exit;
	}
	
	function hashSecret($str) {
		return md5($str.SECRET);
	}
	
	function sendSMS($phone, $name = false, $domain) {
		if (!$name) {
			$text = urlencode("У Вас новое сообщение: $phone\r\n$domain");	
		}
		else {
			$text = urlencode("У Вас новый заказ: $phone\r\n$name\r\n$domain");			
		}
		$result = file_get_contents("https://".SMS_EMAIL.":".SMS_API_KEY."@gate.smsaero.ru/v2/sms/send?number=".SMS_PHONE."&text=".$text."&sign=SMS+Aero");
		return strpos($result, "accepted") !== false;
	}
	
	/* функция получения цен */
	function getPrices() {
		$query = "SELECT * FROM `lan_prices`";
		$result = getTable($query);
		if (!$result) return array();
		return $result;
	}
	/* функция обновления записи в таблице lan_prices */
	/* на входе - идентификатор записи $id */
	/* на входе - ассоциативный массив $data */	
	function setPrices($field, $value, $data) {
		return setRow("lan_prices", $field, $value, $data);
	}

?>