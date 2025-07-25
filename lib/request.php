<?php
	$request = xss($_REQUEST);
	
	if (isset($request["answer"])) $answer = $request["answer"];
	
	if (isset($request["order"]) or isset($request["feedback"])) {
		$data = array();
		$comment = " (уже делал(-а) заявку ранее)";
		$data["date_order"] = time();	
		$data["message"] = null;		
		if (isset($request["order"])) {
			$data["phone"] = $request["phone"];
			$data["name"] = $request["name"];
			$data["price"] = $request["price"];
			$data["camp_id"] = (isset($_SESSION["camp_id"]) && $_SESSION["camp_id"])? $_SESSION["camp_id"] : null;
			
			// При изменении данных А/В тестирования, необходимо //
			// изменить $_SESSION["split"]["новое имя"] //
			$data["split"] = (isset($_SESSION["split"]) && $_SESSION["split"])? (string) $_SESSION["split"]["title"]." ".$_SESSION["split"]["subtitle"]." ".$_SESSION["split"]["subsubtitle"] : null;
			// </> //
			
			$data["message"] = "Заинтересовался Вашим предложением";
		}
		if (isset($request["feedback"])) {
			$data["phone"] = $request["phone-fb"];
			$data["message"] = $request["message"];
			$data["split"] = (isset($_SESSION["split"]) && $_SESSION["split"])? (string) $_SESSION["split"]["title"] : null;
		}
		if (addOrder($data)) {
			// Проверка: есть ли такой человек в ЦФ
			// Если нет, то заносим его в ЦФ
			if (isNotFindedUser($data["phone"])) {
				$user = array();
				$user["name"] = (isset($request["name"]))? $request["name"] : null;
				$user["phone"] = $data["phone"];
				$user["date_register"] = $data["date_order"];
				$user["ip"] = ip2long($_SERVER["REMOTE_ADDR"]);
				$user["message"] = date("d.m.Y H:i").":\r\n".$data["message"];
				addUser($user);
				$comment = " (новый человек)";
			}
			else {
				$user = getUser("phone", $data["phone"]);
				$user["message"] = $user["message"]."\r\n".date("d.m.Y H:i").":\r\n";
				if (isset($data["message"])) {
					$user["message"] .= $data["message"];
				}
				else {
					$user["message"] .= "Новая заявка";
				}
				setUser("phone", $data["phone"], $user);
			}
			if (isset($request["order"])) {
				$_SESSION["form_type"] = "order";
				sendMailOrder($data, ADM_EMAIL, $comment);
				// sendSMS($data["phone"], $data["name"], DOMAIN);
				redirect("/success");
			}
			if (isset($request["feedback"])) {
				$_SESSION["form_type"] = "feedback";
				sendMailMessage($data, ADM_EMAIL, $comment);
				// sendSMS($data["phone"], false, DOMAIN);
				redirect("/success");
			}
			if (isset($_SESSION["form_type"])) unset($_SESSION["form_type"]);
		}
		else $answer = "Произошла ошибка формы. Повторите попытку или обратитесь к администрации сайта.";
	}
	elseif (isset($request["auth"])) {
		if (login($request["login"], $request["password"])) redirect("/admin");
		else $answer = "Неверные имя пользователя и/или пароль!";
	}	
	
	if (isAdmin()) {
		
		$data_st = array();
		
		if (isset($request["logout"])) {
			logout();
			redirect("/admin");
		}
		elseif (isset($request["add"])) {
			$data = array();
			$data["name"] = $request["name"];
			$data["phone"] = $request["phone"];
			$data["price"] = (isset($request["price"])) ? $request["price"] : null;
			$data["date_order"] = time(); 
			$data["message"] = (isset($request["message"]) and $request["message"]) ? date("d.m.Y H:i").":\r\n".$request["message"] : null;
			if (isset($request["confirm"])) $data["date_confirm"] = time();
			if (isset($request["pay"])) $data["date_pay"] = time();
			if (isset($request["cancel"])) $data["date_cancel"] = time();			
			if ($data["phone"]) {				
				if (addOrder($data)) {					
					if (isNotFindedUser($data["phone"])) {
						$user = array();
						$user["name"] = $request["name"];
						$user["phone"] = $data["phone"];
						$user["date_register"] = $data["date_order"];
						$user["ip"] = ip2long($_SERVER["REMOTE_ADDR"]);
						if (isset($data["message"]) and $data["message"]) $user["message"] = date("d.m.Y H:i").":\r\n".$data["message"];
						addUser($user);
					}
					elseif (isset($data["message"]) and $data["message"]) {
						$user = getUser("phone", $data["phone"]);
						$user["message"] = $user["message"]."\r\n".date("d.m.Y H:i").":\r\n".$data["message"];
						setUser("phone", $data["phone"], $user);
					}				
					$answer = "Новый заказ добавлен";
					redirect("/admin/orders.php?answer=".urlencode($answer));
				}
				else $answer = "Ошибка. Заказ не добавлен";
			}
			else $answer = "Вы не указали номер телефона";			
		}
		elseif (isset($request["add_user"])) {
			$data = array();
			$data["name"] = (isset($request["name"])) ? $request["name"] : null;
			$data["phone"] = $request["phone"];
			$data["email"] = (isset($request["email"])) ? $request["email"] : null;
			$data["date_birth"] = (isset($request["date_birth"])) ? strtotime($request["date_birth"]) : null; 
			$data["date_register"] = time(); 
			$data["sex"] = (isset($request["sex"])) ? $request["sex"] : null; 
			$data["message"] = (isset($request["message"]) and $request["message"]) ? $request["message"] : null; 
			// Если в БД нет такого номера телефона или email
			// То добавляем нового клиента
			if (isNotFindedUser($data["phone"], $data["email"])) {
				if (addUser($data)) {
					$answer = "Добавлен новый клиент";
					redirect("/admin/files.php?answer=".urlencode($answer));
				}
				else $answer = "Ошибка. Клиент не добавлен";
			}
			else {
				$answer = "В БД уже есть клиент с таким телефоном или эл. адресом.";
				$readonly = false;
			}
		}
		elseif (isset($request["edit"])) {
			$order = getOrder($request["id"]);
			$data = array();
			$data["name"] = (isset($request["name"])) ? $request["name"] : null;
			$data["price"] = (isset($request["price"])) ? $request["price"] : null;
			$data["phone"] = $request["phone"];
			$data["message"] = (isset($request["message"]) and $request["message"]) ? $request["message"] : null;
			if (isset($request["confirm"]) xor $order["date_confirm"]) $data["date_confirm"] = isset($request["confirm"]) ? time() : null;
			if (isset($request["pay"]) xor $order["date_pay"]) $data["date_pay"] = isset($request["pay"]) ? time() : null;
			if (isset($request["cancel"]) xor $order["date_cancel"]) $data["date_cancel"] = isset($request["cancel"]) ? time() : null;			
			
			$user = getUser("phone", $data["phone"]);
			if (!isset($user)) {
				$user = array();
				$user["phone"] = $data["phone"];
				$user["name"] = $data["name"];
				$user["message"] = (isset($data["message"]) and $data["message"])? date("d.m.Y H:i").":\r\n".$data["message"] : null;
				$user["date_register"] = time();
				$user["ip"] = ip2long($_SERVER["REMOTE_ADDR"]);
				addUser($user);
			}
			else {
				$user["name"] = $data["name"];
				$user["message"] = ($data["message"] !== $order["message"])? $user["message"]."\r\n".date("d.m.Y H:i").":\r\n".$data["message"] : $user["message"];
				setUser("id", $user["id"], $user);
			}
					
			if ((isset($request["pay"]) or isset($request["cancel"])) and !$data["price"]) {
				return $answer = "Укажите цену заказа";
			}
			else {
				$user = getUser("phone", $data["phone"]);
				if (isset($request["pay"]) and $user) {
					$user["sum_paid"] = $user["sum_paid"] + $data["price"];
					setUser("id", $user["id"], $user);
				}					
			}
			if (setOrder("id", $request["id"], $data)) {
				$answer = "Заказ успешно отредактирован";
				redirect("/admin/orders.php?answer=".urlencode($answer));
			}
			else $answer = "Ошибка при редактировании заказа";
			
		}
		elseif (isset($request["edit_user"])) {
			$data = array();
			$data["name"] = (isset($request["name"])) ? $request["name"] : null;
			$data["phone"] = $request["phone"];
			$data["email"] = (isset($request["email"])) ? $request["email"] : null;
			$data["sex"] = (isset($request["sex"])) ? $request["sex"] : null;
			$data["date_birth"] = (isset($request["date_birth"])) ? strtotime($request["date_birth"]) : null;
			$data["message"] = (isset($request["message"]) and $request["message"]) ? $request["message"] : null;
			// Если в БД нет такого номера телефона или email
			// То добавляем нового клиента
			if (isNotFindedUser($data["phone"], $data["email"], $request["id"])) {	
				if (setUser("id", $request["id"], $data)) {
					$answer = "Карточка клиента успешно отредактирована";
					redirect("/admin/files.php?answer=".urlencode($answer));
				}
				else $answer = "Ошибка при редактировании карточки клиента.";
			}
			else $answer = "В БД уже есть клиент с таким телефоном или эл. адресом.";
		}
		elseif (isset($request["func"]) && $request["func"] == "delete") {
			if (deleteOrder($request["id"])) {
				$answer = "Заказ №".$request["id"]." успешно удален";
				redirect("/admin/orders.php?answer=".urlencode($answer));
			}
			else $answer = "Ошибка при удалении заказа - заказ №".$request["id"]." не удалён";
		}
		elseif (isset($request["func"]) && $request["func"] == "delete_user") {
			if (deleteUser($request["id"])) {
				$answer = "Клиент (№".$request["id"].") удален";
				redirect("/admin/files.php?answer=".urlencode($answer));
			}
			else $answer = "Ошибка при удалении. Клиент (".$request["id"].") не удалён";
		}
		elseif (isset($request["statistics"])) {
			$data_st["from"] = strtotime($request["from"]);
			$data_st["to"] = strtotime($request["to"]);
			$data_st["utm_source"] = (isset($request["utm_source"]))? $request["utm_source"] : null;
			$data_st["utm_campaign"] = (isset($request["utm_campaign"]))? $request["utm_campaign"] : null;
			$data_st["utm_content"] = (isset($request["utm_content"]))? $request["utm_content"] : null;
			$data_st["utm_term"] = (isset($request["utm_term"]))? $request["utm_term"] : null;
			$data_st["split"] = (isset($request["split"]) and $request["split"])? $request["split"] : null;
			$data_st["log"] = (isset($request["log"])) ? $request["log"] : null;
		}
		elseif (isset($request["price_change"])) {	
			$data = array();
			$id = $request["id"];
			$data["price"] = $request["price"];
			if (setPrices("id", $id, $data)) {
				$answer = "Цена отредактирована";
				redirect("/admin/prices.php?answer=".urlencode($answer));
			}
			else {
				$answer = "Произошла ошибка при редактировании цены. Обратитесь к разработчику.";
				redirect("/admin/prices.php?answer=".urlencode($answer));
			}
		}
	}	
?>