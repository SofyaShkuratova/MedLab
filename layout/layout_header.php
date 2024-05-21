<?php
// подключим файлы, необходимые для подключения к базе данных и файлы с объектами
include_once "config/database.php";
include_once "objects/user.php";
include_once "objects/service.php";
include_once "objects/session.php";
include_once "objects/category.php";
include_once "objects/reservation.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

$users = new Users($db);
$category = new Categories($db);
$reservations = new TimeTable($db);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title> <?= $page_title  ?> | MedLab </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" href="libs/imgs/logo/logo.png" type="image/x-icon">

    <!-- bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->

    <!-- кастомный CSS -->
    <link rel="stylesheet" href="libs/css/style.css" />
    <link rel="stylesheet" href="libs/css/main.css">
    <link rel="stylesheet" href="libs/css/custom.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="libs/css/font-awesome.min.css">
    <!-- Date Picker --> 
    <!-- <link href="node_modules/air-datepicker/datepicker.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="node_modules/air-datepicker/air-datepicker.css">
    <!-- <link rel="stylesheet" href="node_modules/air-datepicker/datepicker.css"> -->
</head>

<body>    
    <header class="header-area header-style-1 header-height-2">
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="home.php"><img src="libs/imgs/logo/logo.png" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-1">
                            <form action="#">                                
                                <input type="text" id="search-input" placeholder="Поиск по сайту...">
                            </form>
                            <div id="searchResult">

                            </div>
                        </div>
                        <div class="header-action-center">
                                <?php
                                if(isset($_SESSION['user'])) {
                                    if($cid_role == 2) {
                                        ?>
                                    <div class='header-action-2'>
                                        <div class='header-action-icon-2'>
                                            <a href='user_home.php'>
                                                <img class='svgInject' alt='MedLab' src='libs/imgs/theme/icons/icon-user.svg'>
                                            </a>
                                            <div class='cart-dropdown-wrap cart-dropdown-hm2'>
                                                <ul>
                                                    <li>
                                                        <p>Добрый день, <?= $cname ?></p>
                                                    </li>
                                                    <li>
                                                        <a href=''>Визиты</a>
                                                    </li>
                                                    <li>
                                                        <a href=''>Онлайн-запись</a>
                                                    </li>
                                                    <li>
                                                        <a href=''>Профиль</a>
                                                    </li>
                                                </ul>
                                                <div class='shopping-cart-footer'>
                                                    <div class='shopping-cart-button'>
                                                        <a href='logout.php' >Выход из аккаунта</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='header-action-icon-2'>
                                            <a class='mini-cart-icon' href='user_home.php'>
                                                <img alt='MedLab' src='libs/imgs/theme/icons/icon-timetable.svg'>
                                                <span class='pro-count blue'>
                                                    <?php
                                                        $stmt3 = $reservations->countTableUser($cid);
                                                        if($stmt3) {
                                                            $output = "";
                                                            foreach($stmt3 as $row) {
                                                                echo($row);
                                                            }
                                                        }
                                                    ?>
                                                </span>
                                            </a>
                                            <div class='cart-dropdown-wrap cart-dropdown-hm2'>
                                                <ul>
                                                    
                                                    <?php 
                                                        $stmt2 = $reservations->getTimeTableUser($cid);

                                                        if($stmt2) {
                                                            $output = "";
                                                            foreach($stmt2 as $row) {
                                                                $date = new DateTime($row['date_reserve']);
                                                                $months = [
                                                                    1 => 'Янв.',
                                                                    2 => 'Февр.',
                                                                    3 => 'Март',
                                                                    4 => 'Апр.',
                                                                    5 => 'Май',
                                                                    6 => 'Июнь',
                                                                    7 => 'Июль',
                                                                    8 => 'Авг.',
                                                                    9 => 'Сент.',
                                                                    10 => 'Окт.',
                                                                    11 => 'Нояб.',
                                                                    12 => 'Дек.'
                                                                ];
                                                                $formatted = $date->format('d. ') . $months[(int)$date->format('n')] . $date->format('. Y');
                                                                

                                                                $output .= "
                                                                <li>
                                                                    <div class='shopping-cart-title'>
                                                                        <h4>Специальность: <a href='product-detail.php?id_category=".$row['id_category']."'>".$row['title_category']."</a></h4>
                                                                        <h4>Врач: <a href='doctor-details.php?id_doctor=".$row['id_doctor']."'>".$row['doctor_lastname']." ".$row['doctor_name']."</a></h4>
                                                                        <h4><span>Дата записи: </span>".$formatted."</h4>
                                                                    </div>
                    
                                                                </li>
                                                                ";
                                                            }
                                                            echo($output);
                                                        }
                                                    ?>

                                                    <!-- <li>
                                                        <div class='shopping-cart-title'>
                                                            <h4><a href='#'>Лазерная коррекция зрения</a></h4>
                                                            <h4><span>Дата записи: </span>23 Апр. 12:00</h4>
                                                        </div>
        
                                                    </li>
                                                    <li>
                                                        <div class='shopping-cart-title'>
                                                            <h4><a href='#'>Лазерная очистка десен и полировка зубных камней</a></h4>
                                                            <h4><span>Дата записи: </span>23 Апр. 14:00</h4>
                                                        </div>
                                                        
                                                    </li> -->
                                                </ul>
                                                <div class='shopping-cart-footer'>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <?php
                                    } else {
                                    ?>
                                    <div class='header-action-2'>
                                        <div class='header-action-icon-2'>
                                            <a href='admin.php'>
                                                <img class='svgInject' alt='MedLab' src='libs/imgs/theme/icons/icon-user.svg'>
                                            </a>
                                            <div class='cart-dropdown-wrap cart-dropdown-hm2'>
                                                <ul>
                                                    <li>
                                                        <p>Добрый день, <?= $cname ?></p>
                                                        
                                                    </li>
                                                    <li>
                                                        <p>Вы администратор!</p>
                                                    </li> 
                                                </ul>
                                                <div class='shopping-cart-footer'>
                                                    <div class='shopping-cart-button'>
                                                        <a href='logout.php' >Выход из аккаунта</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    
                                } else if(isset($_SESSION['doctor'])) {
                                    ?>
                                    <div class='header-action-2'>
                                        <div class='header-action-icon-2'>
                                            <a href='doctor_home.php'>
                                                <img class='svgInject' alt='MedLab' src='libs/imgs/theme/icons/icon-user.svg'>
                                            </a>
                                            <div class='cart-dropdown-wrap cart-dropdown-hm2'>
                                                <ul>
                                                    <li>
                                                        <p>Добрый день!<br>Доктор  <?= $clast_name ." ".$cname ?> </p>
                                                    </li>
                                                    <li>
                                                        <a href=''>Расписание</a>
                                                    </li>
                                                    <li>
                                                        <a href=''>Онлайн-запись</a>
                                                    </li>
                                                    <li>
                                                        <a href=''>Профиль</a>
                                                    </li>
                                                </ul>
                                                <div class='shopping-cart-footer'>
                                                    <div class='shopping-cart-button'>
                                                        <a href='logout.php' >Выход из аккаунта</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }else {
                                    ?>
                                    <div class='header-action-2'>
                                        <div class='header-action-icon-2'>
                                            <a href='login.php'>
                                                <img class='svgInject' alt='MedLab' src='libs/imgs/theme/icons/icon-user.svg'>
                                            </a>
                                            <div class='cart-dropdown-wrap cart-dropdown-hm2'>
                                                <ul>
                                                    <li>
                                                        <p>Пожалуйста, войдите или зарегистрируйтесь</p>
                                                    </li>
                                                </ul>
                                                <div class='shopping-cart-footer'>
                                                    <div class='shopping-cart-button'>
                                                        <a href='login.php' >Вход</a>
                                                        <a href='registration.php' class='outline'>Регистрация</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                        </div>
                        <div class="header-action-right">
                            <a href="checkin.php" id="open-modal-btn" class="btn">Онлайн-запись</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="home.php"><img src="libs/imgs/logo/logo.png" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> Услуги и цены
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large" id="showNavCateg">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class=
                                        "<?= (basename($_SERVER['PHP_SELF']) == "home.php")?"active":""; ?>"
                                        href="home.php">Главная </a></li>
                                    <li><a class=
                                        "<?= (basename($_SERVER['PHP_SELF']) == "about.php")?"active":""; ?>"
                                        href="about.php">О компании</a></li>
                                    <li><a class="<?= (basename($_SERVER['PHP_SELF']) == "doctors.php")?"active":""; ?>" href="doctors.php">Врачи</a></li>
                                    
                                                          
                                    <li><a class="<?= (basename($_SERVER['PHP_SELF']) == "contact.php")?"active":""; ?>" href="contact.php">Контакты</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p>
                            <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                            <span>Телефон</span> +375 44 657 82 99 
                        </p>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="user_home.php">
                                    <img class="svgInject" alt="MedLab" src="libs/imgs/theme/icons/icon-user.svg">
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="cart.html">
                                    <img alt="MedLab" src="libs/imgs/theme/icons/icon-timetable.svg">
                                    <span class="pro-count blue">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-details.html"><img alt="MedLab" src="libs/imgs/shop/thumbnail-3.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="product-details.html">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-details.html"><img alt="MedLab" src="libs/imgs/shop/thumbnail-4.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="product-details.html">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="user_home.php">
                                                <img class="svgInject" alt="MedLab" src="libs/imgs/theme/icons/icon-user.svg">
                                                <!-- <span class="pro-count blue">4</span> -->
                                            </a>
                                            <!-- <a href="cart.html">View cart</a> -->
                                            <!-- <a href="shop-checkout.php">Checkout</a> -->
                                            <a class="mini-cart-icon" href="cart.html">
                                                <img alt="MedLab" src="libs/imgs/theme/icons/icon-timetable.svg">
                                                <span class="pro-count blue">2</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="home.php"><img src="libs/imgs/logo/logo.png" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Поиск…">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="fi-rs-apps"></span> Услуги и цены
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-small">
                            <ul>
                                <li><a href="shop.html"><i class="surfsidemedia-font-dress"></i>Стоматология</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-tshirt"></i>Дерматология</a></li>
                                <li> <a href="shop.html"><i class="surfsidemedia-font-smartphone"></i> Кардиология</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-desktop"></i>Онкология</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="home.php">Главная</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">О компании</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="doctors.php">Врачи</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Контакты</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info">
                        <a href="login.php">Вход </a>                        
                    </div>
                    <div class="single-mobile-header-info">                        
                        <a href="registration.php">Регистрация</a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#">(+375) 44 75 67 988 </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        
        //Display Categories value Navigation
        navCategories();
        function navCategories() {
            $.ajax({
                url: 'ajax/main-data.php',
                method: 'post',
                data: { action: 'nav_categories' },
                success: function(response) {
                    console.log(response);
                    $("#showNavCateg").html(response);
                }
            })
        }
    });

    let searchData;

    $(document).on("change", "#search-input", function(e) {
        e.preventDefault();
        
        $("#searchResult").addClass("show");
        searchData = $(this).val();

        if(!searchData) {
            document.getElementById('searchResult').innerText = "По данному запросу ничего не найдено.";
        } else {
            searchTable(searchData);
        }
    });

    $("#search-input").on("blur", function() {
        $("#searchResult").removeClass("show");
    });

    function searchTable(data) {
        $.ajax({
            url: 'ajax/main-data.php',
            method: 'post',
            data: { action: 'search_data', data_search: data},
            success: function(response) {
                console.log(response);
                $("#searchResult").html(response);
                
            }
        })
    }
</script>