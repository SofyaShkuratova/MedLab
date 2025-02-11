<?php
require_once "objects/session.php";

// print_r($data);

// print_r($userId);
// подключим файлы, необходимые для подключения к базе данных и файлы с объектами
include_once "config/database.php";
include_once "objects/user.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

$users = new Users($db);

$page_title = "Запись на прием";

require_once "layout/layout_header.php";
?>


<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Главная</a>
                <span></span> Запись на прием <?php if(isset($_GET['id_doctor'])) { echo "Врач есть";} else {echo "Врача нет";} ?>
            </div>
        </div>
    </div>
    <section class="pt-50 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-5">
                                <div
                                class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Запись на прием</h3>
                                    </div>

                                    <?php 
                                    if(!isset($_SESSION['user'])) {
                                        echo '
                                        <h5>Вы не авторизированы! <br> Войдите или зарегистрируйтесь!</h5>
                                        ';
                                    } else {
                                        $userId = $data['id_user'];
                                        echo '
                                        <form method="post" id="reservation-form">
                                            <div class="form-group">
                                                <div class="custom_select" id="showCategory">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom_select" id="showDoctor">

                                                </div>
                                            </div>

                                            <div id="displayTimeTable"></div>

                                            <div class="form-group">
                                                <div id="showDate">
                                                    <!-- <label for="start">Выберите дату</label>
                                                    <input type="date" id="start" name="trip-start" placeholder="Выберите дату" value="2018-07-22" min="2018-01-01" max="2018-12-31" /> -->
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" id="reservation-btn" class="btn btn-fill-out btn-block hover-up" name="reservation-btn">Записаться</button>
                                            </div>
                                        </form>
                                    ';
                                    }

                                    ?>

                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-6">
                            <img style="border-radius:10px" src="libs/imgs/login.jpg">
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
    // Объявляем глобальные переменные
    let category_Id;
    let doctorId;
    category_Id = "<?php if(isset($_GET['id_category'])) { echo $_GET['id_category'];} else {echo "пусто";} ?>";;
    doctorId = "<?php if(isset($_GET['id_doctor'])) { echo $_GET['id_doctor'];} else {echo "пусто";} ?>";

    console.log(category_Id);
    console.log(doctorId);
    // var categoryValue;

    if(doctorId == "пусто" && category_Id == "пусто") {
        displayCategories();
        // console.log("Никто не выбран");
    } else if(category_Id == "пусто") {
        console.log("Врач уже есть");
        showCategoryAndDoctor(doctorId);
        DoctorInputShow(doctorId);
        DisplayTimeTableByDoctor(doctorId)
    } else if(doctorId == "пусто")  {
        console.log("Категория уже есть");
        showCategory(category_Id);
        displayDoctors(category_Id);
    }

    function showCategoryAndDoctor(id_doctor) {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'show_CategoryDoctor', id_doctor: id_doctor},
            success: function(response) {
                // console.log(response);
                $("#showCategory").html(response);
            }
        })
    }
    function DoctorInputShow(id_doctor) {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'show_DoctorInput' , id_doctor: id_doctor},
            success: function(response) {
                $("#showDoctor").html(response);
            }
        })
    }
    function DisplayTimeTableByDoctor(id_doctor) {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'display_timetableByDoctor', id_doctor: id_doctor},
            success: function(response) {
                console.log(response);
                $("#displayTimeTable").html(response);
            }
        })
    }
    
    function showCategory(id_category) {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'show_Category', category_id:  id_category},
            success: function(response) {
                console.log(response);
                $("#showCategory").html(response);
            }
        })
    }   

    // displayCategories();

    function displayCategories() {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'display_categories' },
            success: function(response) {
                console.log(response);
                $("#showCategory").html(response);
            }
        })
    }
    
    $(document).on("change", "#id_category", function(e) {
        category_Id = $(this).val();
        console.log("Изменяется категория" + category_Id);
        displayDoctors(category_Id);
        $("#displayTimeTable").html('');
    });
    
    function displayDoctors(categoryId) {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'display_doctors', category_id: categoryId },
            success: function(response) {
                console.log(response);
                // $("#showDoctor").html(response);
            }
        })
    }
    
    $(document).on("change", "#id_doctor", function(e) {
        doctorId = $(this).val();
        category_Id = $("#id_category").val();
        console.log("А категория осталась: "+category_Id);
        console.log("Изменяется доктор: "+doctorId);
        displayDoctors(category_Id);
        displayTimetable(category_Id, doctorId);
    });  
    
    function displayTimetable(categoryId, doctorId) {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'display_timetable', id_category: categoryId, id_doctor: doctorId},
            success: function(response) {
                // console.log(response);
                $("#displayTimeTable").html(response);
            }
        })
    }

    $(document).on("change", "#date_value", function(e) {
        dateValue = $(this).val();
        console.log(dateValue);
        if (dateValue == '') {
            displayTimetable(category_Id, doctorId);
            console.log(dateValue);
        } else {
            filterDate(dateValue, category_Id, doctorId);
            console.log(dateValue);
        }
    });

    function filterDate(dateValue, categoryId, doctorId) {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'filter_timetable', id_category: categoryId, id_doctor: doctorId, date_work: dateValue},
            success: function(response) {
                // console.log(response);
                $("#displayTimeTable").html(response);
            }
        })
    }

    let id_categorydoctor;
    let id_user = <?php echo $userId?>;

    $(document).on("click", ".box-time", function(e) {
        // Убираем подсветку со всех карточек
        $(".box-time").removeClass("highlighted");
        // Добавляем подсветку только к текущей карточке
        $(this).addClass("highlighted");

        id_categorydoctor = $(this).attr("id").split("-")[1];

        console.log("Значение id: " + id_categorydoctor);
        // let id_user = 
        console.log("Значение User: " + id_user);
    });

    $(document).on("click", "#reservation-btn", function(e) {
        if($("#reservation-form")[0].checkValidity()) {
            e.preventDefault();

            //валидация данных!!!
            insertData(id_user, id_categorydoctor);
        }
    });

    function insertData(userID, categorydoctorId) {
        $.ajax({
            url: 'ajax/admin-data.php',
            method: 'post',
            data: { action: 'insert_reserve', id_user: userID, id_doctorcategory: categorydoctorId},
            success: function(response) {
                console.log(response);
                $("#reservation-form").html(response);
            }
        })
    }


</script>