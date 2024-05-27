<?php
session_start();
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

include_once "../objects/user.php";
$users = new Users($db);

include_once "../objects/category.php";
include_once "../objects/service.php";
include_once "../objects/doctor.php";
include_once "../objects/review.php";
$categories = new Categories($db);
$reviews = new Review($db);
$services = new Service($db);
$doctors = new Doctor($db);

if(isset($_POST['action']) && $_POST['action'] == 'nav_categories') {
    $output = '';
    $list = $categories->navCategory();

    if($list) {
        $output .= "<ul>";
        foreach ($list as $row) {
            $output .= "<li><a href='product-detail.php?id_category=".$row['id_category']."'>".$row['title_category']."</a></li>";
        }
        $output .= "</ul>";
        print_r($output);
    } else {
        echo '<h3>Нету категорий</h3>';
    }

    // print_r($list);
}

if(isset($_POST['action']) && $_POST['action'] == 'search_data') {
    // print_r($_POST);
    $output = '';
    $dataSearch = $_POST['data_search'];

    $list = $doctors->searchDocCat($dataSearch);
    // print_r($list);
    if ($list) {
        foreach ($list as $row) {
            $id_doctor = $row['id_doctor'];
            $name = $row['doctor_name'];
            $last_name = $row['doctor_lastname'];
            $second_name = $row['doctor_secondname'];

            $id_category = $row['id_category'];
            $category = $row['title_category'];

            $output .= "
                <div class='search-line'>
                    <a href='doctor-details.php?id_doctor=".$id_doctor."'>
                        ".$last_name." ".$name." ".$second_name. "
                    </a>
                    / 
                    <a href='product-detail.php?id_category=".$id_category."'>
                     ".$category."
                    </a>
                </div>
            "; 

        }
        print_r($output);
    } else {
        $output .= "<h5>Ничего не найдено по вашему запросу!</h5>";
    }
} 

//Display Num Cards
if(isset($_POST['action']) && $_POST['action'] == 'display_cards') {
    // print_r($_POST);

    $value = $_POST['value'];
    $number = $_POST['number_card'];
    $list = $doctors->displayCard($number, $value);
    // print_r($list);

    $output = '';
    if($list) {
        foreach($list as $row) {
            $output .= 
            '
            <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                <div class="product-cart-wrap mb-30">
                    <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                            <a href="doctor-details.php?id_doctor='.$row['id_doctor'].'">
                                <img class="default-img" src="libs/imgs/doctors/doctor-'.$row['id_doctor'].'.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <h2><a href="doctor-details.php?id_doctor='.$row['id_doctor'].'">'.$row['doctor_lastname'].' '.$row['doctor_name']. ' '.$row['doctor_secondname'].'</a></h2>';
                        
                        $reviewStar = $reviews->reviewStar($row['id_doctor']);
                        // print_r($reviewStar);

                        if ($reviewStar) {
                            $rate = ($reviewStar['AVG(review_star)']*20);
                            $num = ($reviewStar['AVG(review_star)']*1);
                            // print_r($rate);
                            $output .= '
                            <div class="product-rate-cover text-end">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width:'.$rate.'%"></div>  
                                </div>
                                <span class="font-small ml-5 text-muted">
                                    '.$num.' звезд
                                </span>
                            </div>
                            ';  
                            // echo($output);
                        }
                        // <div class="rating-result" title="90%">
                        //     <span>
                        //         <span>5,5</span>
                        //     </span>
                        // </div>
            $output .= 
            '
                        <div>
                            <span>Специальность: '.$row['title_category'].'</span>
                        </div>
                        <div>
                            <span>Тип: '.$row['type'].' врач</span>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        print_r($output);
    }
}

// if(isset($_POST['action']) && $_POST['action'] == 'sort_cards') {
//     $value = $_POST['value'];
//     $list = $doctors->sortCards($value);

//     $output = '';
//     if($list) {
//         foreach($list as $row) {
//             $output .= 
//             '
//             <div class="col-lg-4 col-md-4 col-6 col-sm-6">
//                 <div class="product-cart-wrap mb-30">
//                     <div class="product-img-action-wrap">
//                         <div class="product-img product-img-zoom">
//                             <a href="doctor-details.php?id_doctor='.$row['id_doctor'].'">
//                                 <img class="default-img" src="libs/imgs/doctors/doctor-'.$row['id_doctor'].'.png" alt="">
//                             </a>
//                         </div>
//                     </div>
//                     <div class="product-content-wrap">
//                         <h2><a href="doctor-details.php?id_doctor='.$row['id_doctor'].'">'.$row['doctor_lastname'].' '.$row['doctor_name']. ' '.$row['doctor_secondname'].'</a></h2>
//                         <div class="rating-result" title="90%">
//                             <span>
//                                 <span>5,5</span>
//                             </span>
//                         </div>
//                         <div>
//                             <span>Специальность: '.$row['title_category'].'</span>
//                         </div>
//                         <div>
//                             <span>Тип: '.$row['type'].' врач</span>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             ';
//         }
//         print_r($output);
//     }
// }

//Display Services
// if(isset($_POST['action']) && $_POST['action'] == 'display_services') {
//     print_r($_POST);

//     //$list = $services->showServices($id);

// }
?>