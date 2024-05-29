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
    <section class="pt-50 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                            href="#dashboard" role="tab" aria-controls="dashboard"
                                            aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Создание категории</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                            role="tab" aria-controls="orders" aria-selected="false"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Создание услуги</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                        </li> -->
                                    <!-- <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link " id="account-detail-tab" data-bs-toggle="tab"
                                            href="#account-detail" role="tab" aria-controls="account-detail"
                                            aria-selected="true"><i class="fi-rs-user mr-10"></i>Создание врача</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php"><i class="fi-rs-sign-out mr-10"></i>Выйти
                                            из аккаунта</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content dashboard-content">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Создание категории</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="#" id="create-category-form">
                                                <div class="row">
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="title_category">Название категории</label>
                                                        <input type="text" name="title_category" id="title_category"
                                                            placeholder="Название категории" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="desc_category">Описание категории</label>
                                                        <input type="text" name="desc_category" id="desc_category" placeholder="Описание категории"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="image">Фото</label>
                                                        <input type="file" name="image" id="imageFile">
                                                    </div>
                                                    <div>
                                                        <p class="error" id="err"></p>
                                                        <div id="Error"></div>
                                                        <div id="categAlert"></div>
                                                    </div>
                                                    <div class="col-md-12 mt-20">
                                                        <button type="submit" class="btn" id="create-cat-btn" name="create-cat-btn" value="submit">Создать категорию</button>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card mt-20">
                                        <div class="card-header">
                                            <h5>Все категории</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive order_table text-center">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">Категория</th>
                                                            <th>Описание</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="showTableCat">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Создание услуги</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="#" id="create-service-form">
                                                <div class="row">
                                                    <div>
                                                        <div id="servAlert"></div>
                                                        <p class="error" id="err"></p>
                                                        <div>
                                                            <div id="Error"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="title_service">Название услуги</label>
                                                        <input type="text" name="title_service" id="title_service"
                                                            placeholder="Название услуги" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="desc_service">Описание услуги</label>
                                                        <input type="text" name="desc_service" id="desc_service" placeholder="Описание категории"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="price">Цена услуги</label>
                                                        <input type="number" name="price" id="price">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Выберите категорию</label>
                                                        <div class="custom_select" id="showCategory"></div>
                                                    </div>
                                                    <div class="col-md-12 mt-20">
                                                        <button type="submit" class="btn" id="create-serv-btn" name="create-serv-btn" value="submit">Создать Услугу</button>
                                                    </div>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                    <div class="card mt-20">
                                        <div class="card-header">
                                            <h5>Все услуги</h5>
                                        </div>
                                        <div class="card-body">
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
                                
                                <div class="tab-pane fade " id="account-detail" role="tabpanel"
                                    aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Создание врача</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="error" id="err"></p>
                                            <div>
                                                <div id="Error"></div>
                                            </div>
                                            
                                            <div id="docAlert"></div>
                                            
                                            <form method="post" action="#" id="create-doctor">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="name">Имя врача</label>
                                                        <input type="text" name="name" id="name"
                                                            placeholder="Георгий" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="last">Фамилия врача</label>
                                                        <input type="text" name="last" id="last" placeholder="Петров"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="second">Отчество врача</label>
                                                        <input type="text" name="second" id="second" placeholder="Генадьевич">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="second">Категория врача</label>
                                                        <div class="custom_select" id="showCategory2"></div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="login">Логин врача</label>
                                                        <input type="text" name="login" id="login" placeholder="Логин">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="password">Пароль врача</label>
                                                        <input type="text" name="password" id="password" placeholder="Пароль">
                                                    </div>
                                                    <div class="col-md-12 mt-20">
                                                        <button type="submit" class="btn" id="create-doctor-btn" name="create-doctor-btn" value="submit">Добавить врача</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card mt-20">
                                        <div class="card-header">
                                            <h5>Все врачи</h5>
                                        </div>
                                        <div class="card-body">
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
                        </div>
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
                            $("#categAlert").html(response);
                            console.log(response);

                            // Очистка формы
                            $("#create-category-form")[0].reset();
                            displayCategories();
                            displayTableCat();
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
                data: { action: 'display_category' },
                success: function(response) {
                    console.log(response);
                    $("#showCategory").html(response);
                    $("#showCategory2").html(response);
                }
            })
        }
        displayCategories1();
        function displayCategories1() {
            $.ajax({
                url: 'ajax/admin-data.php',
                method: 'post',
                data: { action: 'display_category1' },
                success: function(response) {
                    console.log(response);
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

                    $.ajax({
                        url: 'ajax/admin-data.php',
                        method: 'post',
                        data: {action: "createservice", title: title, description: description, price:price, id_category:id_category},
                        success: function (response) {
                            $("#servAlert").html(response);
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
                    let id_category_doc = $("#id_category1").val();
                    let login = $("#login").val();
                    let password = $("#password").val();


                    $.ajax({
                        url: 'ajax/admin-data.php',
                        method: 'post',
                        data: 
                        { action: "createdoctor",
                                name: name,
                                last: last,
                                second: second,
                                id_category:id_category_doc,
                                login: login,
                                password: password
                        },
                        
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