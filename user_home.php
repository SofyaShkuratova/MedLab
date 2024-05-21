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
                                    <!-- <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                        </li> -->
                                    <!-- <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li> -->
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
                                                            <th>Статус</th>
                                                            <th>Категория</th>
                                                            <th>Врач</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="UserTimetable">
                                                        
                                                    </tbody>
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
                                                <div id="infoReview">

                                                </div>
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
                                <div class="tab-pane fade " id="track-orders" role="tabpanel"
                                    aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Orders tracking</h5>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press
                                                "Track" button. This was given to you on your receipt and in the
                                                confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="#"
                                                        method="post">
                                                        <div class="input-style mb-20">
                                                            <label>Order ID</label>
                                                            <input name="order-id"
                                                                placeholder="Found in your order confirmation email"
                                                                type="text" class="square">
                                                        </div>
                                                        <div class="input-style mb-20">
                                                            <label>Billing email</label>
                                                            <input name="billing-email"
                                                                placeholder="Email you used during checkout"
                                                                type="email" class="square">
                                                        </div>
                                                        <button class="submit submit-auto-width"
                                                            type="submit">Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Billing Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>000 Interstate<br> 00 Business Spur,<br> Sault Ste.
                                                        <br>Marie, MI 00000</address>
                                                    <p>New York</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>4299 Express Lane<br>
                                                        Sarasota, <br>FL 00000 USA <br>Phone: 1.000.000.0000</address>
                                                    <p>Sarasota</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="account-detail" role="tabpanel"
                                    aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Изменить данные аккаунта</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" name="enq">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Имя</label>
                                                        <input required="" class="form-control square" name="name"
                                                            type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Фамилия</label>
                                                        <input required="" class="form-control square" name="lname">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Отчество</label>
                                                        <input required="" class="form-control square" name="sname"
                                                            type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Возраст</label>
                                                        <input required="" class="form-control square" name="age"
                                                            type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Email</label>
                                                        <input required="" class="form-control square" name="email"
                                                            type="email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Телефон</label>
                                                        <input required="" class="form-control square" name="phone"
                                                            type="email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Новый пароль</label>
                                                        <input required="" class="form-control square" name="npassword"
                                                            type="password">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Повторить пароль</label>
                                                        <input required="" class="form-control square" name="cpassword"
                                                            type="password">
                                                    </div>
                                                    <div class="col-md-12 mt-20">
                                                        <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit">Изменить данные</button>
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
        })
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
</script>