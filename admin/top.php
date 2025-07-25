<html class="no-js" lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="панель управления, управление сайтом, управление лендингом" />
	<meta name="description" content="Панель управления лендингом" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Панель управления лендингом</title>
    <link rel="icon" href="/assets/img/favicon.png" />
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body class="inner">
    <div class="main" id="bg-admin">
        <header class="navbar navbar-sticky navbar-expand-lg navbar-dark">
            <div class="container position-relative">
                <a class="navbar-brand" href=".">
                    <img class="navbar-brand-regular" src="/assets/img/logo/logo-white.png" alt="brand-logo">
                    <img class="navbar-brand-sticky" src="/assets/img/logo/logo.png" alt="sticky brand-logo">
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
                                <a class="nav-link" href="/"><i class="fas fa-chevron-left"></i> Лендинг</a>
                            </li>  
							<?php if(isAdmin()) { ?>
							<li class="nav-item">
                                <a class="nav-link" href="/admin/">Главная</a>
                            </li> 
							<li class="nav-item">
                                <a class="nav-link" href="/admin/orders.php">Заказы</a>
                            </li> 
							<li class="nav-item">
                                <a class="nav-link" href="/admin/files.php">Клиенты</a>
                            </li> 
							<li class="nav-item">
                                <a class="nav-link" href="/admin/statistics.php">Статистика</a>
                            </li> 
							<li class="nav-item">
                                <a class="nav-link" href="/admin/prices.php">Цены</a>
                            </li> 
							<li class="nav-item">
                                <a class="nav-link" href="/admin/?logout=true"><i class="fas fa-sign-out-alt"></i> Выход</a>
                            </li>  
							<?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        
