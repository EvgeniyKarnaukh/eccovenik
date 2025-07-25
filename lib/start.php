<?php
	mb_internal_encoding("UTF-8");
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	session_start();
	
	// Системные сообщения
	$answer = false;
	
	// Версия админ-панели
	define("LP_VERSION", "1.0");
	
	// Домен
	define("DOMAIN", "eccovenik.ru");
	
	// Данные администратора
	define("SECRET", "8Q9ry5dgh6dYd93jdz6M54dreK");
	define("ADM_LOGIN", "admin");
	define("ADM_PASSWORD", "ce230b44bf0e0fcd58c354c698111a37");	
	define("ADM_EMAIL", "eccovenik@yandex.ru");
	
	// Формат даты
	define("FORMAT_DATE", "d.m.Y (H:i)");
	
	// База данных
	define("DB_HOST", "localhost");
	define("DB_USER", "vh484196_admin");
	define("DB_PASSWORD", "wW7U3KdjFCV5");
	define("DB_NAME", "vh484196_eccovenik");
	
	// SMS Aero
	define("SMS_EMAIL", "eccovenik@yandex.ru");
	define("SMS_API_KEY", "5lu8BtFgcnXKaLehJtz8KLWI5Rsl");
	define("SMS_PHONE", "79120253889");
	
	require_once $_SERVER['DOCUMENT_ROOT']."/lib/functions.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/lib/request.php";
?>