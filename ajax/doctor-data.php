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
                $date = new DateTime($row['date_work']);
                $months = [
                    1 => 'Янв.',
                    2 => 'Февр.',
                    3 => 'Март',
                    4 => 'Апр.',
                    5 => 'Май',
                    6 => 'Июнь',
                    7 => 'Июль',
                    8 => 'Авг.',
                    9 => 'Сент.',
                    10 => 'Окт.',
                    11 => 'Нояб.',
                    12 => 'Дек.'
                ];
                $formattedDate = $date->format('d ') . $months[(int)$date->format('n')] . $date->format('. Y');
                $output .= '
                <tr>
                    <td >#'.$row['id_doctorservice'].'</td>
                    <td>'.$formattedDate.'</td>
                    <td>'.$row['time_work'].'</td>
                    <td>'.$status.'</td>
                    <td><button class="close-btn bg-danger text-danger bg-danger" >&times;</button></td>
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
            $previous_date = null;
            foreach ($list as $row) { 
                $current_date = $row['date_work'];
                print_r($row['time_work']) ; 
                $status = '';    
                if($row['time_work'] == 'reserve') {
                    $status = 'ожидается прием';
                } else {
                    $status = 'свободная запись';
                }
                // Check if the current date is the same as the previous date
                if($current_date == $previous_date) {
                    $output .= '
                    <tr>
                        <td >#'.$row['id_doctorservice'].'</td>
                        <td></td> <!-- Empty date -->
                        <td>'.$row['time_work'].'</td>
                        <td>'.$status.'</td>
                        <td><button class="close-btn bg-danger text-danger bg-danger" >&times;</button></td>
                    </tr>
                    ';
                } else{
                    $date = new DateTime($row['date_work']);
                    $months = [
                        1 => 'Янв.',
                        2 => 'Февр.',
                        3 => 'Март',
                        4 => 'Апр.',
                        5 => 'Май',
                        6 => 'Июнь',
                        7 => 'Июль',
                        8 => 'Авг.',
                        9 => 'Сент.',
                        10 => 'Окт.',
                        11 => 'Нояб.',
                        12 => 'Дек.'
                    ];
                    $formattedDate = $date->format('d ') . $months[(int)$date->format('n')] . $date->format('. Y');
                    $output .= '
                    <tr>
                        <td >#'.$row['id_doctorservice'].'</td>
                        <td>'.$formattedDate.'</td>
                        <td>'.$row['time_work'].'</td>
                        <td>'.$status.'</td>
                        <td><button class="close-btn bg-danger text-danger bg-danger" >&times;</button></td>
                    </tr>
                    ';
                }
                // Update the previous date for the next iteration
                $previous_date = $current_date;
            }
            // $output .= "</tr>";
            print_r($output) ; 
        } else {
            echo "Пока еще никто к вам не записался!";
        }
    }
}

//Создание расписания врача
if(isset($_POST['action']) && $_POST['action'] == 'add_timetable') {
    
    $id_doctor = +$_POST['id'];
    $date = $_POST['date'];
    $newDate = strtotime(str_replace('.', '-', $date));
    $date_work = date('Y-m-d', $newDate);

    $time = $_POST['time'];
    $time_work = date("H:i:s", mktime($time, 0, 0));

    $output = '';

    if($doctorsservices->date_exist($date_work, $time_work, $id_doctor)) {
        $exist_date = $date_work;
        $exist_time = $time_work;
        $output .= '<div class="text-warning error-div mt-5" >    
                        <strong>Дата: '.$exist_date.' 
                        <br>Время: '.$exist_time.' уже существуют</strong>
                        <button class="close-btn text-warning bg-warning" >&times;</button>
                    </div>';
    } else {
        if($doctorsservices->insert_timetable($id_doctor, $cid_category,  $time_work, $date_work)){
        } else {
            echo 'Мы не можем создать запись!';
        }
    }
    print_r($output);

    

}