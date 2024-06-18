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
            $previous_date = null;
            foreach ($list as $row) { 
                $time = new DateTime($row['time_work']);
                $formattedTime = $time->format('H:i');
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
                // print_r($row['time_work']) ; 
                $status = '';    
                if($row['status'] == 'free') {
                    $status = 'свободная запись';
                } else if($row['status'] == 'reserve') {
                    $status = 'пациент записан';
                    $output .= '
                        <tr>
                            <td >#'.$row['id_doctorservice'].'</td>
                            <td>'.$formattedDate.'</td>
                            <td>'.$formattedTime.'</td>
                            <td>'.$status.'</td>
                            <td>
                                <button class="cancel-row close-btn bg-danger text-danger bg-danger" id="cancel-'.$row['id_doctorservice'].'">&times;</button>
                            </td>
                        </tr>
                    ';
                } else {
                    $status = 'отменен';
                    $output .= '
                        <tr>
                            <td class="text-danger">#'.$row['id_doctorservice'].'</td>
                            <td class="text-danger">'.$formattedDate.'</td>
                            <td class="text-danger">'.$formattedTime.'</td>
                            <td class="text-danger">'.$status.'</td>
                            <td class="text-danger"></td>
                        </tr>
                    ';
                }
            }
            // $output .= "</tr>";
            print_r($output) ; 
        } else {
            echo "Пока еще никто к вам не записался!";
        }
    }
}

//
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
                // print_r($row['time_work']) ; 
                $status = '';    
                if($row['status'] == 'free') {
                    $status = 'свободная запись';
                } else if($row['status'] == 'reserve') {
                    $status = 'пациент записан';
                } else {
                    $status = 'отменен';
                }
                // Check if the current date is the same as the previous date
                $time = new DateTime($row['time_work']);
                $formattedTime = $time->format('H:i');

                if($row['status'] == 'free') {
                    if($current_date == $previous_date) {
                        
                        $output .= '
                        <tr>
                            <td >#'.$row['id_doctorservice'].'</td>
                            <td></td> <!-- Empty date -->
                            <td>'.$formattedTime.'</td>
                            <td>'.$status.'</td>
                            <td><button class="delete-row close-btn bg-danger text-danger bg-danger" id="delete-'.$row['id_doctorservice'].'">&times;</button></td>
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
                            <td>'.$formattedTime.'</td>
                            <td>'.$status.'</td>
                            <td><button class="delete-row close-btn bg-danger text-danger bg-danger" id="delete-'.$row['id_doctorservice'].'"" >&times;</button></td>
                        </tr>
                        ';
                    }
                } else if($row['status'] == 'reserve'){
                    if($current_date == $previous_date) {
                        $output .= '
                        <tr>
                            <td class="text-success">#'.$row['id_doctorservice'].'</td>
                            <td ></td> <!-- Empty date -->
                            <td class="text-success">'.$formattedTime.'</td>
                            <td class="text-success">'.$status.'</td>
                            <td></td>
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
                        $time = new DateTime($row['time_work']);
                        $formattedTime = $time->format('H:i');
                        $output .= '
                        <tr>
                            <td class="text-success">#'.$row['id_doctorservice'].'</td>
                            <td class="text-success">'.$formattedDate.'</td>
                            <td class="text-success">'.$formattedTime.'</td>
                            <td class="text-success">'.$status.'</td>
                            <td></td>
                        </tr>
                        ';
                    }
                } else {
                        $date = new DateTime($row['date_work']);
                        $time = new DateTime($row['time_work']);
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
                        $formattedTime = $time->format('H:i');
                        $output .= '
                        <tr>
                            <td class="text-danger">#'.$row['id_doctorservice'].'</td>
                            <td class="text-danger">'.$formattedDate.'</td>
                            <td class="text-danger">'.$formattedTime.'</td>
                            <td class="text-danger">'.$status.'</td>
                            <td><button class="delete-row close-btn bg-danger text-danger bg-danger" id="delete-'.$row['id_doctorservice'].'">&times;</button></td>
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
    $time_work = date("H:i", mktime($time, 0, 0));

    $output = '';

    if($doctorsservices->date_exist($date_work, $time_work, $id_doctor)) {
        $exist_date = $date_work;
        $date = new DateTime($exist_date);
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

        $exist_time = $time_work;
        $output .= '<div class="text-warning error-div mt-5" >    
                        <strong>Дата: '.$formattedDate.' 
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


//Изменение данных врача 
//Изменение логина
if(isset($_POST['action']) && $_POST['action'] == 'update_login') {
    $login = $_POST['login'];

    $list_exist = $doctors->doctor_exist($login);
    // $list = $doctors->updateLogin($login);
    if($login == $clogin) {
        echo $users->showMessage('text-warning','У вас сейчас такой логин', 'bg-warning','text-warning');
    } else if($list_exist){
        echo $users->showMessage('text-warning','Врач с таким логином уже существует', 'bg-warning','text-warning');
    } else {
        $list = $doctors->updateLogin($login, $cid);
        echo $users->showMessage('text-success','Логин успешно изменен', 'bg-success','text-success');
        $_SESSION['doctor'] = $login;
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'update_password') {
    $password = $_POST['pass'];

    $list = $doctors->updatePassword($password, $cid);
    if($list) {
        echo $users->showMessage('text-success','Пароль успешно изменен', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'update_exper') {
    $experience = $_POST['experience'];

    $list = $doctors->updateExperience($experience, $cid);
    if($list) {
        echo $users->showMessage('text-success','Опыт успешно изменен', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'update_desc') {
    $desc = $_POST['desc'];

    $list = $doctors->updateDescription($desc, $cid);
    if($list) {
        echo $users->showMessage('text-success','Описание успешно добавлено', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'update_wcateg') {
    $wcateg = $_POST['wcateg'];

    $list = $doctors->updateWCategory($wcateg, $cid);
    if($list) {
        echo $users->showMessage('text-success','Категория успешно изменена', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'update_type') {
    $type = $_POST['type'];

    $list = $doctors->updateType($type, $cid);
    if($list) {
        echo $users->showMessage('text-success','Тип успешно изменен', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'delete_row') {
    $id_row = $_POST['id_row'];

    $list = $doctors->deleteRow($id_row);
    if($list) {
        echo $users->showMessage('text-success','Запись удалена', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'cancel_row') {
    $id_row = $_POST['id_row'];

    $list = $doctors->cancelRow($id_row);
    if($list) {
        echo $users->showMessage('text-success','Запись отменена', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
