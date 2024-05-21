<?php
// session_start();
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

include_once "../objects/user.php";
$users = new Users($db);

include_once "../objects/session.php";
include_once "../objects/category.php";
include_once "../objects/doctor.php";
include_once "../objects/service.php";
include_once "../objects/doctorservice.php";
include_once "../objects/reservation.php";
include_once "../objects/review.php";

$categories = new Categories($db);
$services = new Service($db);
$doctors = new Doctor($db);
$doctorsservices = new DoctorService($db);
$reservations = new Timetable($db);
$reviews = new Review($db);

if(isset($_POST['action']) && $_POST['action'] == 'display_doctortimetable') {
    // print_r($_POST) ; 
    if(isset($cid)) {
        $id_doctor = $cid;
        
        $output = '';
        $list = $doctorsservices->getTimeTableDoctorHome($id_doctor); 
        if($list) {
            foreach ($list as $row) { 
                print_r($row['time_work']) ; 
                $status = '';    
                if($row['time_work'] == 'reserve') {
                    $status = 'свободная запись';
                } else {
                    $status = 'ожидается прием';
                }
                $output .= '
                <tr>
                    <td >#'.$row['id_doctorservice'].'</td>
                    <td>'.$row['date_work'].'</td>
                    <td>'.$row['time_work'].'</td>
                    <td>'.$status.'</td>
                </tr>
                ';
            }
            // $output .= "</tr>";
            print_r($output) ; 
        } else {
            echo "Пока еще никто к вам не записался!";
        }
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'display_timetable') {
    // print_r($_POST) ; 
    if(isset($cid)) {
        $id_doctor = $cid;
        
        $output = '';
        $list = $doctorsservices->getTimeTableDoctor($id_doctor); 
        if($list) {
            foreach ($list as $row) { 
                print_r($row['time_work']) ; 
                $status = '';    
                if($row['time_work'] == 'reserve') {
                    $status = 'ожидается прием';
                } else {
                    $status = 'свободная запись';
                }
                $output .= '
                <tr>
                    <td >#'.$row['id_doctorservice'].'</td>
                    <td>'.$row['date_work'].'</td>
                    <td>'.$row['time_work'].'</td>
                    <td>'.$status.'</td>
                </tr>
                ';
            }
            // $output .= "</tr>";
            print_r($output) ; 
        } else {
            echo "Пока еще никто к вам не записался!";
        }
    }
}