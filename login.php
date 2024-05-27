<?php
// подключим файлы, необходимые для подключения к базе данных и файлы с объектами
include_once "config/database.php";
include_once "objects/user.php";


// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

$users = new Users($db);

$page_title = "Вход в аккаунт";

require_once "layout/layout_header.php";
?>

<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="home.php" rel="nofollow">Главная</a>                    
                    <span></span> Вход
                </div>
            </div>
        </div>
        <section class="pt-50 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Вход</h3>
                                        </div>

                                        <form method="post" action="#" id="login-form">
                                            <div class="form-group">
                                                <label for="phone">Номер телефона</label>
                                                <input type="text" name="phone" id="phone" 
                                                    placeholder="+375447924677">
                                            </div>
                                            <div>
                                              <div id="phoneError"></div>
                                            </div>
                                            
                                            <div class="form-group">
                                              <label for="password">Пароль</label>
                                              <input type="password" name="password" id="rpassword" 
                                                placeholder="Fweoir345KJ">
                                            </div>
                                            <div>
                                              <div id="passError1"></div>
                                            </div>
                                            <div class="mb-15" id="loginAlert"></div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Войти как врач</span></label>
                                                    </div>
                                                </div>
                                                <a  href="registration.php">Регистрация</a>
                                            </div>
                                            
                                            <button type="submit" id="login-btn" name="login" value="submit" >Войти</button> 
                                            
                                            <p class="error" id="err"></p>
                                        </form>

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

<?php
require_once "layout/layout_footer.php";
?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#login-btn").click(function(e) {
            if($("#login-form")[0].checkValidity()) {
                e.preventDefault();

                $("#login-btn").val('Please wait...');
                if ($("#exampleCheckbox1").prop("checked")) {
                    $.ajax({
                    url:'ajax/login-data.php',
                    method: 'post',
                    data: $("#login-form").serialize()+'&action=login-doctor',
                    success: function(response) {
                        console.log(response);
                        if(response === 'login-doctor') {
                            // window.location = 'user_home.php'
                            window.location = 'home.php'
                        } else {
                            $("#loginAlert").html(response);
                        }
                    }
                    });

                } else {
                    $.ajax({
                    url:'ajax/login-data.php',
                    method: 'post',
                    data: $("#login-form").serialize()+'&action=login',
                    success: function(response) {
                        console.log(response);
                        if(response === 'login') {
                            // window.location = 'user_home.php'
                            window.location = 'home.php'
                        } else {
                            $("#loginAlert").html(response);
                        }
                    }
                    });
                }
                
            }
        })
    })
</script>