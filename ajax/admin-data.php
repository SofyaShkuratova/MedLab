<?php
session_start();
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

include_once "../objects/user.php";
$users = new Users($db);

include_once "../objects/category.php";
include_once "../objects/doctor.php";
include_once "../objects/service.php";
include_once "../objects/doctorservice.php";

$categories = new Categories($db);
$services = new Service($db);
$doctors = new Doctor($db);
$doctorsservices = new DoctorService($db);



if(isset($_POST['action']) && $_POST['action'] == 'createcateg') {
    // print_r($_POST);
    $title_category = $users->test_input($_POST['title_category']);
    $description_category = $users->test_input($_POST['desc_category']);

    //добавить проверку на наличие такого имени фото
    $photo = $users->test_input($_POST['fileName']);
    //конкатенация значения
    $combined_photo = 'libs/imgs/categories/' . $photo;

    if($categories->category_exist($title_category)) {
        echo $users->showMessage('text-warning','Эта категория уже существует!', 'bg-warning','text-warning');
    } else {
        if($categories->createCategory($title_category, $description_category, $combined_photo)) {
            echo $users->showMessage('text-success','Категория создана!', 'text-success','bg-success');
        } else {
            echo $users->showMessage('text-danger','Категория не создана!', 'text-danger','bg-danger');
        }
    }
}

