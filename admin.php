<?php
// подключим файлы, необходимые для подключения к базе данных и файлы с объектами
include_once "config/database.php";
include_once "objects/user.php";
include_once "objects/service.php";
include_once "objects/session.php";
include_once "objects/category.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

$users = new Users($db);
$category = new Categories($db);

$page_title = "Панель Администратора";


require_once "layout/layout_header.php";
?>

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="home.php" rel="nofollow">Главная</a>
                <span></span> <?php echo($page_title); ?>
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-15">
                        <h3>Создание категории</h3>
                    </div>
                    <form method="post" action="#" id="create-category-form">
                        <div>
                            <div id="regAlert"></div>
                        </div>
                        <div class="form-group">
                            <label for="title_category">Название категории</label>
                            <input type="text" name="title_category" id="title_category"
                                placeholder="Название категории" required>
                        </div>
                        <div class="form-group">
                            <label for="desc_category">Описание категории</label>
                            <input type="text" name="desc_category" id="desc_category" placeholder="Описание категории"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="image">Фото</label>
                            <input type="file" name="image" id="imageFile">
                        </div>
                        <button type="submit" class="btn" id="create-cat-btn" name="create-cat-btn" value="submit">Создать категорию</button>
                        <p class="error" id="err"></p>
                        <div>
                            <div id="Error"></div>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-9">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Ваши категории</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Категория</th>
                                        <th>Описание</th>
                                    </tr>
                                </thead>
                                <tbody id="showTableCat">
                                    <!-- <tr>
                                        <td class="image product-thumbnail"><img src="libs/imgs/categories/1.jpg" alt="#"></td>
                                        <td>
                                            <h5><a href="product-details.html">Yidarton Women Summer Blue</a></h5> <span class="product-qty">x 2</span>
                                        </td>
                                        <td>$180.00</td>
                                    </tr>
                                    <tr>
                                        <td class="image product-thumbnail"><img src="assets/imgs/shop/product-2-1.jpg" alt="#"></td>
                                        <td>
                                            <h5><a href="product-details.html">LDB MOON Women Summe</a></h5> <span class="product-qty">x 1</span>
                                        </td>
                                        <td>$65.00</td>
                                    </tr>
                                    <tr>
                                        <td class="image product-thumbnail"><img src="assets/imgs/shop/product-3-1.jpg" alt="#"></td>
                                        <td><i class="ti-check-box font-small text-muted mr-10"></i>
                                            <h5><a href="product-details.html">Women's Short Sleeve Loose</a></h5> <span class="product-qty">x 1</span>
                                        </td>
                                        <td>$35.00</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-md-3">
                    <div class="mb-15">
                        <h3>Создание услуги</h3>
                    </div>
                    <form method="post" action="#" id="create-service-form">
                        <div>
                            <div id="servAlert"></div>
                        </div>
                        <div class="form-group">
                            <label for="title_service">Название услуги</label>
                            <input type="text" name="title_service" id="title_service"
                                placeholder="Название услуги" required>
                        </div>
                        <div class="form-group">
                            <label for="desc_service">Описание услуги</label>
                            <input type="text" name="desc_service" id="desc_service" placeholder="Описание категории"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="price">Цена услуги</label>
                            <input type="number" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <div class="custom_select" id="showCategory">
                            </div>
                        </div>
                        <button type="submit" class="btn" id="create-serv-btn" name="create-serv-btn" value="submit">Создать Услугу</button>
                        <p class="error" id="err"></p>
                        <div>
                            <div id="Error"></div>
                        </div>
                    </form>
                </div>
                <div class="col-md-9">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Все услуги</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Услуга</th>
                                        <th>Описание</th>
                                        <th>Цена</th>
                                        <th>Категория</th>
                                    </tr>
                                </thead>
                                <tbody id="showTableServ">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-md-3">
                    <div class="mb-15">
                        <h3>Добавление врача</h3>
                    </div>
                    <form method="post" action="#" id="create-doctor">
                        <div>
                            <div id="docAlert"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Имя врача</label>
                            <input type="text" name="name" id="name"
                                placeholder="Георгий" required>
                        </div>
                        <div class="form-group">
                            <label for="last">Фамилия врача</label>
                            <input type="text" name="last" id="last" placeholder="Петров"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="second">Отчество врача</label>
                            <input type="text" name="second" id="second" placeholder="Генадьевич">
                        </div>
                        <div class="form-group">
                            <div class="custom_select" id="showCategory2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login">Логин врача</label>
                            <input type="text" name="login" id="login" placeholder="Логин">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль врача</label>
                            <input type="text" name="password" id="password" placeholder="Пароль">
                        </div>
                        <button type="submit" class="btn" id="create-doctor-btn" name="create-doctor-btn" value="submit">Добавить врача</button>
                        <p class="error" id="err"></p>
                        <div>
                            <div id="Error"></div>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-9">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Все врачи</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ФИО</th>
                                        <th>Логин</th>
                                        <th>Категория</th>
                                    </tr>
                                </thead>
                                <tbody id="showTableDoc">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>




