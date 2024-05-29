<?php
require_once "objects/session.php";
include_once "config/database.php";
include_once "objects/user.php";
include_once "objects/category.php";
include_once "objects/doctor.php";
$database = new Database();
$db = $database->getConnection();

// print_r($data);
$page_title = "Кабинет врача";
require_once "layout/layout_header.php";
?>

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="home.php" rel="nofollow">Главная</a>
                <span></span> <?php print_r($page_title) ?>
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
                                            aria-selected="false"><i class="fi-rs-user mr-10"></i>Личные
                                            данные</a>
                                    </li>
                                    <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Изменить данные</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                            role="tab" aria-controls="orders" aria-selected="false"><i
                                                class="fi-rs-pharmacy mr-10"></i>Расписание</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link " id="account-detail-tab" data-bs-toggle="tab"
                                            href="#account-detail" role="tab" aria-controls="account-detail"
                                            aria-selected="true"><i class="fi fi-rs-archive mr-10"></i>Добавить запись</a>
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
                                            <h5 class="mb-0">Здравствуйте! </h5>
                                        </div>
                                        <div class="card-body">

                                            <p>Имя: <?php print_r($cname) ?> </p>
                                            <p>Фамилия: <?php print_r($clast_name) ?> </p>
                                            <p>Отчество: <?php print_r($csecond_name) ?> </p>
                                            <p>Логин: <?php print_r($clogin) ?> </p>
                                            <p>Пароль: <?php print_r($cemail) ?> </p>
                                            <p>Тип: <?php print_r($ctype) ?> врач</p>
                                            <p>Квалификационная категория: <?php print_r($cwork_category) ?> категория</p>
                                            <p>Стаж: <?php print_r($cexperience) ?> лет</p>
                                            <p>Описание: <?php 
                                            if(isset($cdescription_doctor)) {
                                              print_r($cdescription_doctor) ; 
                                            } else {
                                                print_r("Пока что пусто...");
                                            }
                                            ?></p>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Ваши записи</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Номер записи</th>
                                                            <th>Дата</th>
                                                            <th>Время</th>
                                                            <th>Статус</th>
                                                            <th>Отменить</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="DoctorTimetable">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="tab-pane fade " id="track-orders" role="tabpanel"
                                    aria-labelledby="track-orders-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Изменить логин</h5>
                                                </div>
                                                <form method="post" id="change-login">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Введите новый логин</label>
                                                            <input class="form-control square" name="login" id="login">
                                                            <div id="loginError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-login">Изменить логин</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Изменить пароль</h5>
                                                </div>
                                                <form method="post" id="change-pass">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Введите новый пароль</label>
                                                            <input class="form-control square" name="pass" id="pass">
                                                            <div id="passError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-pass">Изменить пароль</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Стаж работы</h5>
                                                </div>
                                                <form method="post" id="change-exper">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Введите стаж работы</label>
                                                            <input class="form-control square" name="exper" id="exper" type="number" value=<?php echo $cexperience ?>>
                                                            <div id="experError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-exper">Изменить опыт работы</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Описание</h5>
                                                </div>
                                                <form method="post" id="change-desc">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Описание врача</label>
                                                            <input class="form-control square" name="desc" id="desc" type="text" >
                                                            <div id="descError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-desc">Добавить</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Добавить квалификацию</h5>
                                                </div>
                                                <form method="post" id="change-wcateg">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Выберите квалификацию работы</label>
                                                            <div class="custom_select">
                                                                <select name="wcateg" id="wcateg" class="form-control">
                                                                    <option value="Первая">Первая</option>
                                                                    <option value="Вторая">Вторая</option>
                                                                    <option value="Высшая">Высшая</option>
                                                                </select>
                                                            </div>
                                                            <div id="wcategError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-wcateg">Изменить квалификацию</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Добавить тип врача</h5>
                                                </div>
                                                <form method="post" id="change-type">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Выберите тип врача</label>
                                                            <div class="custom_select">
                                                                <select name="type" id="type" class="form-control">
                                                                    <option value="Взрослый">Взрослый</option>
                                                                    <option value="Детский">Детский</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div id="typeError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-type">Изменить тип</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card mb-20">
                                        <div class="card-header">
                                            <h5>Добавить запись в расписание</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" name="enq" id="timetable-form">
                                                <div class="row">
                                                    <div class="form-group col-md-6 centered">
                                                        <input type="text" id="my-datepicker" class="mb-10">
                                                        <div class="SelectedDates"></div>
                                                    </div>
                                                    <div class="form-group col-md-6" id="">
                                                        <label for="FromTime">С</label>
                                                        <input type="text" id="f-timepicker" name="FromTime" class="mb-10">
                                                        <label for="ToTime">До</label>
                                                        <input type="text" id="s-timepicker" name="ToTime class="mb-10">
                                                        <div id="showAllTime"></div>
                                                        <div id="showSuccess"></div>
                                                    </div>
                                                </div > 
                                                    
                                                <div class="col-md-12 mt-20">
                                                    <button type="submit" class="btn btn-fill-out submit"
                                                        name="submit" value="Submit" id="add-timetable-btn">Добавить расписание</button>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card mt-20">
                                        <div class="card-header">
                                            <h5 class="mb-0">Полное расписание</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Номер записи</th>
                                                            <th>Дата</th>
                                                            <th>Время</th>
                                                            <th>Статус</th>
                                                            <th>Удалить</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="FullTimetable"></tbody>
                                                </table>
                                            </div>
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
<script src="node_modules/air-datepicker/air-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>

