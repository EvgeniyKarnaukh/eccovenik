<?php
require_once "lib/start.php";	
	// <Все цены получаем>
	$prices = getPrices();
	// </>
	// <Счётчик посещений (count_views)>
	$count_views = getCount(1);
	$count_views = $count_views + 1;
	setCount(1, array("count" => $count_views));
	// </>
	// <Счётчик посетителей (count_visitiors)>
	if (!isset($_COOKIE["userhash"]) || !$_COOKIE["userhash"]) {
		$data = array();
		$data["userhash"] = uniqid();		
		$data["ip"] = ip2long($_SERVER["REMOTE_ADDR"]);
		$data["referer"] = isset($_SERVER["HTTP_REFERER"])? $_SERVER["HTTP_REFERER"] : null;
		$data["date"] = time();		
		addVisitor($data);		
		
		setcookie("userhash", $data["userhash"], time()+31536000);
		countVisitors(2);
	}
	// </>	
	$count_sessions = getCount(3);	
	// <Счётчик сессий (count_sessions)>
	if (!isset($_SESSION["uniq_id"]) || !$_SESSION["uniq_id"]) {
		$count_sessions = $count_sessions + 1;
		setCount(3, array("count" => $count_sessions));
		$_SESSION["uniq_id"] = uniqid();
	}
	// </>		
	// <Показатель конверсии (count_conversion)>
	$all_orders = getAllOrders();
	if ($count_sessions > 0 and $all_orders > 0) {		
		$conversion = ($all_orders / $count_sessions)*100;
		setCount(4, array("count" => $conversion));
	}
	// </>	
	// <SPLIT тесты>
	if (!isset($_SESSION["split"]) || !$_SESSION["split"]) {
		$values = array(array("title" => "Веники для бани", "subtitle" => "купить по доступной цене", "subsubtitle" => "с доставкой"), array("title" => "Купить веник", "subtitle" => "веники для бани купить", "subsubtitle" => "по доступным ценам"));
		$rand = mt_rand(0, count($values) - 1);
		$_SESSION["split"] = $values[$rand];
	}	
	//</>
	if (!isset($_SESSION["camp_id"]) || !$_SESSION["camp_id"]) {
		$data = array();
		$data["ip"] = ip2long($_SERVER["REMOTE_ADDR"]);
		$data["utm_source"] = isset($request["utm_source"])? $request["utm_source"] : null;
		$data["utm_campaign"] = isset($request["utm_campaign"])? $request["utm_campaign"] : null;
		$data["utm_content"] = isset($request["utm_content"])? $request["utm_content"] : null;
		$data["utm_term"] = isset($request["utm_term"])? $request["utm_term"] : null;
		$camp_id = getCampID($data);
		if (!$camp_id) {
			$data["ref"] = isset($_SERVER["HTTP_REFERER"])? $_SERVER["HTTP_REFERER"] : null;
			$data["date"] = time();
			$camp_id = addCamp($data);
		}
		$_SESSION["camp_id"] = $camp_id;
	}
?>
<!doctype html>
<html class="no-js" lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="веники для бани, купить веник, веники для бани купить, березовый веник, дубовый веник, банный веник, товары для бани, банные принадлежности, березовый веник для бани, дубовый веник для бани, правильный веник для бани, пихтовый веник, веник березовый купить, веник дубовый купить, банные веники купить, эвкалиптовый веник, банные принадлежности купить, магазин банных принадлежностей, правильный березовый веник, правильный дубовый веник, можжевеловый веник, дубовые веники для бани купить, пихтовый веник для бани, веники для бани дуб, парение вениками, веник эвкалиптовый для бани, липовый веник, пихтовый веник купить, можжевеловый веник для бани, кленовый веник, липовый веник для бани" />
	<meta name="description" content="Веники для бани купить по доступной цене с доставкой, экологически чистый продукт" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="yandex-verification" content="2aafd3f5f4809a90" />
    <title>Веники для бани купить по доступной цене с доставкой</title>
    <link rel="icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css">
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
	   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
	   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	   ym(85957691, "init", {
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true
	   });
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/85957691" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</head>

