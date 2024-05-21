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
                                            aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Личные
                                            данные</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                            role="tab" aria-controls="orders" aria-selected="false"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Расписание</a>
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
                                            aria-selected="true"><i class="fi-rs-user mr-10"></i>Добавить запись</a>
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
                                <div class="tab-pane fade " id="dashboard" role="tabpanel"
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
                                            <p>Опыт: <?php print_r($cwork_category) ?> категория</p>
                                            <p>Стаж: <?php print_r($cexperience) ?> лет</p>
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
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel"
                                    aria-labelledby="account-detail-tab">
                                    <div class="card mb-20">
                                        <div class="card-header">
                                            <h5>Добавить запись в расписание</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" name="enq">
                                                <div class="row">
                                                    <div class="form-group col-md-6 centered">
                                                        <!-- <label>Дата</label> -->
                                                        <input type="text" id="my-datepicker" class="mb-10">
                                                    </div>
                                                    <div class="form-group col-md-6" id="">

                                                    </div>
                                                </div > 
                                                    
                                                    <div class="col-md-12 mt-20">
                                                        <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit">Добавить расписание</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
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
                                                        </tr>
                                                    </thead>
                                                    <tbody id="FullTimetable">
                                                        
                                                    </tbody>
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
<script type="text/javascript">
    displayTable();
    function displayTable() {
        $.ajax({
            url: 'ajax/doctor-data.php',
            method: 'post',
            data: { action: 'display_doctortimetable'},
            success: function(response) {
                console.log(response);
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
                console.log(response);
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

    new AirDatepicker('#my-datepicker', {
        inline: true,
        minDate: new Date(),
        multipleDates: true,
        range: true,
        timepicker: true,
        timeFormat: "H:mm",
        minHours: 9,
        maxHours: 22,
        hoursStep: 1,
        maxMinutes: 0,

        onSelect: function(date, formattedDate) {
        // let timeFrom = document.getElementById('timeFrom').value; // Получить время начала из input
        // let timeTo = document.getElementById('timeTo').value; // Получить время окончания из input

        // console.log(date['formattedDate']);
            
        resultBlock = date['formattedDate'];
        console.log(resultBlock);
        // resultBlock.innerHTML = ''; // Очистить блок результатов

        // formattedDates.forEach(function(date) {
        //     var dateBlock = document.createElement('div');
        //     dateBlock.textContent = date + ' время с ' + timeFrom + ' до ' + timeTo;

        //     var closeButton = document.createElement('button');
        //     closeButton.textContent = 'X';
        //     closeButton.onclick = function() {
        //         resultBlock.removeChild(dateBlock); // Удалить эту дату при нажатии на крестик
        //     };

        //     dateBlock.appendChild(closeButton);
        //     resultBlock.appendChild(dateBlock);
        // });
        }
    });

    console.log(resultBlock);
</script>

