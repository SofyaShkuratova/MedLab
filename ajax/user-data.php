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

//Вывод расписания
if(isset($_POST['action']) && $_POST['action'] == 'display_timetable') {
    // print_r($_POST);
    // print_r($cid);
    if(isset($cid)) {
        $id_user = $cid;

        $output = '';
        $list = $reservations->getTimeTableUserHome($id_user);
        if($list) {
            foreach ($list as $row) {      
                if($row['status'] == 'отзыв') {
                    $output .= '
                    <tr>
                    <td >#'.$row['id_reserve'].'</td>
                    <td>'.$row['date_reserve'].'</td>
                    <td>
                        <a class="review-btn" id="reserve-'.$row['id_reserve'].'">Оставить отзыв</a>
                    <td>
                        <a class="btn-small d-block" href="product-detail.php?id_category='.$row['id_category'].'">'.$row['title_category'].'</a>
                    </td>
                    <td>
                        <a  class="btn-small d-block"  href="doctor-details.php?id_doctor='.$row['id_doctor'].'">'.$row['doctor_lastname'].' '.$row['doctor_name'].' '.$row['doctor_secondname'].'</a>
                    </td>
                    </tr>
                    ';
                } else {
                    $output .= '
                    <tr>
                        <td>#'.$row['id_reserve'].'</td>
                        <td>'.$row['date_reserve'].'</td>
                        <td>' ;
                    $output .= $row['status'];
                    $output .= '
                        </td>
                        <td>
                            <a class="btn-small d-block" href="product-detail.php?id_category='.$row['id_category'].'">'.$row['title_category'].'</a>
                        </td>
                        <td>
                            <a class="btn-small d-block" href="doctor-details.php?id_doctor='.$row['id_doctor'].'">'.$row['doctor_lastname'].' '.$row['doctor_name'].' '.$row['doctor_secondname'].'</a>
                        </td>
                    </tr>    
                    ';
                }
            }
            // $output .= "</tr>";
            print_r($output) ; 
        }
    }
    
}

//Вывод отзыва красивого
if(isset($_POST['action']) && $_POST['action'] == 'show_reserve') {
    $idreserve = $_POST['id_reserve'];

    $list = $reservations->getReserveInfo($idreserve);
    if($list) {
        
        $output = "";
        foreach($list as $row) {
            $date = new DateTime($row['date_reserve']);
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
            $output .= "
            <p id='DoctorId-".$row['id_doctor']."'>Специалист: ".$row['doctor_lastname']." ".$row['doctor_name']." ".$row['doctor_secondname']."</p>
            <p id='CategoryId-".$row['id_category']."'>Категория: ".$row['title_category']."</p>
            <p>Дата приема:  ".$formattedDate."</p>
            ";
        }
        echo($output);
    }
}

//Заполнение бд данными отзыва
if(isset($_POST['action']) && $_POST['action'] == 'insert_review') {
    $id_user = $_POST['id_user'];
    $text_review = $_POST['textReview'];
    $review_star = $_POST['reviewStar'];
    $id_doctor = $_POST['doctorID'];
    $id_reserve = $_POST['id_reserve'];
    $output = "";

    
    if($list = $reviews->insertDataReview($id_reserve, $id_user, $text_review, $review_star, $id_doctor)) {
        echo "Вы успешно оставили отзыв!";
    } else {
        echo $users->showMessage('text-danger','','', 'Something went wrong! try again later!');
    }
}