<script type="text/javascript">
    displayTable();
    function displayTable() {
        $.ajax({
            url: 'ajax/doctor-data.php',
            method: 'post',
            data: { action: 'display_doctortimetable'},
            success: function(response) {
                // console.log(response);
                $("#DoctorTimetable").html(response);
            }, 
            error: function(xhr, status, error) 
            {
            console.log(xhr);
            console.log("Error: " + error);
            }
        })
    };
    
    displayTimeTable();
    function displayTimeTable() {
        $.ajax({
            url: 'ajax/doctor-data.php',
            method: 'post',
            data: { action: 'display_timetable'},
            success: function(response) {
                // console.log(response);
                $("#FullTimetable").html(response);
            }, 
            error: function(xhr, status, error) 
            {
            console.log(xhr);
            console.log("Error: " + error);
            }
        })
    };

    let resultBlock;
    let block;

    new AirDatepicker("#my-datepicker", {
        inline: true,
        multipleDates: true,
        minDate: new Date(),
    });

    $(document).ready(function(){
        let id_doctor = <?php echo $cid?>;

        $('#add-timetable-btn').on("click", function(e){
            e.preventDefault();

            if($("#timetable-form")[0].checkValidity()) {
                let datesString =  $("#my-datepicker").val();
                // Определение массива дат
                let datesArray = datesString.split(", ");
                
                // Определите начальное и конечное время (в часах)
               let starttime = +$("#f-timepicker").val();
               let endtime = +$("#s-timepicker").val();
               //Интервал времени
               const hourInterval = 1;
                // Перебираем даты
                for (let i = 0; i < datesArray.length; i++) {
                    const currentDate = datesArray[i];
                    // Перебираем часы
                    for (let currentHour = starttime; currentHour < endtime; currentHour += hourInterval) {                     
                        console.log("Дата: " + currentDate + " Время: " + currentHour);
                        DateTime(currentDate, currentHour, id_doctor);
                        displayTimeTable();
                    }
                }
            }
        });

        let combinedResponses = "";

        function DateTime(date, time, id) {
            $.ajax({
                url:'ajax/doctor-data.php',
                method: 'post',
                data: { action: 'add_timetable', date: date, time: time, id: id },
                success: function(response) {
                    combinedResponses += response + '';

                    $("#showAllTime").html(combinedResponses);
                    $("#showSuccess").html('<div class="text-success error-div mt-5" ><strong>Записи добавлены!</strong><button class="close-btn text-success bg-success" >&times;</button></div>');
                    
                    // console.log(response);
                    displayTimeTable();

                    $("#timetable-form")[0].reset();
                    // document.querySelector("#my-datepicker").value = "";
                    
                }, 
                error: function(xhr, status, error) {
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                }
            });
        }

    });
    flatpickr("#f-timepicker", {
        // "locale": Russian
        "locale": "ru",
        enableTime: true,
        noCalendar: true,
        dateFormat: "H",
        time_24hr: true,
        minTime: "8:00",
        maxTime: "22:00"
    });
    flatpickr("#s-timepicker", {
        // "locale": Russian
        "locale": "ru",
        enableTime: true,
        noCalendar: true,
        dateFormat: "H",
        time_24hr: true,
        minTime: "8:00",
        maxTime: "22:00"
    });

    let clogin = "<?php echo $clogin ?>";
    console.log(clogin);

    $(document).on("click", "#btn-change-login", function(e) {
        if($("#change-login")[0].checkValidity()) {
            e.preventDefault();
            let login = $("#login").val();

            $.ajax({
                  url:'ajax/doctor-data.php',
                  method: 'post',
                  data: {action: "update_login", login: login},
                  success: function(response) {
                    $("#loginError").html(response);
                    console.log(response);
                  },
                  error: function(xhr, status, error){
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                  }
            });
        }
    });
    $(document).on("click", "#btn-change-pass", function(e) {
        if($("#change-pass")[0].checkValidity()) {
            e.preventDefault();

            function validateForm() {
                let isValid = true;

                let passwordRegex = /^(?=.*\d)(?=.*[a-zа-я])(?=.*[A-ZА-Я])[0-9a-zA-Zа-яА-Я]{8,}$/ ;
                if (!passwordRegex.test($("#pass").val()) ) {
                    $("#passError").text('* Пароль должен содержать минимум 8 символов, 1 маленькую букву, 1 большую букву и цифры');
                    $("#passError").addClass("text-danger");
                    $("#pass").addClass("border-danger bg-danger");
                    isValid = false;
                } else {
                    $("#passError").text('');
                    $("#passError").removeClass("text-danger");
                    $("#pass").removeClass("border-danger bg-danger");
                }
                return isValid ;
            }
            
            if (validateForm()) {
                $("#passError").text('');
                let pass = $("#pass").val();

                $.ajax({
                    url:'ajax/doctor-data.php',
                    method: 'post',
                    data: {action: "update_password", pass: pass},
                    success: function(response) {
                    $("#passError").html(response);
                    console.log(response);
                    },
                    error: function(xhr, status, error){
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                    }
                });
            }
        }
    });  
    $(document).on("click", "#btn-change-exper", function(e) {
        if($("#change-exper")[0].checkValidity()) {
            e.preventDefault();
            
            let exper = $("#exper").val();

            $.ajax({
                url:'ajax/doctor-data.php',
                method: 'post',
                data: {action: "update_exper", experience: exper},
                success: function(response) {
                $("#experError").html(response);
                console.log(response);
                },
                error: function(xhr, status, error){
                console.log("Status: " + status);
                console.log("Error: " + error);
                }
            });
        }
    });  
    $(document).on("click", "#btn-change-desc", function(e) {
        if($("#change-desc")[0].checkValidity()) {
            e.preventDefault();
            
            let desc = $("#desc").val();

            $.ajax({
                url:'ajax/doctor-data.php',
                method: 'post',
                data: {action: "update_desc", desc: desc},
                success: function(response) {
                $("#descError").html(response);
                console.log(response);
                },
                error: function(xhr, status, error){
                console.log("Status: " + status);
                console.log("Error: " + error);
                }
            });
        }
    });
    $(document).on("click", "#btn-change-wcateg", function(e) {
        if($("#change-wcateg")[0].checkValidity()) {
            e.preventDefault();
            
            let wcateg = $("#wcateg").val();
            // console.log(wcateg);
            $.ajax({
                url:'ajax/doctor-data.php',
                method: 'post',
                data: {action: "update_wcateg", wcateg: wcateg},
                success: function(response) {
                $("#wcategError").html(response);
                console.log(response);
                },
                error: function(xhr, status, error){
                console.log("Status: " + status);
                console.log("Error: " + error);
                }
            });
        }
    });
    $(document).on("click", "#btn-change-type", function(e) {
        if($("#change-type")[0].checkValidity()) {
            e.preventDefault();
            
            let type = $("#type").val();
            // console.log(wcateg);
            $.ajax({
                url:'ajax/doctor-data.php',
                method: 'post',
                data: {action: "update_type", type: type},
                success: function(response) {
                $("#typeError").html(response);
                console.log(response);
                },
                error: function(xhr, status, error){
                console.log("Status: " + status);
                console.log("Error: " + error);
                }
            });
        }
    });

    $(document).on("click", ".delete-row", function(e) {
        id_row = $(this).attr("id").split("-")[1];
        console.log("ID delete row:" + id_row);

        $.ajax({
                url:'ajax/doctor-data.php',
                method: 'post',
                data: {action: "delete_row", id_row: id_row},
                success: function(response) {
                    // $("#typeError").html(response);
                    console.log(response);
                    displayTimeTable();
                },
                error: function(xhr, status, error){
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                }
            });
    });
    $(document).on("click", ".cancel-row", function(e) {
        id_row = $(this).attr("id").split("-")[1];
        console.log("ID cancel row:" + id_row);

        $.ajax({
                url:'ajax/doctor-data.php',
                method: 'post',
                data: {action: "cancel_row", id_row: id_row},
                success: function(response) {
                    // $("#typeError").html(response);
                    console.log(response);
                    displayTimeTable();
                    displayTable();
                },
                error: function(xhr, status, error){
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                }
            });
    });


</script>

