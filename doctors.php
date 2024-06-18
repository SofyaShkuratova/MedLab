<?php
require_once "objects/session.php";
include_once "config/database.php";
include_once "objects/user.php";
include_once "objects/category.php";
include_once "objects/doctor.php";
$database = new Database();
$db = $database->getConnection();
$users = new Users($db);
$doctors = new Doctor($db);
$page_title = "Врачи";
require_once "layout/layout_header.php";
?>

<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="home.php" rel="nofollow">Главная</a>
                    <span></span> <?= $page_title  ?>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> Мы нашли <strong class="text-brand">специалистов</strong>  для вас!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Показать:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap number-wrap">
                                            <span> 3 </span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="num-card" href="#">3</a></li>
                                            <li><a class="num-card" href="#">6</a></li>
                                            <li><a class="num-card" href="#">10</a></li>
                                            <li><a class="num-card" href="#">20</a></li>
                                            <!-- <li><a class="num-card" href="#">Все</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>По:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap number-wrap-cort">
                                            <span> Убыванию</span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="sort-by-card" href="#">Убыванию</a></li>
                                            <li><a class="sort-by-card" href="#">Возрастанию</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3" id="displayCardContainer">
                        </div>
                        
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Категории</h5>
                            <ul class="categories" id="showCategories">
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>

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
                    // console.log(response);
                    $("#showCategories").html(response);
                }
            })
        }
    });

    
    // displayCards(selectedNumber);
    let selectedNumber = 3;
    let sortbyValue = 'DESC';
    //если какая-то из сортировок активна
    $('.sort-by-product-area').on('click', function(event) {
        event.preventDefault(); // Отменяем переход по ссылке

        $('.num-card').on('click', function(event) {
            event.preventDefault(); // Отменяем переход по ссылке

            selectedNumber = $(this).text();
            // console.log('Выбрано число:', selectedNumber);
            
            // Обновляем текст внутри span
            $('.number-wrap span').text(selectedNumber); 
            // console.log('Сортировка:', selectedNumber, 'и', sortbyValue);           
        });


        $('.sort-by-card').on('click', function(event) {
            event.preventDefault();

            sortbyValue = $(this).text();
            // console.log('По:', sortbyValue);

            $('.number-wrap-cort span').text(sortbyValue);

            if (sortbyValue === "Возрастанию") {
                sortbyValue = "ASC";
                // console.log(sortbyValue);
                // console.log('Сортировка:', selectedNumber, 'и', sortbyValue);
                // sortBy(sortbyValue);
            } else if (sortbyValue === "Убыванию") {
                sortbyValue = "DESC";
                // console.log(sortbyValue);
                
                // sortBy(sortbyValue);
            } else {
                console.log("Не сработало");
            }
        });

        DisplayCardBy(selectedNumber, sortbyValue);
        // console.log('Сортировка:', selectedNumber, 'и', sortbyValue);
    });
    DisplayCardBy(selectedNumber, sortbyValue);
    // console.log('Сортировка:', selectedNumber, 'и', sortbyValue);


    function DisplayCardBy(number, value) {
        $.ajax({
                url: 'ajax/main-data.php',
                method: 'post',
                data: { action: 'display_cards', number_card: number, value: value },
                success: function(response) {
                    // console.log(response);
                    $("#displayCardContainer").html(response);
                }
        })
    }
    // function displayCards(number) {
    //     $.ajax({
    //             url: 'ajax/main-data.php',
    //             method: 'post',
    //             data: { action: 'display_cards', number_card: number },
    //             success: function(response) {
    //                 // console.log(response);
    //                 $("#displayCardContainer").html(response);
    //             }
    //     })
    // }

    // function sortBy(value) {
    //     $.ajax({
    //             url: 'ajax/main-data.php',
    //             method: 'post',
    //             data: { action: 'sort_cards', value: value },
    //             success: function(response) {
    //                 // console.log(response);
    //                 $("#displayCardContainer").html(response);
    //             }
    //     })
    // }
    </script>

<?php 
require_once "layout/layout_footer.php";
?>