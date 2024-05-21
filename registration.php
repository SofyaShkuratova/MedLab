<?php
// подключим файлы, необходимые для подключения к базе данных и файлы с объектами
include_once "config/database.php";
include_once "objects/user.php";


// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

$users = new Users($db);

$page_title = "Регистрация";

require_once "layout/layout_header.php";
?>

<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="home.php" rel="nofollow">Главная</a>                    
                    <span></span> Регистрация
                </div>
            </div>
        </div>
        <section class="pt-10 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Регистрация</h3>
                                        </div>                                        
                                        <form method="post" action="#" id="register-form">
                                          
                                            <div class="form-group">
                                              <label for="name">Имя</label>
                                              <input type="text" name="name" id="name" placeholder="Егор" required>
                                              <div id="nameError"></div>
                                            </div>
                                            
                                            <div class="form-group">
                                              <label for="last_name">Фамилия</label>
                                              <input type="text" name="last_name" id="last_name" placeholder="Петров" required>
                                              <div id="lastnError"></div>
                                            </div>
                                            
                                            <!-- <div class="form-group">
                                              <label for="second_name">Отчество</label>
                                              <input type="text" name="second_name" id="second_name" >
                                            </div> -->
                                            <div class="form-group">
                                              <label for="phone">Номер телефона</label>
                                              <input type="text" name="phone" id="phone" placeholder="+375447924677" required>
                                              <div id="phoneError"></div>
                                            </div>
                                            <div>
                                              <div class="mb-15" id="regAlert"></div>
                                            </div>
                                            
                                            
                                            
                                            <!-- <div class="form-group">
                                              <label for="email">*E-mail</label>
                                              <input type="text" name="email" id="email" required>
                                            </div> -->
                                            <!-- <div>
                                              <div id="emailError"></div>
                                            </div> -->
                                            <div class="form-group">
                                              <label for="password">Пароль</label>
                                              <input class="" type="password" name="password" id="rpassword" placeholder="Введите пароль" required>
                                              <div id="passError1"></div>
                                            </div>

                                            <div class="form-group">
                                              <label for="cpassword">Повторите пароль</label>
                                              <input type="password" name="cpassword" id="cpassword" placeholder="Повторите введенный пароль" required>
                                              <div id="passError"></div>
                                            </div>
                                          
                                            <div>
                                              <div id="Error"></div>
                                            </div>

                                            <p class="error" id="err"></p>

                                            <div class="form-group mt-30">
                                              <button type="submit" id="register-btn" name="register" value="submit" >Зарегистрироваться</button> 
                                            </div>
                                        </form>                                        
                                        <div class="text-muted text-center">Уже имеете аккаунт? <a href="login.php">Вход</a></div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-lg-6">
                               <img src="libs/imgs/login.png">
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
    $(document).ready(function(){
        $('#register-btn').on("click", function(e){
            if($("#register-form")[0].checkValidity()) {
              e.preventDefault();
              // $("#register-btn").val('Please Wait...');

              function validateForm() {
                let isValid = true;

                //Проверка поля номера
                let phoneRegex = /^\+375(44|29|33)\d{7}$/;
                if (!phoneRegex.test($("#phone").val())) {
                  $("#phoneError").text('* Введите корректный номер телефона с кодом +375 и последующими цифрами 44, 29 или 33, а затем еще 7 цифр');
                  $("#phone").addClass("border-danger bg-danger");
                  $("#phoneError").addClass("text-danger");
                  isValid = false;
                } else {
                  $("#phoneError").text('');
                  $("#phone").removeClass("border-danger bg-danger");
                  $("#phoneError").removeClass("text-danger");
                }
                
                //Проверка поля пароля
                let passwordRegex = /^(?=.*\d)(?=.*[a-zа-я])(?=.*[A-ZА-Я])[0-9a-zA-Zа-яА-Я]{8,}$/ ;
                if (!passwordRegex.test($("#rpassword").val()) ) {
                  $("#passError1").text('* Пароль должен содержать минимум 8 символов, 1 маленькую букву, 1 большую букву и цифры');
                  $("#passError1").addClass("text-danger");
                  $("#rpassword").addClass("border-danger bg-danger");
                  isValid = false;
                } else {
                  $("#passError1").text('');
                  $("#passError1").removeClass("text-danger");
                  $("#rpassword").removeClass("border-danger bg-danger");
                }

                let nameRegex =  /^[a-zA-Z]+$/ ;
                if (!nameRegex.test($("#name").val()) ) {
                  $("#nameError").text('* Имя должно содержать только буквы');
                  $("#nameError").addClass("text-danger");
                  $("#name").addClass("border-danger bg-danger");
                } else {
                  $("#nameError").text('');
                  $("#nameError").removeClass("text-danger");
                  $("#name").removeClass("border-danger bg-danger");
                }

                if (!nameRegex.test($("#last_name").val()) ) {
                  $("#lastnError").text('* Фамилия должна содержать только буквы');
                  $("#lastnError").addClass("text-danger");
                  $("#last_name").addClass("border-danger bg-danger");
                } else {
                  $("#lastnError").text('');
                  $("#lastnError").removeClass("text-danger");
                  $("#last_name").removeClass("border-danger bg-danger");
                }
                

                if($("#rpassword").val() != $("#cpassword").val()) {
                  $("#passError").text('* Пароль не совпадает, попробуйте еще раз');
                  // $("#register-btn").val('Зарегестрироваться');
                  $("#passError").addClass("text-danger");
                  $("#cpassword").addClass("border-danger bg-danger");
                  isValid = false;
                } else {
                  $("#passError").text('');
                  $("#passError").removeClass("text-danger");
                  $("#cpassword").removeClass("border-danger bg-danger");
                }
                //Возвращаем результат
                return isValid ;
                console.log(isValid);
              }

              if (validateForm()) {
                $("#Error").text('');
                let name = $("#name").val(); 
                let last_name = $("#last_name").val();
                // let second_name = $("#second_name").val();
                let phone = $("#phone").val();
                // let email = $("#email").val();
                let password = $("#password").val();
                

                $.ajax({
                  url:'ajax/registration-insert.php',
                  method: 'post',
                  // dataType: "json",
                  data: $("#register-form").serialize()+'&action=register',
                  // data: {title_user: title_user, lastname: lastname, secondname: secondname, phone: phone, email: email, password: password},
                  success: function(response)
                  {
                    // $("#err").html(data);
                    // console.log(response);
                    if(response === 'register') {
                      window.location = 'home.php';
                      // console.log(response);
                    } else {
                      $("#regAlert").html(response);
                      // console.log(response);
                    }
                  }, 
                  error: function(xhr, status, error) 
                  {
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                  }
                })
              } else {
                $("#Error").text('');
              }

              // let passwordRegex = /^(?=.*\d)(?=.*[a-zа-я])(?=.*[A-ZА-Я])[0-9a-zA-Zа-яА-Я]{8,}$/ ;
              // let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
              // let phoneRegex = /^\+375(44|29|33)\d{7}$/;


              // if($("#rpassword").val() != $("#cpassword").val()) {
              //   $("#passError").text('* Пароль не совпадает, попробуйте еще раз');
              //   $("#register-btn").val('Зарегестрироваться');

              // } else if (!passwordRegex.test($("#rpassword").val()) ) {
              //   $("#passError").text('* Пароль должен содержать минимум 8 символов, 1 маленькую букву, 1 большую букву и цифры');
              //   $("#register-btn").val('Зарегистрироваться');

              // } else if (!emailRegex.test($("#email").val()) ) {
              //   $("#emailError").text('* Введите корректный email-адрес');

              // } else {
                // $("#passError").text('');
                // let name = $("#name").val(); 
                // let last_name = $("#last_name").val();
                // let second_name = $("#second_name").val();
                // let phone = $("#phone").val();
                // let email = $("#email").val();
                // let password = $("#password").val();

                // $.ajax({
                //   url:'ajax/registration-insert.php',
                //   method: 'post',
                //   // dataType: "json",
                //   data: $("#register-form").serialize()+'&action=register',
                //   // data: {title_user: title_user, lastname: lastname, secondname: secondname, phone: phone, email: email, password: password},
                //   success: function(response)
                //   {
                //     // $("#err").html(data);
                //     // console.log(response);
                //     if(response === 'register') {
                //       window.location = 'index.php';
                //       // console.log(response);
                //     } else {
                //       $("#regAlert").html(response);
                //       console.log(response);
                //     }
                //   }, 
                //   error: function(xhr, status, error) 
                //   {
                //     console.log("Status: " + status);
                //     console.log("Error: " + error);
                //   }
                // })
              // }
            }
            // var title_user = $("#title_user").val(); 
            // var lastname = $("#last-name").val();
            // var secondname = $("#second-name").val();
            // var phone = $("#phone").val();
            // var email = $("#email").val();
            // var password = $("#password").val();

            // $.ajax ({
            //   url:'registration-insert.php',
            //   method: 'post',
            //   dataType: "json",
            //   data: {title_user: title_user, lastname: lastname, secondname: secondname, phone: phone, email: email, password: password},
            //   success: function(data)
            //   {
            //     // $("#err").html(data);
            //     console.log(data);
            //   }, 
            //   error: function(xhr, status, error) 
            //   {
            //     console.log("Status: " + status);
            //     console.log("Error: " + error);
            //   }
            // });
        })
      
    }) ;
</script>