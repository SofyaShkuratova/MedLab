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
        // $status;
        if($list) {
            foreach ($list as $row) { 
                $time = new DateTime($row['time_reserve']);
                $formattedTime = $time->format('H:i');
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
                if($row['status'] == 'отзыв') {
                    $output .= '
                    <tr>
                    <td >#'.$row['id_reserve'].'</td>
                    <td>'.$formattedDate.'</td>
                    <td>'.$formattedTime.'</td>
                    <td>
                        <a class="review-btn" id="reserve-'.$row['id_reserve'].'">Оставить отзыв</a>
                    <td>
                        <a class="btn-small d-block" href="product-detail.php?id_category='.$row['id_category'].'">'.$row['title_category'].'</a>
                    </td>
                    <td>
                        <a  class="btn-small d-block"  href="doctor-details.php?id_doctor='.$row['id_doctor'].'">'.$row['doctor_lastname'].' '.$row['doctor_name'].' '.$row['doctor_secondname'].'</a>
                    </td>
                    <td></td>
                    </tr>
                    ';
                } else if($row['status'] == 'confirmed') {
                    $status = 'ожидание';
                    $output .= '
                    <tr>
                        <td>#'.$row['id_reserve'].'</td>
                        <td>'.$formattedDate.'</td>
                        <td>'.$formattedTime.'</td>
                        <td>' ;
                    $output .= $status;
                    $output .= '
                        </td>
                        <td>
                            <a class="btn-small d-block" href="product-detail.php?id_category='.$row['id_category'].'">'.$row['title_category'].'</a>
                        </td>
                        <td>
                            <a class="btn-small d-block" href="doctor-details.php?id_doctor='.$row['id_doctor'].'">'.$row['doctor_lastname'].' '.$row['doctor_name'].' '.$row['doctor_secondname'].'</a>
                        </td>
                        <td>
                            <button class="cancel-row close-btn bg-danger text-danger bg-danger" id="cancel-'.$row['id_reserve'].'">&times;</button>
                        </td>
                    </tr>    
                    ';
                } else if($row['status'] == 'cancel') {
                    $status = 'Отменен';
                    $output .= '
                    <tr>
                        <td class="text-danger">#'.$row['id_reserve'].'</td>
                        <td class="text-danger">'.$formattedDate.'</td>
                        <td class="text-danger">'.$formattedTime.'</td>
                        <td class="text-danger">' ;
                    $output .= $status;
                    $output .= '
                        </td>
                        <td class="text-danger">
                            <a class="btn-small d-block" href="product-detail.php?id_category='.$row['id_category'].'">'.$row['title_category'].'</a>
                        </td>
                        <td class="text-danger">
                            <a class="btn-small d-block" href="doctor-details.php?id_doctor='.$row['id_doctor'].'">'.$row['doctor_lastname'].' '.$row['doctor_name'].' '.$row['doctor_secondname'].'</a>
                        </td>
                        <td>
                            
                        </td>
                    </tr>    
                    ';
                } else {
                    $output .= '
                    <tr>
                        <td>#'.$row['id_reserve'].'</td>
                        <td>'.$formattedDate.'</td>
                        <td>'.$formattedTime.'</td>
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
                        <td></td>
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

//Изменение данных 
if(isset($_POST['action']) && $_POST['action'] == 'update_phone') {
    $phone = $_POST['phone'];

    $list_exist = $users->phone_exist($phone);
    // $list = $doctors->updateLogin($login);
    if($phone == $cphone) {
        echo $users->showMessage('text-warning','У вас сейчас такой номер', 'bg-warning','text-warning');
    } else if($list_exist){
        echo $users->showMessage('text-warning','Пользователь с таким номером уже существует', 'bg-warning','text-warning');
    } else {
        $list = $users->updatePhone($phone, $cid);
        echo $users->showMessage('text-success','Логин успешно изменен', 'bg-success','text-success');
        $_SESSION['user'] = $phone;
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'update_password') {
    $password = $_POST['pass'];

    $hpassword = password_hash($password, PASSWORD_DEFAULT);
    $list = $users->updatePassword($hpassword, $cid);
    if($list) {
        echo $users->showMessage('text-success','Пароль успешно изменен', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'update_age') {
    $age = $_POST['age'];

    $list = $users->updateAge($age, $cid);
    if($list) {
        echo $users->showMessage('text-success','Возраст успешно изменен', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'update_lname') {
    $lname = $_POST['lname'];

    $list = $users->updateLname($lname, $cid);
    if($list) {
        echo $users->showMessage('text-success','Отчество успешно добавлено', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'update_sname') {
    $sname = $_POST['sname'];

    $list = $users->updateSname($sname, $cid);
    if($list) {
         echo $users->showMessage('text-success','Фамилия успешно изменена', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'update_email') {
    $email = $_POST['email'];

    $list = $users->updateEmail($email, $cid);
    if($list) {
         echo $users->showMessage('text-success','Почта успешно изменена', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'cancel_row') {
    $id_row = $_POST['id_row'];
    // print_r($id_row);
    $list = $users->cancelRowUser($id_row);
    print_r($list);
    // if($list) {
    //     echo $users->showMessage('text-success','Запись отменена', 'bg-success','text-success');
    // } else {
    //     echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    // }
}