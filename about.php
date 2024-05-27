<?php

require_once "objects/session.php";

$page_title = "О компании";
require_once "layout/layout_header.php";
?>

<main class="main single-page">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                     <a href="home.php" rel="nofollow">Главная</a>                    
                    <span></span>  <?php echo($page_title) ?>
                </div>
            </div>
        </div>
        <section class="section-padding">
            <div class="container pt-25">
                <div class="row">
                    <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
                        <h6 class="mt-0 mb-15 text-uppercase font-sm text-brand wow fadeIn animated">Наша компания</h6>
                        <h1 class="font-heading mb-40">
                            Мы строим здоровое будущее наших пациентов
                        </h1>
                        <p>Добро пожаловать в медицинский центр MedLab! Мы предоставляем высококачественные медицинские услуги, ориентированные на заботу о вашем здоровье и благополучии.</p>
                    </div>
                    <div class="col-lg-6">
                        <img src="libs/imgs/video/poster.png" alt="">
                    </div>
                </div>
            </div>
        </section>                
        <section id="testimonials" class="section-padding">
            <div class="container pt-25">
                <div class="row mb-50">
                    <div class="col-lg-12 col-md-12 text-center">
                        <h6 class="mt-0 mb-10 text-uppercase  text-brand font-sm wow fadeIn animated">немного фактов</h6>
                        <h2 class="mb-15 text-grey-1 wow fadeIn animated">Посмотрите что пишут<br>наши клиенты о нас</h2>
                        <p class="w-50 m-auto text-grey-3 wow fadeIn animated">Каждый оставил частичку себя и написал отзыв</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                            <div class="hero-card-icon icon-left-2 hover-up ">
                                <!-- <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="libs/imgs/page/avatar-3.jpg" alt=""> -->
                            </div>
                            <div class="pl-30">
                                <h5 class="mb-5 fw-500">
                                    Иван, 42 года
                                </h5>
                                <p class="font-sm text-grey-5">Хирургия</p>
                                <p class="text-grey-3">“MedLab - это место, где я всегда могу получить квалифицированную помощь. Врачи заботятся о каждом пациенте, и это действительно ценно.”</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                            <div class="hero-card-icon icon-left-2 hover-up ">
                                <!-- <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="libs/imgs/page/avatar-1.jpg" alt=""> -->
                            </div>
                            <div class="pl-30">
                                <h5 class="mb-5 fw-500">
                                    Анна, 35 лет
                                </h5>
                                <p class="font-sm text-grey-5">Стоматология</p>
                                <p class="text-grey-3">“Я долгое время страдала от хронических болей в спине. Благодаря врачам MedLab мои проблемы были успешно решены. Отличный сервис и профессиональный подход!”</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                            <div class="hero-card-icon icon-left-2 hover-up ">
                                <!-- <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="libs/imgs/page/avatar-2.jpg" alt=""> -->
                            </div>
                            <div class="pl-30">
                                <h5 class="mb-5 fw-500">
                                    Елена, 28 лет
                                </h5>
                                <p class="font-sm text-grey-5">Дерматология</p>
                                <p class="text-grey-3">“Мне понравилась атмосфера в MedLab. Все сотрудники дружелюбны и внимательны. Я чувствую себя в надежных руках.”</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </section>
    </main>

<?php // подвал
require_once "layout/layout_footer.php";
?>