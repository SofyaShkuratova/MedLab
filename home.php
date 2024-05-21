<?php
// //установка заголовка страницы
require_once "objects/session.php";
// echo 'pre';
// print_r($data);
if (!empty($data)) {
    // echo 'NEPYSTO';
    // print_r($data);
} else {
    // echo 'PYSTO';
}
// session_start();
include_once "config/database.php";

$database = new Database();
$db = $database->getConnection();

include_once "objects/user.php";
$users = new Users($db);

include_once "objects/category.php";
include_once "objects/service.php";
include_once "objects/doctor.php";
include_once "objects/review.php";
$categories = new Categories($db);
$reviews = new Review($db);
$services = new Service($db);
$doctors = new Doctor($db);

$page_title = "Главная";
require_once "layout/layout_header.php";

// print_r($cid_role);
?>


<main class="main">
        
<section class="home-slider position-relative pt-50">
    <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
        <div class="single-hero-slider single-animation-wrap">
            <div class="container">
                <div class="row align-items-center slider-animated-1">
                    <div class="col-lg-5 col-md-6">
                        <div class="hero-slider-content-2">
                            <h2 class="animated fw-900">Забота о здоровье: </h2>
                            <h2 class="animated fw-900 text-brand">Медицинский центр для вас</h2>
                            <p class="animated">Записывайся онлайн быстро и без телефонного звонка</p>
                            <a class="btn" href="checkin.php"> Записаться </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="single-slider-img single-slider-img-1">
                            <img class="animated slider-1-1" src="libs/imgs/slider/slider-1.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-arrow hero-slider-1-arrow"></div>
</section>

    <section class="section-padding">
        <div class="container pt-25">
            <div class="row">
                    <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
                        <h6 class="mt-0 mb-15 text-uppercase font-sm text-brand wow fadeIn animated">О компании</h6>
                        <h1 class="font-heading mb-40">
                            Медицинский центр MedLab
                        </h1>
                        <p>Медицинский центр Medlab — это современное медицинское учреждение, предоставляющее широкий спектр высококачественных медицинских услуг. Наша миссия — обеспечить каждому пациенту доступ к инновационным и эффективным методам диагностики и лечения.</p>
                        <a class="btn mt-20" href="about.php"> О компании </a>
                    </div>
                    <div class="col-lg-6">
                        <video  controls poster="libs/imgs/video/poster.png">
                            <source src="libs/imgs/video/explainer.mp4" type="video/mp4">
                            <!-- <source src="assets/imgs/video/movie.ogg" type="video/ogg"> -->
                            Ваш браузер не поддерживает элемент видео.
                        </video>
                        <!-- <img src="assets/imgs/page/about-1.png" alt=""> -->
                    </div>
                </div>
        </div>
    </section>

    <section class="section-padding mt-25">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Популярные</span> Категории</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                <?php
                $stmt = $categories->read();

                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_category);
                    echo "<div class='product-cart-wrap small'>
                        <div class='product-img-action-wrap'>
                            <div class='product-img product-img-zoom'>
                                <a href='product-detail.php?id_category={$id_category}'>
                                    <img class='default-img' src='{$photo}' alt=''>
                                </a>
                            </div>
                        </div>
                        <div class='product-content-wrap'>
                            <h2><a href='product-detail.php?id_category={$id_category}'>{$title_category}</a></h2>
                        </div>
                    </div>";
                }
                ?>

                </div>
            </div>
        </div>
    </section>
    <section class="section-padding mt-25">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Наши</span> Специалисты</h3>
            <div class="row product-grid-4">
                
                <?php
                $list = $doctors->displayCards(8);

                foreach ($list as $row ) {
                    // extract($row);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="doctor-details.php?id_doctor=<?=$row['id_doctor']?>">
                                    <img class="default-img" src="libs/imgs/doctors/doctor-<?=$row['id_doctor']?>.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <h2><a href="doctor-details.php?id_doctor=<?=$row['id_doctor']?>"><?= $row['doctor_lastname'].' '.$row['doctor_name']. ' '.$row['doctor_secondname']?></a></h2>
                            <?php
                            $reviewStar = $reviews->reviewStar($row['id_doctor']);
                        // print_r($reviewStar);

                        if ($reviewStar) {
                            $rate = ($reviewStar['AVG(review_star)']*20);
                            $num = ($reviewStar['AVG(review_star)']*1);
                            // print_r($rate);
                            $output = '';
                            $output .= '
                            <div class="product-rate-cover text-start">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width:'.$rate.'%"></div>  
                                </div>
                                <span class="font-small ml-5 text-muted">
                                    '.$num.' звезд
                                </span>
                            </div>
                            ';  
                            echo($output);
                        }
                        ?>
                            <!-- <div class="rating-result" title="90%">
                                <span>
                                    <span>5,5</span>
                                </span>
                            </div> -->
                            <div>
                                <span>Специальность: <?= $row['title_category'] ?></span>
                            </div>
                            <div>
                                <span>Тип: <?= $row['type'] ?> врач</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
                ?>
                
            </div>
        </div>
    </section>

    


</main>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    // $(document).ready(function () {
    
    //     // displayCategories();
    //     //Display Categories value Navigation
    //     navCategories();
    //     function navCategories() {
    //         $.ajax({
    //             url: 'ajax/main-data.php',
    //             method: 'post',
    //             data: { action: 'card_categories' },
    //             success: function(response) {
    //                 console.log(response);
    //                 // $("#carausel-6-columns-2").html(response);
    //             }
    //         })
    //     }
    // })
    

</script>

<?php // подвал
require_once "layout/layout_footer.php";
?>
