<?php
//include_once "../config/database.php";
include_once(__DIR__ . '/../config/database.php');

include_once "user.php";
session_start();

$database = new Database();
$db = $database->getConnection();
$cuser = new Users($db);

// if(!isset($_SESSION['user'])) {
//     header('location:index.php');
//     die;
// } else {
//     echo 'Пользователь не записан!';
// }
$cphone = '';
$clogin = '';

if(isset($_SESSION['user'])) {
    
    $cphone = $_SESSION['user'];
    $data = $cuser->currentUser($cphone);
} else if(isset($_SESSION['doctor'])) {
    
    $clogin = $_SESSION['doctor'];
    $data = $cuser->currentDoctor($clogin);
} else {
    // echo 'Вы не авторизированы!';
}

if(isset($_SESSION['user'])) {
    
    $cid = $data['id_user'];
    $cname = $data['name'];
    $clast_name = $data['last_name'];
    $csecond_name = $data['second_name'];
    $cphone = $data['phone'];
    $cemail = $data['email'];
    $cid_role = $data['id_role'];
    $cage = $data['age'];
    $ccreated_at = $data['created_at'];
    $cpassword = $data['password'];
    // print_r($data);
    // $cphoto = $data['photo'];
} else if(isset($_SESSION['doctor'])) {

    $cid = $data['id_doctor'];
    $cname = $data['doctor_name'];
    $clast_name = $data['doctor_lastname'];
    $csecond_name = $data['doctor_secondname'];
    $clogin = $data['login'];
    $cemail = $data['password'];
    $cid_category = $data['id_category'];
    $cexperience = $data['experience'];
    $ctype = $data['type'];
    $cwork_category = $data['work_category'];
    $cdescription_doctor = $data['description_doctor'];
    
    // print_r($data);
    // print_r($_SESSION['doctor']);
} else {

}


?>