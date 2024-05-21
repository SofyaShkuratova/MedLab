<?php
session_start();
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

include_once "../objects/user.php";
$users = new Users($db);

if(isset($_POST['action']) && $_POST['action'] == 'register') {
    $name = $users->test_input($_POST['name']);
    $last_name = $users->test_input($_POST['last_name']);
    // $second_name = $users->test_input($_POST['second_name']);
    $second_name = '';
    $phone = $users->test_input($_POST['phone']);
    // $email = $users->test_input($_POST['email']);
    $email = '';
    $id_role = 2 ;
    $age = 0 ;
    $created_at = $users->date() ?? '';
    $password = $users->test_input($_POST['password']);
    // $photo = '';
    
    $hpassword = password_hash($password, PASSWORD_DEFAULT);

    if($users->phone_exist($phone)) {
        echo $users->showMessage('text-danger', 'Этот номер телефона уже зарегистрирован!', '', '');
    } else {
        if($users->register($name, $last_name, $second_name, $phone, $email, $id_role, $age, $created_at, $hpassword)) {
            echo 'register';
            $_SESSION['user'] = $phone;
        } else {
            echo $users->showMessage('text-danger', 'Something went wrong! try again later!', '', '');
        }
    }
    // 
    //echo json_encode();
}

// $users->create();



// if($insert_query > 0) {
//     echo "Data submitted successfuly";
// } else {
//     echo "Error!";
// }
?>