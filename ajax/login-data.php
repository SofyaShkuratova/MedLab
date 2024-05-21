<?php
session_start();
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

include_once "../objects/user.php";
$users = new Users($db);

//Handle Login Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'login') {
    // print_r($_POST);
    $phone = $users->test_input($_POST['phone']);
    $password = $users->test_input($_POST['password']);

    $loggedInUser = $users->login($phone);

    if($loggedInUser != null) {
        if(password_verify($password, $loggedInUser['password'])) { 
            if (!empty($_POST['rem'])) {
                setcookie("phone", $phone, time() + (30*24*60*60),"/");
                setcookie("password", $password, time() + (30*24*60*60),"/");
            } else {
                setcookie("phone", "", 1,"/");
                setcookie("password", "", 1,"/");
            }

            echo 'login';
            $_SESSION['user'] = $phone;

        } else {
            echo $users->showMessage('text-danger','Некорректный пароль', 'bg-danger','text-danger');
        }
    } else {
        echo $users->showMessage('text-danger', 'Пользователь не найден!', 'bg-danger','text-danger');
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'login-doctor') {
    // print_r($_POST);
    $login = $users->test_input($_POST['phone']);
    $password = $users->test_input($_POST['password']);

    $loggedInUser = $users->loginDoctor($login);
    // print_r($loggedInUser);
    
    if($loggedInUser != null) {
        // if(password_verify($password, $loggedInUser['password'])) { 
        if($password == $loggedInUser['password']) { 
            // print_r($loggedInUser);
            if (!empty($_POST['rem'])) {
                setcookie("login", $login, time() + (30*24*60*60),"/");
                setcookie("password", $password, time() + (30*24*60*60),"/");
            } else {
                setcookie("login", "", 1,"/");
                setcookie("password", "", 1,"/");
            }

            echo 'login-doctor';
            $_SESSION['doctor'] = $login;
            // print_r($_SESSION);
            // echo $users->showMessage('text-success', 'Корректный пароль' ,'bg-success','text-success');
        } else {
            echo $users->showMessage('text-danger','Некорректный пароль', 'bg-danger','text-danger');
        }
    } else {
        echo $users->showMessage('text-danger', 'Врач не найден!', 'bg-danger','text-danger');
    }
}