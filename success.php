<?php
	require_once "lib/start.php";
?>
<!doctype html>
<html class="no-js" lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="веники для бани, купить веник, веники для бани купить, березовый веник, дубовый веник, банный веник, товары для бани, банные принадлежности, березовый веник для бани, дубовый веник для бани, правильный веник для бани, пихтовый веник, веник березовый купить, веник дубовый купить, банные веники купить, эвкалиптовый веник, банные принадлежности купить, магазин банных принадлежностей, правильный березовый веник, правильный дубовый веник, можжевеловый веник, дубовые веники для бани купить, пихтовый веник для бани, веники для бани дуб, парение вениками, веник эвкалиптовый для бани, липовый веник, пихтовый веник купить, можжевеловый веник для бани, кленовый веник, липовый веник для бани" />
	<meta name="description" content="Веники для бани купить по доступной цене с доставкой, экологически чистый продукт" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Веники для бани купить по доступной цене с доставкой</title>
    <link rel="icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="homepage-5">
    <div class="main">
        <header class="navbar navbar-sticky navbar-expand-lg navbar-dark">
            <div class="container position-relative">
                <a class="navbar-brand" href=".">
                    <img class="navbar-brand-regular" src="assets/img/logo/logo-white.png" alt="brand-logo">
                    <img class="navbar-brand-sticky" src="assets/img/logo/logo.png" alt="sticky brand-logo">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-inner">
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <nav>
                        <ul class="navbar-nav" id="navbar-nav">                            
                            <li class="nav-item">
                                <a class="nav-link" href=".">На главную страницу</a>
                            </li>                            
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <section id="home" class="section welcome-area bg-overlay">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-12 col-md-12">
                        <div class="welcome-intro">
							<?php if(isset($_SESSION["form_type"]) and $_SESSION["form_type"] == "order") { ?>
                            <h1>Спасибо за Вашу заявку!</h1>
                            <h3 class="my-4">Мы Вам перезвоним в течении 5 минут.</h3>
							
                            <br /><a href="." class="btn sApp-btn">Вернуться назад</a>
							<?php } ?>
							<?php if (isset($_SESSION["form_type"]) and $_SESSION["form_type"] == "feedback") { ?>
							<h1>Ваше сообщение отправлено</h1>
                            <h3 class="my-4">Мы рассмотрим Ваше сообщение в ближайшее время и обязательно ответим на него.</h3>
                            <br /><a href="." class="btn sApp-btn">Вернуться назад</a>
							<?php } ?>
							<?php if (!isset($_SESSION["form_type"])) { ?>
							<h1>Внимание</h1>
                            <h3 class="my-4">Вы перешли на эту страницу без параметров, минуя форму заказа. Вернитесь назад и заполните форму заказа.</h3>
							<br /><a href="." class="btn sApp-btn">Вернуться назад</a>
							<?php } ?>
						</div>
                    </div>
                </div>
            </div>
        </section>
		<div class="height-emulator d-none d-lg-block"></div>
        <footer class="footer-area footer-fixed">
            <footer class="footer-area footer-fixed">
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="copyright-area d-flex flex-wrap justify-content-center justify-content-sm-between text-center py-4">
                                <div class="copyright-left">Copyright &copy; <?=date("Y")?>. Все права защищены <a href="/privacy"> | Политика конфиденциальности</a></div>
                                <div class="copyright-right">Создано <a target="_blank" href="https://landing-page.one"><img src="https://landing-page.one/assets/img/logo/logo.png" alt="Логотип" /></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery/jquery.min.js"></script>
    <script src="assets/js/active.js"></script>
</body>
</html>