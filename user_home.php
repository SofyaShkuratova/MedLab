<?php
require_once "objects/session.php";
include_once "config/database.php";
include_once "objects/user.php";
include_once "objects/category.php";
include_once "objects/doctor.php";
$database = new Database();
$db = $database->getConnection();

// print_r($data);
$page_title = "Личный кабинет";
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
                                            aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Личные
                                            данные</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                            role="tab" aria-controls="orders" aria-selected="false"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Записи на прием</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="account-detail-tab" data-bs-toggle="tab"
                                            href="#account-detail" role="tab" aria-controls="account-detail"
                                            aria-selected="true"><i class="fi-rs-user mr-10"></i>Изменить данные</a>
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
                                            <p>Номер телефона: <?php print_r($cphone) ?> </p>
                                            <p>Электронная почта: <?php print_r($cemail) ?> </p>
                                            <p>Возраст: <?php print_r($cage) ?> </p>
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
                                                            <th>Номер</th>
                                                            <th>Дата</th>
                                                            <th>Время</th>
                                                            <th>Статус</th>
                                                            <th>Категория</th>
                                                            <th>Врач</th>
                                                            <th>Отменить</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="UserTimetable"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-20 userReviewDoctor hide" id="userReviewDoctor">
                                        <div class="card-body">
                                        <form method="post" name="review-form" id="review-form">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="text-review">Напишите отзыв</label>
                                                    <input required class="form-control square" name="text-review" id="text-review"
                                                        type="text">
                                                    <div id="textreviewError"></div>
                                                </div>
                                                <div id="infoReview"></div>
                                                <div class="rate">
                                                    <div id="rateError"></div>
                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                
                                                
                                                <div class="col-md-12 ">
                                                    <button type="submit" class="btn submit" id="review-btnSubmit" name="review-btnSubmit"
                                                        value="Submit">Отправить отзыв</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                    <div class="card mt-20 userAnswer hide" id="userAnswer">
                                        <div class="card-body">
                                        <h5>Вы успешно оставили отзыв на специалиста!</h5>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade " id="account-detail" role="tabpanel"
                                    aria-labelledby="account-detail-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Изменить  номер / логин</h5>
                                                </div>
                                                <form method="post" id="change-phone">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Введите номер телефона</label>
                                                            <input class="form-control square" name="phone" id="phone">
                                                            <div id="phoneError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-phone">Изменить номер</button>
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
                                                    <h5 class="mb-0">Возраст</h5>
                                                </div>
                                                <form method="post" id="change-age">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Введите ваш возраст</label>
                                                            <input class="form-control square" name="age" id="age" type="number" >
                                                            <div id="ageError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-age">Изменить возраст</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Добавить / изменить отчество</h5>
                                                </div>
                                                <form method="post" id="change-sname">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Введите ваше отчество</label>
                                                            <input class="form-control square" name="sname" id="sname" type="text" >
                                                            <div id="snameError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-sname">Добавить</button>
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
                                                    <h5 class="mb-0"> Изменить фамилию</h5>
                                                </div>
                                                <form method="post" id="change-lname">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Введите фамилию</label>
                                                            <input class="form-control square" name="lname" id="lname" type="text" >
                                                            <div id="lnameError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-lname">Изменить фамилию</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Добавить / изменить почту</h5>
                                                </div>
                                                <form method="post" id="change-email">
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Введите почту</label>
                                                            <input class="form-control square" name="email" id="email" type="text" >
                                                            <div id="emailError"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit" id="btn-change-email">Добавить</button>
                                                        </div>
                                                    </div>
                                                </form>
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
<script type="text/javascript">
    
    
    displayTimeTable();
    function displayTimeTable() {
        $.ajax({
            url: 'ajax/user-data.php',
            method: 'post',
            data: { action: 'display_timetable'},
            success: function(response) {
                // console.log(response);
                $("#UserTimetable").html(response);
            }, 
            error: function(xhr, status, error) 
            {
            console.log("Status: " + status);
            console.log("Error: " + error);
            }
        });
    }
    

    let id_reserve;
    let id_user = <?php echo $cid?>;

    $(document).on("click", ".review-btn", function(e) {
        $("#userReviewDoctor").removeClass("hide");

        // id_reserve = $(this).attr("id").split("-")[1];
        id_reserve = $(this).attr("id").split("-")[1];
        // console.log("Значение id: " + id_reserve);
        insertData(id_reserve);
    });

    function insertData(idReserve) {
        $.ajax({
            url: 'ajax/user-data.php',
            method: 'post',
            data: { action: 'show_reserve', id_reserve: idReserve},
            success: function(response) {
                // console.log(response);
                $("#infoReview").html(response);
            }, 
            error: function(xhr, status, error) 
            {
            console.log("Status: " + status);
            console.log("Error: " + error);
            }
        })
    }

    $(document).on("click", "#review-btnSubmit", function(e) {
        if($("#review-form")[0].checkValidity()) {
            e.preventDefault();

            // Получение id_doctor
            let idDoctor = $("p[id^='DoctorId-']").attr('id').split('-')[1];

            // Получение id_user
            // console.log(id_user);

            let textReview = $("#text-review").val();
            let rating = $("input[name='rate']:checked").val();
            
            function validateForm() {
                let isValid = true;

                if(rating == undefined) {
                    $("#rateError").text('* Укажите рейтинг врачу');
                    $("#rateError").addClass("text-danger");
                    console.log("rating");
                    isValid = false;
                } else {
                    $("#rateError").text('');
                    $("#rateError").removeClass("text-danger");
                    console.log(rating);
                }

                let textRegex = /^.*[a-zA-Zа-яА-ЯёЁ].{4,}.*$/;
                if (!textRegex.test(textReview)) {
                    $("#textreviewError").text('* Введите более 4-х символов');
                    $("#text-review").addClass("border-danger bg-danger");
                    $("#textreviewError").addClass("text-danger");
                    isValid = false;
                }  else {
                    $("#textreviewError").text("");
                    $("#text-review").removeClass("border-danger bg-danger");
                    $("#textreviewError").removeClass("text-danger");
                }
                //Возвращаем результат
                return isValid ;
            }

            if (validateForm()) {
                insertAllData(id_reserve, id_user, textReview, rating, idDoctor);
                displayTimeTable();
                $("#Error").text('');
                $("#Error").addClass("text-danger");
                // console.log("Значение id_reserve сохранилось"+id_reserve);
            } else {
                console.log("Заполните форму!");
                $("#Error").text('* Заполните форму!');
                $("#Error").addClass("text-danger");
            }
        }
    });

    function insertAllData(id_reserve, userID, textReview, reviewStar, doctorID) {
        $.ajax({
            url: 'ajax/user-data.php',
            method: 'post',
            data: { action: 'insert_review', id_reserve:id_reserve, id_user: userID, textReview: textReview, reviewStar: reviewStar, doctorID:doctorID},
            success: function(response) {
                // displayTimeTable();
                console.log(response);
                $("#userAnswer").removeClass("hide");
                $("#userReviewDoctor").addClass("hide");
                displayTimeTable();
            }, 
            error: function(xhr, status, error) 
            {
            console.log("Status: " + status);
            console.log("Error: " + error);
            }
        })
    }

    //Изменение номера телефона
    $(document).on("click", "#btn-change-phone", function(e) {
        if($("#change-phone")[0].checkValidity()) {
            e.preventDefault();
            let phone = $("#phone").val();

            $.ajax({
                  url:'ajax/user-data.php',
                  method: 'post',
                  data: {action: "update_phone", phone: phone},
                  success: function(response) {
                    $("#phoneError").html(response);
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
                    url:'ajax/user-data.php',
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

    $(document).on("click", "#btn-change-age", function(e) {
        if($("#change-age")[0].checkValidity()) {
            e.preventDefault();
            
            let age = $("#age").val();

            $.ajax({
                url:'ajax/user-data.php',
                method: 'post',
                data: {action: "update_age", age: age},
                success: function(response) {
                $("#ageError").html(response);
                console.log(response);
                },
                error: function(xhr, status, error){
                console.log("Status: " + status);
                console.log("Error: " + error);
                }
            });
        }
    });  

    $(document).on("click", "#btn-change-lname", function(e) {
        if($("#change-lname")[0].checkValidity()) {
            e.preventDefault();
            
            let lname = $("#lname").val();

            $.ajax({
                url:'ajax/user-data.php',
                method: 'post',
                data: {action: "update_lname", lname: lname},
                success: function(response) {
                 $("#lnameError").html(response);
                console.log(response);
                },
                error: function(xhr, status, error){
                console.log("Status: " + status);
                console.log("Error: " + error);
                }
            });
        }
    });
    $(document).on("click", "#btn-change-sname", function(e) {
        if($("#change-sname")[0].checkValidity()) {
            e.preventDefault();
            
            let sname = $("#sname").val();

            $.ajax({
                url:'ajax/user-data.php',
                method: 'post',
                data: {action: "update_sname", sname: sname},
                success: function(response) {
                 $("#snameError").html(response);
                console.log(response);
                },
                error: function(xhr, status, error){
                console.log("Status: " + status);
                console.log("Error: " + error);
                }
            });
        }
    });
    $(document).on("click", "#btn-change-email", function(e) {
        if($("#change-email")[0].checkValidity()) {
            e.preventDefault();
            
            let email = $("#email").val();

            $.ajax({
                url:'ajax/user-data.php',
                method: 'post',
                data: {action: "update_email", email: email},
                success: function(response) {
                 $("#emailError").html(response);
                console.log(response);
                },
                error: function(xhr, status, error){
                console.log("Status: " + status);
                console.log("Error: " + error);
                }
            });
        }
    });

    $(document).on("click", ".cancel-row", function(e) {
        id_row = $(this).attr("id").split("-")[1];
        console.log("ID cancel row:" + id_row);

        $.ajax({
                url:'ajax/user-data.php',
                method: 'post',
                data: {action: "cancel_row", id_row: id_row},
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
</script>