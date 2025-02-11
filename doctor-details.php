<?php
require_once "objects/session.php";
include_once "config/database.php";
include_once "objects/user.php";
include_once "objects/category.php";
include_once "objects/doctor.php";
include_once "objects/review.php";
$database = new Database();
$db = $database->getConnection();
$users = new Users($db);
$doctors = new Doctor($db);
$categories = new Categories($db);
$reviews = new Review($db);

$page_title = "Доктор";

require_once "layout/layout_header.php";
?>

<main class="main">
    <?php
        $path = $_SERVER['REQUEST_URI'];
        function getParamFromUrl($url, $paramName) {
            $parts = parse_url($url);
            parse_str($parts['query'], $query);
            if (array_key_exists($paramName, $query)) {
                return $query[$paramName];
            } else {
                return null;
            }
        }

        $index = getParamFromUrl($path, 'id_doctor');
        // print_r($index);

        $list = $doctors->displayInfo($index);
        // print_r($list);
        if($list) {
                ?>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="home.php" rel="nofollow">Главная</a>
                    <span></span>
                    <a href="doctors.php">Доктора</a>
                    <span></span> <?= $list['doctor_lastname'].' '.$list['doctor_name'].' '.$list['doctor_secondname']; ?>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider border-radius-40">
                                            <!-- <figure class="border-radius-40"> -->
                                                <img src="libs/imgs/doctors/doctor-<?=$list['id_doctor']?>.png" alt="product image" style="border-radius: 10px">
                                            <!-- </figure> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail"><?= $list['doctor_lastname'].' '.$list['doctor_name'].' '.$list['doctor_secondname']; ?></h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <p> Cпециальность: <a href="#"><?= $list['title_category'] ?></a></p>
                                            </div>
                                            <div class="product-rate-cover text-start">
                                                <div class="product-rate d-inline-block">
                                                    <?php 
                                                        $reviewStar = $reviews->reviewStar($index);
                                                        // print_r($reviewStar);

                                                        if ($reviewStar) {
                                                            $rate = ($reviewStar['AVG(review_star)']*20);
                                                            $output = '
                                                            <div class="product-rating" style="width:'.$rate.'%"></div>
                                                            ';  
                                                            echo($output);
                                                        }
                                                        

                                                    ?>
                                                    <!--<div class="product-rating" style="width:'.$row['AVG(review_star)'].'%"></div> -->
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                Отзывов: (
                                                <?php
                                                    $listNum = $reviews->displayNumReview($index);
                                                    
                                                    foreach($listNum as $row) {
                                                        echo $row['COUNT(*)'];
                                                    }
                                                ?>
                                                )
                                                </span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <!--  -->
                                            <p> Cтаж: <a href="#"><?= $list['experience']; ?></a> лет</p>
                                            <p> Прием: <a href="#"><?= $list['type']; ?></a> врач</p>
                                            <p> Категория: <a href="#"><?= $list['work_category']; ?></a> категория</p>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <!-- <div class="short-desc mb-30">
                                            <div class="product-price primary-color float-left">
                                                <h3>Свободные талоны:</h3>
                                                <div class="container-appoint">
                                                    <div class="free-appointment">14:00</div>
                                                    <div class="free-appointment">15:00</div>
                                                    <div class="free-appointment">14:00</div>
                                                    <div class="free-appointment"></div>
                                                    <div class="free-appointment"></div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="bt-1 border-color-1 mt-30 mb-30"></div> -->
                                        <div class="detail-extralink">
                                            
                                                <a  class="btn" href="checkin.php?id_doctor=<?= $index; ?>">Записаться на прием</a>

                                        </div>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Отзывы</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Description-tab" data-bs-toggle="tab" href="#Description">Подробная информация</a>
                                    </li>
                                    
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">Отзывы пациетов</h4>
                                                    <div class="comment-list">
                                                        <?php
                                                            $listReview = $reviews->doctorReview($index);
                                                            
                                                            if($listReview) {
                                                                $output = '';

                                                                foreach($listReview as $row) {
                                                                    $output .= '
                                                                    <div class="single-comment justify-content-between d-flex">
                                                                        <div class="user justify-space-between d-flex">
                                                                            <div class="desc">
                                                                                <p><a href="#">'.$row['last_name'].' '.$row['name'].'</a></p>
                                                                                <span>'.$row['text_review'].'</span>
                                                                            </div>
                                                                            <div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width:'.($row['review_star']*20).'%"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    ';
                                                                }
                                                                echo($output);

                                                            }
                                                            
                                                        ?>
                                                        
                                                    </div>
                                                </div>
                                                <!-- <div class="col-lg-4">
                                                    <h4 class="mb-30">Customer reviews</h4>
                                                    <div class="d-flex mb-30">
                                                        <div class="product-rate d-inline-block mr-15">
                                                            <div class="product-rating" style="width:90%">
                                                            </div>
                                                        </div>
                                                        <h6>4.8 out of 5</h6>
                                                    </div>
                                                    <div class="progress">
                                                        <span>5 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>4 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>3 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>2 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                    </div>
                                                    <div class="progress mb-30">
                                                        <span>1 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                    </div>
                                                    <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Description">
                                        <div class="">
                                            <p>Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop
                                                tightly neurotic hungrily some and dear furiously this apart.</p>
                                            <p>Spluttered narrowly yikes left moth in yikes bowed this that grizzly much hello on spoon-fed that alas rethought much decently richly and wow against the frequent fluidly at formidable acceptably flapped
                                                besides and much circa far over the bucolically hey precarious goldfinch mastodon goodness gnashed a jellyfish and one however because.
                                            </p>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                                                       
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Категории</h5>
                            <ul class="categories"> 
                            <?php
                                $stmt = $categories->read();

                                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($row_category);
                                echo "
                                <li><a href='product-detail.php?id_category={$id_category}'>{$title_category}</a></li>
                                ";                                          
                                }
                            ?>
                            </ul>
                        </div>                        
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
        
    </main>

<?php
require_once "layout/layout_footer.php";
?>

<?php
$stmt = $categories->read();

while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
extract($row_category);
echo "
<li><a href='product-detail.php?id_category={$id_category}'>{$title_category}</a></li>
";                                          
}
?>                                                                                                              