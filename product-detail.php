<?php
$page_title = "Категория";

$id = $_GET['id_category'];

include_once "config/database.php";
$database = new Database();
$db = $database->getConnection();

include_once "objects/user.php";
$users = new Users($db);

include_once "objects/category.php";
include_once "objects/service.php";

$categories = new Categories($db);
$services = new Service($db);

require_once "layout/layout_header.php";
?>

<main class="main">
<?php
    $path = $_SERVER['REQUEST_URI'];
    // function getParamFromUrl($url, $paramName)
    // {
    //     $parts = parse_url($url);
    //     parse_str($parts['query'], $query);
    //     if (array_key_exists($paramName, $query)) {
    //         return $query[$paramName];
    //     } else {
    //         return null;
    //     }
    // }

    // $index = getParamFromUrl($path, 'id_category');
    // print_r($index);

    $list = $categories->diplayInfoCategory($id);
    // print_r($list);
    if ($list) {        
        ?>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="home.php" rel="nofollow">Главная</a>
                    <span></span> <?= $list['title_category'] ?>
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
                                        <div  class="border-radius-40">
                                            <figure class="border-radius-40">
                                                <img src="libs/imgs/categories/<?=$list['id_category']?>.png" alt="product image" style="border-radius: 10px">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail"><?=$list['title_category']?></h2>
                                        <div class="product-detail-rating">
                                            
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <p><?=$list['description_category']?></p>
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
                                            
                                        <a  class="btn" href="checkin.php?id_category=<?= $list['id_category']; ?>">Записаться на прием</a>
                                            
                                        </div>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>       
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Услуги</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Description-tab" data-bs-toggle="tab" href="#Description">Подробная информация</a>
                                    </li>
                                    
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Reviews">
                                        <table>
                                            <tr>
                                                <th><p>Услуга</p></th>
                                                <th><p>Описание</p></th>
                                                <th><p>Цена</p></th>
                                            </tr>
                                            
                                            <?php
                                                $stmt = $services->showServices($id);
                                                $output = '';
                                                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    extract($row_category);
                                                    $output .= "
                                                        <tr>
                                                            <td><p>{$title_service}</p></td>
                                                            <td><p>{$description_service}</p></td>
                                                            <td><p>{$price}</p></td>
                                                        </tr>
                                                    ";
                                                }
                                                echo($output);
                                            ?>
                                            
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="Description">
                                        <div class="">
                                            <p>
                                                Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop
                                                tightly neurotic hungrily some and dear furiously this apart.
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
                <?php
        }
    
    ?>
        
    </main>






<?php
require_once "layout/layout_footer.php";
?>

<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        displayServices();

        function displayServices() {
            $.ajax({
                url: 'ajax/main-data.php',
                method: 'post',
                data: { action: 'display_services' },
                success: function(response) {
                    console.log(response);
                    // $("#Services").html(response);
                }
            })
        }
    });
</script> -->