<?php
require_once "layout/layout_footer.php";
?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //Add Category
        $('#create-cat-btn').on("click", function (e) {
            if ($("#create-category-form")[0].checkValidity()) {
                e.preventDefault();

                function validateForm() {
                    let isValid = true;
                    return isValid;
                }

                if (validateForm()) {
                    $("#Error").text('');

                    let title = $("#title_category").val();
                    let description = $("#desc_category").val();
                    let image = $("#imageFile")[0].files[0]; // Access the file object using the files property
                    let fileName = image.name;
                    console.log("Имя файла:", fileName);

                    // Obtain the filename
                    // let fileName = image.name; // This will give you the filename

                    $.ajax({
                        url: 'ajax/admin-data.php',
                        method: 'post',
                        data: $("#create-category-form").serialize() + '&fileName='+fileName + '&action=createcateg' ,
                        success: function (response) {
                            
                            $("#regAlert").html(response);
                            console.log(response);
                            // Очистка формы
                            $("#create-category-form")[0].reset();
                            displayCategories();
                            
                        },
                        error: function (xhr, status, error) {
                            console.log("Status: " + status);
                            console.log("Error: " + error);
                        }
                    })
                } else {
                    $("#Error").text('Исправьте ошибки для продолжения!!!');
                }
            }
        })

        displayCategories();
        //Display Categories value #
        function displayCategories() {
            $.ajax({
                url: 'ajax/admin-data.php',
                method: 'post',
                data: { action: 'display_categories' },
                success: function(response) {
                    // console.log(response);
                    $("#showCategory").html(response);
                    $("#showCategory2").html(response);
                }
            })
        }

        displayTableCat();
        function displayTableCat() {
            $.ajax({
                url: 'ajax/admin-data.php',
                method: 'post',
                data: { action: 'display_tableCat' },
                success: function(response) {
                    // console.log(response);
                    $("#showTableCat").html(response);
                }
            })
        }
        displayTableServ();
        function displayTableServ() {
            $.ajax({
                url: 'ajax/admin-data.php',
                method: 'post',
                data: { action: 'display_tableServ' },
                success: function(response) {
                    // console.log(response);
                    $("#showTableServ").html(response);
                }
            })
        }
        
        displayTableDoct();
        function displayTableDoct() {
            $.ajax({
                url: 'ajax/admin-data.php',
                method: 'post',
                data: { action: 'display_tableDoctors' },
                success: function(response) {
                    // console.log(response);
                    $("#showTableDoc").html(response);
                }
            })
        }

        //Add Service
        $('#create-serv-btn').on("click", function (e) {
            if ($("#create-service-form")[0].checkValidity()) {
                e.preventDefault();

                function validateForm() {
                    let isValid = true;
                    return isValid;
                }

                if (validateForm()) {
                    $("#Error").text('');

                    let title = $("#title_service").val();
                    let description = $("#desc_service").val();
                    let price = $("#price").val(); // Access the file object using the files property
                    let id_category = $("#id_category").val();

                    // Obtain the filename
                    // let fileName = image.name; // This will give you the filename

                    $.ajax({
                        url: 'ajax/admin-data.php',
                        method: 'post',
                        data: $("#create-service-form").serialize() + '&action=createservice',
                        success: function (response) {
                            //$("#err").html(data);
                            // console.log(response);
                            
                            $("#servAlert").html(response);
                            // console.log(response);
                            // Очистка формы
                            $("#create-service-form")[0].reset();
                            displayTableServ();
                            
                        },
                        error: function (xhr, status, error) {
                            console.log("Status: " + status);
                            console.log("Error: " + error);
                        }
                    })
                } else {
                    $("#Error").text('Исправьте ошибки для продолжения!!!');
                }
            }
        })


        //Add Doctor
        $('#create-doctor-btn').on("click", function (e) {
            if ($("#create-doctor")[0].checkValidity()) {
                e.preventDefault();

                function validateForm() {
                    let isValid = true;
                    return isValid;
                }

                if (validateForm()) {
                    $("#Error").text('');

                    let name = $("#name").val();
                    let last = $("#last").val();
                    let second = $("#second").val(); // Access the file object using the files property
                    let id_category = $("#id_category").val();
                    let login = $("#login").val();
                    let password = $("#password").val();


                    $.ajax({
                        url: 'ajax/admin-data.php',
                        method: 'post',
                        data: $("#create-doctor").serialize() + '&action=createdoctor',
                        success: function (response) {
                            
                            $("#docAlert").html(response);
                            console.log(response);
                            // Очистка формы
                            $("#create-doctor")[0].reset();
                            displayTableDoct();
                            
                        },
                        error: function (xhr, status, error) {
                            console.log("Status: " + status);
                            console.log("Error: " + error);
                        }
                    })
                } else {
                    $("#Error").text('Исправьте ошибки для продолжения!!!');
                }
            }
        })
    })
</script>