<body class="homepage-6">
    <div id="scrollUp" title="Scroll To Top">
        <i class="fas fa-arrow-up"></i>
    </div>
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
                                <a class="nav-link scroll" href="#bath-brooms">Веники для бани</a>
                            </li>                            
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#birch-broom">Берёзовый</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#oak-broom">Дубовый</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#lime-broom">Липовый</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link scroll" href="#fir-broom">Пихтовый</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link scroll" href="#features">Ассортимент</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <section id="home" class="section welcome-area bg-overlay overflow-hidden d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="welcome-intro text-center header-text">
                            <h1 class="text-white" data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000"><?=$_SESSION["split"]["title"]?></h1>
                            <h2 class="text-white" data-aos="fade-down" data-aos-delay="500" data-aos-duration="1000"><?=$_SESSION["split"]["subtitle"]?></h2>
                            <h2 class="text-white" data-aos="fade-down" data-aos-delay="500" data-aos-duration="1000"><?=$_SESSION["split"]["subsubtitle"]?></h2>
                            <p class="my-4" data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000"></p>
                        </div>
						<div class="welcome-bottom text-center" data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000">
							<span class="text-white d-inline-block fw-3 font-italic mt-3">Экологически чистый продукт</span>
						</div>
						<br />
						<div class="text-center" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1000">
							<a href="." class="btn sApp-btn" data-toggle="modal" data-target="#myModal">Оставить заявку</a>
						</div>
                    </div>
                </div>
            </div>
            <div class="shape-bottom">
                <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                    <path class="fill" d="M0,6V0h1000v100L0,6z"></path>
                </svg>
            </div>
        </section>
        <section id="bath-brooms" class="section features-area overflow-hidden mt-5 ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="section-heading text-center">
                            <h2>ВЕНИКИ ДЛЯ БАНИ</h2>
                            <p class="mt-4">Купить правильный веник для бани — это значит сделать шаг к здоровью и хорошему самочувствию!</p>
							<p class="mt-4">На организм парение вениками оказывает комплексное воздействие:</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 order-1 order-lg-1">
                        <div class="service-thumb discover-thumb mx-auto pt-5 pt-lg-0 wow pulse">
                            <img src="assets/img/discover/section-1.png" alt="Веник в бане">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 order-2 order-lg-2" >						
                        <ul class="features-item">
                            <li>
                                <div class="image-box media icon-1 px-1 py-3 py-md-2 wow fadeInRight" data-aos-duration="2s" data-wow-delay="0.1s">
                                    <div class="featured-img mr-3">
                                       <img class="avatar-sm" src="assets/img/icon/featured-img/heart.png" alt="">
                                    </div>
                                    <div class="icon-text media-body align-self-center align-self-md-start">
                                        <h3 class="mb-2">улучшает кровообращение</h3>
										<p>тело будет получать больше кислорода</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="image-box media icon-2 px-1 py-3 py-md-3 wow fadeInRight" data-aos-duration="2s" data-wow-delay="0.2s">
                                    <div class="featured-img mr-3">
                                        <img class="avatar-sm" src="assets/img/icon/featured-img/setting.png" alt="">
                                    </div>
                                    <div class="icon-text media-body align-self-center align-self-md-start">
                                        <h3 class="mb-2">массажирует</h3>
										<p>общее улучшение самочувствия</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="image-box media icon-3 px-1 py-3 py-md-3 wow fadeInRight" data-aos-duration="2s" data-wow-delay="0.3s">
                                    <div class="featured-img mr-3">
                                        <img class="avatar-sm" src="assets/img/icon/featured-img/water.png" alt="">
                                    </div>
                                    <div class="icon-text media-body align-self-center align-self-md-start">
                                        <h3 class="mb-2">вызывает обильное потоотделение</h3>
										<p>запуск функции терморегуляции</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="image-box media icon-4 px-1 py-3 py-md-3 wow fadeInRight" data-aos-duration="2s" data-wow-delay="0.4s">
                                    <div class="featured-img mr-3">
                                        <img class="avatar-sm" src="assets/img/icon/featured-img/plus.png" alt="">
                                    </div>
                                    <div class="icon-text media-body align-self-center align-self-md-start">
                                        <h3 class="mb-2">улучшает метаболизм</h3>
										<p>ускорение обмена веществ</p>
                                    </div>
                                </div>
                            </li>
							<li>
                                <div class="image-box media icon-5 px-1 py-3 py-md-3 wow fadeInRight" data-aos-duration="2s" data-wow-delay="0.5s">
                                    <div class="featured-img mr-3">
                                        <img class="avatar-sm" src="assets/img/icon/featured-img/arrow-green.png" alt="">
                                    </div>
                                    <div class="icon-text media-body align-self-center align-self-md-start">
                                        <h3 class="mb-2">расширяет поры</h3>
										<p>глубокое очищение кожи</p>
                                    </div>
                                </div>
                            </li>
							<li>
                                <div class="image-box media icon-6 px-1 py-3 py-md-3 wow fadeInRight" data-aos-duration="2s" data-wow-delay="0.6s">
                                    <div class="featured-img mr-3">
                                        <img class="avatar-sm" src="assets/img/icon/featured-img/exit.png" alt="">
                                    </div>
                                    <div class="icon-text media-body align-self-center align-self-md-start">
                                        <h3 class="mb-2">выводит токсины</h3>
										<p>уменьшается вероятность заболеваний</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
				<br />
				<div class="text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
					<a href="#form" class="btn btn-bordered mt-4" data-toggle="modal" data-target="#myModal">Заказать веники для бани со скидкой 20%</a>
				</div>				
            </div>
        </section>
        <section id="birch-broom" class="section service-area overflow-hidden ptb_100">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-6 order-2 order-lg-1">
                        <div class="service-text pt-4 pt-lg-0">
                            <h2 class="mb-4 wow fadeInLeft text-center">БЕРЁЗОВЫЙ ВЕНИК</h2>
                            <ul class="service-list">
                                <li class="single-service media py-2">
                                    <div class="service-icon pr-4">
                                        <span><i class="fab fa-pagelines"></i></span>										
                                    </div>
                                    <div class="service-text media-body">
                                        <p>Березовый веник самый популярный, так как выделяет большое количество эфирных масел.</p>										
                                    </div>
                                </li>
								<br />
                                <li class="single-service media py-2">
                                    <div class="service-icon pr-4">
                                        <span><i class="fas fa-smoking"></i></span>										
                                    </div>
                                    <div class="service-text media-body">
                                        <p>Благодаря этому часто рекомендуется курильщикам и людям, страдающим астмой.</p>
                                    </div>
                                </li>
								<br />
                                <li class="single-service media py-2">
                                    <div class="service-icon pr-4">
                                        <span><i class="fas fa-plus"></i></span>
                                    </div>
                                    <div class="service-text media-body">
                                        <p>Березовый банный веник для бани способствует:</p>
										<br />
										<ul class="check-list">
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">лечению верхних дыхательных путей и лёгких;</span>
												</div>
											</li>
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">стимулирует работу почек;</span>
												</div>
											</li>
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">замедляет воспалительные процессы;</span>
												</div>
											</li>
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">очищает поры кожи;</span>
												</div>
											</li>
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">снимает боли в суставах и мышцах.</span>
												</div>
											</li>
										</ul>
                                    </div>
                                </li>                               
                            </ul>
                            <div class="text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
								<a href="#form" class="btn btn-bordered mt-4" data-toggle="modal" data-target="#myModal">Заказать веники для бани со скидкой 20%</a>
							</div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 order-1 order-lg-2 d-none d-lg-block">
                        <div class="service-thumb mx-auto wow pulse">
                            <img src="assets/img/features/berezoviy-venik.png" alt="Берёзовый веник">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="oak-broom" class="section discover-area bg-gray overflow-hidden ptb_100">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-6 order-1 order-lg-1 d-none d-lg-block">
                        <div class="service-thumb discover-thumb mx-auto pt-5 pt-lg-0 wow pulse">
                            <img src="assets/img/discover/duboviy-venik.png" width="750" height="789" alt="Дубовый веник">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 order-2 order-lg-2">
                        <div class="discover-text pt-4 pt-lg-0 px-0 px-lg-4">
                            <h2 class="pb-4 wow fadeInRight text-center">ДУБОВЫЙ ВЕНИК</h2>
                            <ul class="check-list">
                                <li class="py-1">
                                    <div class="list-box media">
                                        <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                        <span class="media-body pl-3">Для заживления ран и ссадин хорошо подходит дубовый веник.</span>
                                    </div>
                                </li>
                                <li class="py-1">
                                    <div class="list-box media">
                                        <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                        <span class="media-body pl-3">Дубовый веник для бани так же улучшает состояние кожи.</span>
                                    </div>
                                </li>
                                <li class="py-1">
                                    <div class="list-box media">
                                        <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                        <span class="media-body pl-3">Веник дубовый иногда рекомендуют врачи при гиперфункции сальных желез, признаках аллергии, астмы.</span>
                                    </div>
                                </li>
                                <li class="py-1">
                                    <div class="list-box media">
                                        <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                        <span class="media-body pl-3">Дубовый банный веник снимает воспаления, головную боль и понижает высокое артериальное давление.</span>
                                    </div>
                                </li>
                            </ul>
                            <br />
							<div class="text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
								<a href="#form" class="btn btn-bordered mt-4" data-toggle="modal" data-target="#myModal">Заказать веники для бани со скидкой 20%</a>
							</div>
                        </div>
                    </div>					
                </div>
            </div>
        </section>
        <section class="section download-area overlay-dark ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-9">
                        <div class="download-text text-center wow bounceIn">
                            <h2 class="text-white">Акция!</h2><br />
							<div class="border-white">
								<h3 class="my-3 text-yellow">Пихтовые веники по цене от 50р!</h3>
								<p class="text-white my-3">При заказе веников для бани от 10 штук,</p>
								<p class="text-white my-3">мы сделаем подарок для Вас:</p>
								<h3 class="my-4 text-yellow">1 веник на Ваш выбор в подарок!</h3>
							</div>
                        </div>
						<div class="text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
							<a href="#form" class="btn btn-bordered mt-4" data-toggle="modal" data-target="#myModal">Заказать веники для бани!</a>
						</div>
                    </div>
                </div>
            </div>
        </section>
        <section id="lime-broom" class="section service-area overflow-hidden ptb_100">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-6 order-1 order-lg-1">
                        <div class="service-text pt-4 pt-lg-0">
                            <h2 class="mb-4 wow fadeInLeft text-center">ЛИПОВЫЙ ВЕНИК</h2>
                            <ul class="service-list">
                                <li class="single-service media py-2">
                                    <div class="service-icon pr-4">
                                        <span><i class="fab fa-pagelines"></i></span>										
                                    </div>
                                    <div class="service-text media-body">
                                        <p>Липовый веник для бани успокаивает и нормализует работу нервной системы.</p>										
                                    </div>
                                </li>
								<br />
                                <li class="single-service media py-2">
                                    <div class="service-icon pr-4">
                                        <span><i class="far fa-heart"></i></span>										
                                    </div>
                                    <div class="service-text media-body">
                                        <p>Используя такие банные принадлежности как липовый веник, люди замечают, как после бани затянулись ранки и царапины.</p>
                                    </div>
                                </li>
								<br />
                                <li class="single-service media py-2">
                                    <div class="service-icon pr-4">
                                        <span><i class="fas fa-plus"></i></span>
                                    </div>
                                    <div class="service-text media-body">
                                        <p>Этот банный веник поможет:</p>
										<br />
										<ul class="check-list">
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">очистить бронхи;</span>
												</div>
											</li>
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">вылечить простуду;</span>
												</div>
											</li>
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">ускорить регенерационные процессы;</span>
												</div>
											</li>
											<li class="py-1">
												<div class="list-box media">
													<span class="icon align-self-center"><i class="fas fa-check"></i></span>
													<span class="media-body pl-3">очистить легкие.</span>
												</div>
											</li>
										</ul>
                                    </div>
                                </li>                               
                            </ul>
                            <div class="text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
								<a href="#form" class="btn btn-bordered mt-4" data-toggle="modal" data-target="#myModal">Заказать веники для бани со скидкой 20%</a>
							</div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 order-2 order-lg-2 d-none d-lg-block">
                        <div class="service-thumb mx-auto wow pulse">
                            <img src="assets/img/features/lipoviy-venik.png" alt="Липовый веник">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="fir-broom" class="section discover-area bg-gray overflow-hidden ptb_100">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-6 order-1 order-lg-1 d-none d-lg-block">
                        <div class="service-thumb discover-thumb mx-auto pt-5 pt-lg-0 wow pulse">
                            <img src="assets/img/discover/pihtoviy-venik.png" alt="Пихтовый веник">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 order-2 order-lg-2">
                        <div class="discover-text pt-4 pt-lg-0 px-0 px-lg-4">
                            <h2 class="pb-4 wow fadeInRight text-center">ПИХТОВЫЙ ВЕНИК</h2>
                            <ul class="check-list">
                                <li class="py-1">
                                    <div class="list-box media">
                                        <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                        <span class="media-body pl-3">Пихтовый веник для бани создаст невероятный аромат в парной. Это так же и кладезь полезных веществ, которые при контакте с кожей и органами дыхания способствуют укреплению иммунитета!</span>
                                    </div>
                                </li>
                                <li class="py-1">
                                    <div class="list-box media">
                                        <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                        <span class="media-body pl-3">Пихта содержит в себе аромамасла, которые очищают слизистые организма.</span>
                                    </div>
                                </li>
                                <li class="py-1">
                                    <div class="list-box media">
                                        <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                        <span class="media-body pl-3">У Вас повысится иммунитет к респираторным заболеваниям!</span>
                                    </div>
                                </li>
                                <li class="py-1">
                                    <div class="list-box media">
                                        <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                        <span class="media-body pl-3">Так же пихта нормализует сон, успокаивает нервную систему, способствует выведению мокроты.</span>
                                    </div>
                                </li>
                            </ul>
                            <br />
							<div class="text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
								<a href="#form" class="btn btn-bordered mt-4" data-toggle="modal" data-target="#myModal">Заказать веники для бани со скидкой 20%</a>
							</div>
                        </div>
                    </div>					
                </div>
            </div>
        </section>
        <section id="features" class="section features-area ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="section-heading text-center">
                            <h2>ПРАВИЛЬНЫЕ ВЕНИКИ ДЛЯ БАНИ</h2>
                            <p class="mt-4">Мы предлагаем правильные веники для бани, сделанные с любовью, чтобы Вы были здоровы!</p>
                            <p class="mt-4">У нас можете заказать веники для бани:</p>
                        </div>
                    </div>
                </div>
                <div class="row">
				
					<?php foreach ($prices as $price) {?>
					
					<div class="col-12 col-md-6 col-lg-4">
                        <div class="icon-box text-center p-4">
                            <div class="featured-icon mb-3 wow pulse">
                                <img src="assets/img/brand/<?=$price["img_src"]?>" alt="<?=$price["title"]?>" />
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=$price["title"]?></h3>
                                <p class="wow bounceIn" data-wow-duration="0,5s" data-wow-delay="<?=$price["data-wow-delay"]?>s">Цена: <?=$price["price"]?>р.</p>
                            </div>
                        </div>
                    </div>
					
					<?php } ?>
					
                    
                </div>
				<div class="text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
					<a href="#form" class="btn btn-bordered mt-4" data-toggle="modal" data-target="#myModal">Заказать веники для бани со скидкой 20%</a>
				</div>	
            </div>
        </section>
		<section class="section subscribe-area ptb_100">
            <div class="container">
                <div class="row justify-content-center">
					<div class="col-12 col-md-12 col-lg-8">
                        <div class="subscribe-content text-center">
                            <h2>Обратная связь</h2>
							<br />
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="contact-us">
                            <ul>
                                <li class="py-2">
                                    <a class="media" href="#">
                                        <div class="social-icon mr-3 whatsapp-styles">
                                            <i class="fas fa-home whatsapp-i"></i>
                                        </div>
                                        <span class="media-body align-self-center">Удмуртская республика, г. Ижевск</span>
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a class="media" href="https://wa.me/79120253889">
                                        <div class="social-icon mr-3 whatsapp-styles">
                                            <i class="fab fa-whatsapp whatsapp-i"></i>
                                        </div>
                                        <span class="media-body align-self-center">Написать в whatsapp</span>
                                    </a>
                                </li>
								<li class="py-2">
                                    <a class="media" href="https://viber.click/79120253889">
                                        <div class="social-icon mr-3 whatsapp-styles">
                                            <i class="fab fa-viber whatsapp-i"></i>
                                        </div>
                                        <span class="media-body align-self-center">Написать в viber</span>
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a class="media" href="mailto: eccovenik@yandex.ru">
                                        <div class="social-icon mr-3 whatsapp-styles">
                                            <i class="fas fa-envelope whatsapp-i"></i>
                                        </div>
                                        <span class="media-body align-self-center">eccovenik@yandex.ru</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
					<div class="col-12 col-md-6 col-lg-6">
                        <div class="subscribe-content text-center">
							<h4>Отправить заявку</h4>
							<br />
                            <form id="feedback" action="" name="feedback" class="subscribe-form" method="post">
                                <div class="form-group">
									<input type="phone" name="phone-fb" class="form-control phone2" placeholder="Телефон" required="required" />
                                </div>
								<div class="form-group">
									<textarea class="form-control" name="message" placeholder="Ваше сообщение" required="required"></textarea>
								</div>
                                <button name="feedback" type="submit" class="btn btn-lg btn-block wow fadeInUp">Отправить</button>
                            </form>
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
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">Форма заказа</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<h6 class="text-center mb-3" id="myModalLabel">Скидку 20% гарантируем!</h6>
			<form name="order" action="" method="post">
				<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="Имя" required="required" />
				</div>
				<div class="form-group">
					<input type="text" class="form-control phone1" name="phone" placeholder="Телефон" required="required" />
				</div>
				<div class="form-group">
					<input type="hidden" name="price" value="0" />
				</div>
				<button name="order" type="submit" class="btn btn-lg btn-block">Отправить заявку</button>
			 </form>
		  </div>
		  <div class="text-center mb-3">
			<h6 class="modal-title" id="myModalLabel">Перезвоним в течении 5 минут!</h6>
		  </div>
		</div>
	  </div>
	</div>
    <script src="assets/js/jquery/jquery.min.js"></script>
	<script src="assets/js/jquery/inputmask.min.js"></script>
    <script src="assets/js/jquery/jquery.inputmask.min.js"></script>
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    <script src="assets/js/active.js"></script>
</body>
</html>