//Если уже выбрана категория в карточке
if(isset($_POST['action']) && $_POST['action'] == 'show_Category') {
    $output = '';
    $id_category = $_POST['category_id'];
    $list = $categories->get_category();
    // print_r($list);
    if($list) {
        foreach ($list as $row) {
            if($row['id_category'] == $id_category) {
               $output .= "<option selected value='".$row['id_category']."'>".$row['title_category']."</option>"; 
            } else {
                $output .= "<option value='".$row['id_category']."'>".$row['title_category']."</option>"; 
            }
        }
        print_r($output);
    } else {
        echo '<h3>Еще нет ни одной категории!</h3>';
    }
}
//Если уже выбран доктор
if(isset($_POST['action']) && $_POST['action'] == 'show_CategoryDoctor') {
    $output = '';
    $id_doctor = $_POST['id_doctor'];
    $list = $doctors->FindCategoryByDoctor($id_doctor);
    // print_r($id_category);
    $list2 = $categories->get_category();
    if($list) {
        foreach ($list as $row) {
            $list_id_category = $row['id_category'];
        
            if($list2) {
                foreach ($list2 as $row) {
                    if($row['id_category'] == $list_id_category) {
                        $output .= "<option selected value='".$row['id_category']."'>".$row['title_category']."</option>"; 
                    }
                    $output .= "<option value='".$row['id_category']."'>".$row['title_category']."</option>"; 
                }
            }
        }
        $output .= "</select>";
        print_r($output);
    } else {
        echo '<h3>Еще нет ни одной категории!</h3>';
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'show_DoctorInput') {
    $output = '';
    $id_doctor = $_POST['id_doctor'];
    $list = $doctors->FindCategoryByDoctor($id_doctor);
    // print_r($list);
    if($list) {
            foreach ($list as $row) {
                $list_id_category = $row['id_category'];
                $list2 = $doctors->get_doctors($list_id_category);
            
                if($list2) {
                    foreach ($list2 as $row) {
                        if($row['id_doctor'] == $id_doctor) {
                            $output .= "<option selected value='".$row['id_doctor']."'>".$row['doctor_lastname']." ".$row['doctor_name']." ".$row['doctor_secondname']."</option>"; 
                        } else {
                            $output .= "<option value='".$row['id_doctor']."'>".$row['doctor_lastname']." ".$row['doctor_name']." ".$row['doctor_secondname']."</option>"; 
                        }
                    }
                }
            }
        print_r($output);
    } else {
        echo '<h5>Еще нет ни одного доктора!</h5>';
    }
}
//Онлайн - запись
//Вывод категорий
if(isset($_POST['action']) && $_POST['action'] == 'display_categories') {
    $output = '';

    $list = $categories->get_category();

    if($list) {
        $output .= "<option value='0'>Категория...</option>";
        foreach ($list as $row) {
            $output .= "<option value='".$row['id_category']."'>".$row['title_category']."</option>";
        }
        
        print_r($output);
    } else {
        echo '<h3>Еще нет ни одной категории!</h3>';
    }
    //print_r($list);
}
//Вывод докторов
if(isset($_POST['action']) && $_POST['action'] == 'display_doctors') {
    $output = '';
    
    $id_category = $users->test_input($_POST['category_id']);

    $list = $doctors->get_doctors($id_category);
    // print_r($list);
    if($list) {
        foreach ($list as $row) {
        $output .= "<option value='".$row['id_doctor']."'>".$row['doctor_lastname']." ".$row['doctor_name']." ".$row['doctor_secondname']."</option>";
        }
        print_r($output);
    } else {
        echo '<h5>Еще нет ни одного врача данной категории!</h5>';
    }
    print_r($id_category);
}
//Вывод талонов
if(isset($_POST['action']) && $_POST['action'] == 'display_timetable') {
    // print_r($_POST);
    $output = '';
    $id_category = $users->test_input($_POST['id_category']);
    $id_doctor = $users->test_input($_POST['id_doctor']);
    $currDate = new DateTime();
    $currentDate = $currDate->format("Y-m-d");

    $list = $doctorsservices->getDoctorService($id_category, $id_doctor);
    
    if($list) {
        $output .= "<h5>Ближайшие талоны</h5><br><div class='container-for-all'><div class='box-container'>";
        foreach ($list as $row) {
            $id_timetable = $row['id_doctorservice'];

            $currentDate = new DateTime();
            $current_7 = $currentDate->modify('+7 days');
            $futureDate = $currentDate->format('Y-m-d');
            //Определяем дату сейчас
            $currDate = new DateTime();
            $curFormDate = $currDate->format('Y-m-d');
            //Преобразуем время к формату
            $time_work = date("H:i", strtotime($row['time_work']));
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
            // $output .= "<div class='box-time' id='timetable-".$id_timetable."'><div>Время: ".$time_work."</div><div>Дата: ".$formattedDate."</div></div>";
            $output .= "<div class='box-time' id='timetable-".$id_timetable."'><div>Время: ".$time_work."</div><div>Дата: ".$formattedDate."</div></div>";
        }
        $output .= "<div id='style_date'>
                        <label for='start'>Выберите дату</label>
                        <input type='date' id='date_value' name='trip-start' value='".$curFormDate."' min='".$curFormDate."' />
                        </div>
                    </div>
                    </div>";
        print_r($output);
    } else {
        echo '<h5>Нет записей на выбранные параметры</h5>';
    }
}

//Фильтрация талонов

if(isset($_POST['action']) && $_POST['action'] == 'filter_timetable') {
    $id_category = $users->test_input($_POST['id_category']);
    $id_doctor = $users->test_input($_POST['id_doctor']);

    //
    $dateTime = DateTime::createFromFormat('Y-m-d', $_POST['date_work']);
    //На русском языке
    $date = new DateTime($_POST['date_work']);
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
    $dateString = $dateTime->format('Y-m-d');
    
    //Current date
    $currDate = new DateTime();
    $curFormDate = $currDate->format('Y-m-d');

    //Data List
    $list = $doctorsservices->filterDate($id_category, $id_doctor, $dateString);

    $output = "";
    
    if($list) {
        $output .= "<h5>Талоны на дату ".$formattedDate."</h5>
                    <br>
                    <div class='box-container'>";
        foreach ($list as $row) {
            $id_timetable = $row['id_doctorservice'];
        
            $time_work = date("H:i", strtotime($row['time_work']));

            $output .= "<div class='box-time' id='timetable-".$id_timetable."'><div>Время: ".$time_work."</div><div>Дата: ".$formattedDate."</div></div>";
        }
        $output .= "<div>
                        <label for='start'>Выберите дату</label>
                        <input type='date' id='date_value' name='trip-start' value='".$dateString."' min='".$curFormDate."' />
                    </div>
                    </div>";
        print_r($output);
    } else {
        $output .= "<h5>Нет талонов на дату ".$formattedDate."</h5>
                    <br>
                    <div class='box-container'>
                        <div>
                        <label for='start'>Выберите дату</label>
                        <input type='date' id='date_value' name='trip-start' value='".$dateString."' min='".$curFormDate."' />
                        </div>
                    </div>";
        print_r($output);
    }
}

//Вставка данных для записи в бд
if(isset($_POST['action']) && $_POST['action'] == 'insert_reserve') {
    // print_r($_POST);
    $id_user = $_POST['id_user'];
    $id_doctorcategory = $_POST['id_doctorcategory'];

    $list = $doctorsservices->insertData($id_user, $id_doctorcategory);
    $output = "";

    // print_r($list);
    if($list) {
        $output .= "<h5>Вы успешно записаны на прием!</h5>";
        print_r($output);
    } else {
        $output .= '<h5>ошибка!</h5>';
        print_r($output);
     }
 }

 //Создание услуги в админке
if(isset($_POST['action']) && $_POST['action'] == 'createservice') {
    // print_r($_POST);
    $title_service = $_POST['title'];
    $description_service = $_POST['description'];
    $price = $_POST['price'];
    $id_category = $_POST['id_category'];

    if($services->service_exist($title_service)) {
        echo $users->showMessage('text-warning','Эта услуга уже существует!', 'bg-warning','text-warning');
    } else {
        if($services->createService($title_service, $description_service, $price, $id_category)) {
            echo $users->showMessage('text-success','Услуга создана!', 'text-success','bg-success');
        } else {
            echo $users->showMessage('text-danger','Услуга не создана!', 'text-danger','bg-danger');
        }
    }
}

//Display Table Doctors
if(isset($_POST['action']) && $_POST['action'] == 'display_tableDoctors') {
    // print_r($_POST);
    $output = '';
    $list = $doctors->displayDoctorInfo();
    if($list) {
        foreach ($list as $row) {
            $output .= '
            <tr>
                <td>
                    <h5>'.$row['doctor_lastname'].' '.$row['doctor_name'].' '.$row['doctor_secondname'].'</h5>
                </td>
                <td>'.$row['login'].'</td>
                <td>'.$row['title_category'].'</td>
                <td>
                    <button class="delete-row-doctor close-btn bg-danger text-danger bg-danger" id="deletedoctor-'.$row['id_doctor'].'"" >&times;</button>
                </td>
            </tr>';
        }
        print_r($output);
    } else {
        echo('ОАОАОАООА');
    }
}
//Display Table Services
if(isset($_POST['action']) && $_POST['action'] == 'display_tableServ') {
    // print_r($_POST);
    $output = '';
    $list = $services->getServices();
    if($list) {
        foreach ($list as $row) {
            $output .= '
            <tr>
                <td>
                    <h5>'.$row['title_service'].'</h5>
                </td>
                <td>'.$row['description_service'].'</td>
                <td>'.$row['price'].'</td>
                <td>'.$row['title_category'].'</td>
                <td>
                    <button class="delete-row-service close-btn bg-danger text-danger bg-danger" id="deleteservice-'.$row['id_service'].'"" >&times;</button>
                </td>
            </tr>';
        }
        print_r($output);
    } else {
        echo('ОАОАОАООА');
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'display_tableCat') {
    // print_r($_POST);
    $output = '';
    $list = $categories->get_category();
    if($list) {
        foreach ($list as $row) {
            $output .= '
            <tr>
                <td class="image product-thumbnail"><img src="'.$row['photo'].'" alt="#"></td>
                <td>
                    <h5><a href="product-detail.php?id_category='.$row['id_category'].'">'.$row['title_category'].'</a></h5>
                </td>
                <td>'.$row['description_category'].'</td>
                <td>
                    <button class="delete-row-category close-btn bg-danger text-danger bg-danger" id="deletecategory-'.$row['id_category'].'"" >&times;</button>
                </td>
            </tr>';
        }
        print_r($output);
    }
}

//Create Doctor
if(isset($_POST['action']) && $_POST['action'] == 'createdoctor') {
    // print_r($_POST);
    $doctor_name = $users->test_input($_POST['name']);
    $doctor_lastname = $users->test_input($_POST['last']);
    $doctor_secondname = $users->test_input($_POST['second']);
    $id_category = $_POST['id_category'];
    $login = $users->test_input($_POST['login']);
    $password = $users->test_input($_POST['password']);
    
    $hpassword = password_hash($password, PASSWORD_DEFAULT);

    if($doctors->doctor_exist($login)) {
        echo $users->showMessage('text-warning','Этот логин уже существует!', 'text-warning','bg-warning');
    } else {
        if($doctors->createDoctor($doctor_name, $doctor_lastname, $doctor_secondname, $id_category, $login, $hpassword)) {
            echo $users->showMessage('text-success','Врач создан!', 'text-success','bg-success');
        } else {
            echo $users->showMessage('text-danger','Услуга не создана!', 'text-danger','bg-danger');
        }
    }
}


///Вывод категорий для админки!!!!
if(isset($_POST['action']) && $_POST['action'] == 'display_category') {
    $output = '';

    $list = $categories->get_category();


    if($list) {
        $output .= "<select class='form-control select-active' id='id_category'>
        <option value='0'>Категория...</option>";
        foreach ($list as $row) {
            $output .= "<option value='".$row['id_category']."'>".$row['title_category']."</option>";
        }
        $output .= "</select>";
        print_r($output);
    } else {
        echo '<h3>Еще нет ни одной категории!</h3>';
    }
    //print_r($list);
}

if(isset($_POST['action']) && $_POST['action'] == 'display_category1') {
    $output = '';
    $list = $categories->get_category();
    if($list) {
        $output .= "<select class='form-control select-active' id='id_category1'>
        <option value='0'>Категория...</option>";
        foreach ($list as $row) {
            $output .= "<option value='".$row['id_category']."'>".$row['title_category']."</option>";
        }
        $output .= "</select>";
        print_r($output);
    } else {
        echo '<h3>Еще нет ни одной категории!</h3>';
    }
    //print_r($list);
}

//удаление категории
if(isset($_POST['action']) && $_POST['action'] == 'delete_row_cat') {
    $id_row = $_POST['id_row'];

    $list = $categories->deleteRow($id_row);
    if($list) {
        echo $users->showMessage('text-success','Категория удалена', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
//удаление категории
if(isset($_POST['action']) && $_POST['action'] == 'delete_row_serv') {
    $id_row = $_POST['id_row'];

    $list = $services->deleteRow($id_row);
    if($list) {
        echo $users->showMessage('text-success','Услуга удалена', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}
//удаление категории
if(isset($_POST['action']) && $_POST['action'] == 'delete_row_doc') {
    $id_row = $_POST['id_row'];

    $list = $doctors->deleteRowDoctor($id_row);
    if($list) {
        echo $users->showMessage('text-success','Доктор удален', 'bg-success','text-success');
    } else {
        echo $users->showMessage('text-warning','Что-то пошло не так', 'bg-warning','text-warning');
    }
}


?>