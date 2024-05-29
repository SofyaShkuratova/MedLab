<?php

require_once "objects/session.php";

$page_title = "Контакты";
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
                <div class="centered ">
                        
                        <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Контакты</h5>
                        <p class="wow fadeIn animated">
                            <strong>Адрес: </strong>Надеждинская, 23
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Телефон: </strong>+375 29 143 56 78
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Email: </strong>medlab-contact@gmail.br
                        </p>
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Наши социальные сети</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="#"><img src="libs/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                            <a href="#"><img src="libs/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                            <a href="#"><img src="libs/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                            <a href="#"><img src="libs/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                            <a href="#"><img src="libs/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                        </div>
                    </div>
            </div>
        </section>
</main>

<?php 
require_once "layout/layout_footer.php";
?>
