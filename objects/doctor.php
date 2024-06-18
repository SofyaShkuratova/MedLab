<?php
class Doctor {
    //подключение к бд и к таблице
    private $conn ;
    private string $table_name = "doctors";

    public function __construct($db) {
        $this->conn = $db;
    }

    //Fetch All Categories  with ID 
    function get_doctors($id_categ) {
        $sql = "
                SELECT * FROM
                ".$this->table_name."
                WHERE id_category = :id_category";   
        
        $result = $this->conn->prepare($sql);
        $result->execute(['id_category'=>$id_categ]);

        $row = $result->FetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    //Search Doctor and Categories
    function searchDocCat($data) {
        $sql = "
            SELECT d.id_doctor, d.doctor_name, d.doctor_lastname, d.doctor_secondname, c.id_category, c.title_category
            FROM doctors d
            JOIN categories c ON d.id_category = c.id_category
            WHERE d.doctor_name LIKE :data
            OR d.doctor_lastname LIKE :data
            OR d.doctor_secondname LIKE :data
            OR c.title_category LIKE :data;
        ";
        $result = $this->conn->prepare($sql);
        $result->execute(['data'=> '%' . $data . '%']);

        $row = $result->FetchAll(PDO::FETCH_ASSOC);
        return $row;
    }


    //Display Cards in Doctors Page
    function displayCard($limitNumber, $value) {
        $sql = "
            SELECT doctors.*, categories.*, AVG(review.review_star) as average_rating
            FROM doctors 
            JOIN categories ON doctors.id_category = categories.id_category
            LEFT JOIN review ON doctors.id_doctor = review.id_doctor
            GROUP BY doctors.id_doctor
            ORDER BY average_rating $value
            LIMIT $limitNumber
        ";
        $result = $this->conn->prepare($sql);
        $result->execute();
    
        $row = $result->FetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    

    //Display Sort Category Cards in Doctors Page
    function displayCards($limitNumber) {
        $sql = "
            SELECT *
            FROM doctors d
            JOIN categories c ON d.id_category = c.id_category
            LIMIT $limitNumber
        ";
        $result = $this->conn->prepare($sql);
        $result->execute();

        $row = $result->FetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    function displayInfo($id_doctor) {
        $sql = "
            SELECT *
            FROM doctors d
            JOIN categories c ON d.id_category = c.id_category
            WHERE id_doctor = :id_doctor
        ";
        $result = $this->conn->prepare($sql);
        $result->execute(['id_doctor' => $id_doctor]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

//Display Table Doctors 
function displayDoctorInfo() {
    $sql = "
        SELECT *
        FROM doctors d
        JOIN categories c ON d.id_category = c.id_category
    ";
    $result = $this->conn->prepare($sql);
    $result->execute();

    $row = $result->FetchAll(PDO::FETCH_ASSOC);
    return $row;
}

//Doctor Exist
public function doctor_exist($login) {
    $sql = "SELECT `login` FROM
                                ".$this->table_name."
            WHERE login = :login";
    $result = $this->conn->prepare($sql);
    $result->execute(['login'=>$login]);

    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row;
}


//Create Doctor
public function createDoctor($doctor_name, $doctor_lastname, $doctor_secondname, $id_category, $login, $password) {
    $sql = "
            INSERT INTO
            ".$this->table_name."   
            SET 
                doctor_name=:doctor_name,
                doctor_lastname=:doctor_lastname,
                doctor_secondname=:doctor_secondname,
                id_category=:id_category,
                login=:login,
                password=:password
                ";
    $result = $this->conn->prepare($sql);
    $result->bindParam(":doctor_name", $doctor_name);
    $result->bindParam(":doctor_lastname", $doctor_lastname);
    $result->bindParam(":doctor_secondname", $doctor_secondname);
    $result->bindParam(":id_category", $id_category);
    $result->bindParam(":login", $login);
    $result->bindParam(":password", $password);

    $result->execute();

    return true;
}
 

public function FindCategoryByDoctor($id_doctor) {
    $sql = "
        SELECT *
        FROM doctors d
        JOIN categories c ON d.id_category = c.id_category
        WHERE id_doctor = $id_doctor
    ";
    $result = $this->conn->prepare($sql);
    $result->execute();

    $row = $result->FetchAll(PDO::FETCH_ASSOC);
    return $row;
}

public function updateLogin($login, $id_doctor) {
    // Подготовка SQL-запроса с использованием параметров
    $sql_update_login = "UPDATE 
                        ".$this->table_name." 
                        SET login = :login WHERE id_doctor = :id_doctor";
    
    // Подготовка запроса к базе данных
    $stmt = $this->conn->prepare($sql_update_login);
    
    // Связывание параметров с их значениями
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':id_doctor', $id_doctor);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        return true; // Запрос успешно выполнен
    } else {
        return false; // Ошибка при выполнении запроса
    }
}
public function updatePassword($password, $id_doctor) {
    // Подготовка SQL-запроса с использованием параметров
    $sql_update_login = "UPDATE 
                        ".$this->table_name." 
                        SET password = :password 
                        WHERE id_doctor = :id_doctor";
    
    // Подготовка запроса к базе данных
    $stmt = $this->conn->prepare($sql_update_login);
    
    // Связывание параметров с их значениями
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id_doctor', $id_doctor);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        return true; // Запрос успешно выполнен
    } else {
        return false; // Ошибка при выполнении запроса
    }
}
public function updateExperience($experience, $id_doctor) {
    // Подготовка SQL-запроса с использованием параметров
    $sql_update_login = "UPDATE 
                        ".$this->table_name." 
                        SET experience = :experience 
                        WHERE id_doctor = :id_doctor";
    
    // Подготовка запроса к базе данных
    $stmt = $this->conn->prepare($sql_update_login);
    
    // Связывание параметров с их значениями
    $stmt->bindParam(':experience', $experience);
    $stmt->bindParam(':id_doctor', $id_doctor);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        return true; // Запрос успешно выполнен
    } else {
        return false; // Ошибка при выполнении запроса
    }
}
public function updateDescription($description_doctor, $id_doctor) {
    // Подготовка SQL-запроса с использованием параметров
    $sql_update_login = "UPDATE 
                        ".$this->table_name." 
                        SET description_doctor = :description_doctor 
                        WHERE id_doctor = :id_doctor";
    
    // Подготовка запроса к базе данных
    $stmt = $this->conn->prepare($sql_update_login);
    
    // Связывание параметров с их значениями
    $stmt->bindParam(':description_doctor', $description_doctor);
    $stmt->bindParam(':id_doctor', $id_doctor);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        return true; // Запрос успешно выполнен
    } else {
        return false; // Ошибка при выполнении запроса
    }
}
public function updateWCategory($work_category, $id_doctor) {
    // Подготовка SQL-запроса с использованием параметров
    $sql_update_login = "UPDATE 
                        ".$this->table_name." 
                        SET work_category = :work_category 
                        WHERE id_doctor = :id_doctor";
    
    // Подготовка запроса к базе данных
    $stmt = $this->conn->prepare($sql_update_login);
    
    // Связывание параметров с их значениями
    $stmt->bindParam(':work_category', $work_category);
    $stmt->bindParam(':id_doctor', $id_doctor);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        return true; // Запрос успешно выполнен
    } else {
        return false; // Ошибка при выполнении запроса
    }
}
public function updateType($type, $id_doctor) {
    // Подготовка SQL-запроса с использованием параметров
    $sql_update_login = "UPDATE 
                        ".$this->table_name." 
                        SET type = :type 
                        WHERE id_doctor = :id_doctor";
    
    // Подготовка запроса к базе данных
    $stmt = $this->conn->prepare($sql_update_login);
    
    // Связывание параметров с их значениями
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':id_doctor', $id_doctor);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        return true; // Запрос успешно выполнен
    } else {
        return false; // Ошибка при выполнении запроса
    }
}
public function deleteRow($id_doctorservice) {
    // Подготовка SQL-запроса с использованием параметров
    $sql_update_login = "DELETE FROM
                        iddoctorservice
                        WHERE id_doctorservice = :id_doctorservice";
    
    // Подготовка запроса к базе данных
    $stmt = $this->conn->prepare($sql_update_login);
    
    // Связывание параметров с их значениями
    $stmt->bindParam(':id_doctorservice', $id_doctorservice);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        return true; // Запрос успешно выполнен
    } else {
        return false; // Ошибка при выполнении запроса
    }
}
public function cancelRow($id_doctorservice) {

    $sql = "
            SELECT id_doctor, id_category, time_work, date_work FROM
            iddoctorservice
            WHERE id_doctorservice = :id_doctorservice
            "; 
    $result = $this->conn->prepare($sql);
    $result->execute(['id_doctorservice'=>$id_doctorservice]);

    if($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $id_doctor = $row["id_doctor"];
        // $id_category = $row["id_category"];
        $time_reserve = $row["time_work"];
        $date_reserve = $row["date_work"];
        // $status = 'cancel';

        // Обновление данных в таблицу iddoctorservice
        $sql_insert = "UPDATE iddoctorservice
                    SET status = 'cancel'
                    WHERE id_doctorservice = :id_doctorservice
                    "; 
        
        $stmt_insert = $this->conn->prepare($sql_insert);
        $stmt_insert->execute(['id_doctorservice'=>$id_doctorservice]);
        if ($stmt_insert) {
            // Update doctorservice
            $sql_update_status = "UPDATE reservation
                    SET status = 'cancel'
                    WHERE id_doctor = :id_doctor AND
                        date_reserve = :date_reserve AND
                        time_reserve = :time_reserve    ";

            $stmt_update_status = $this->conn->prepare($sql_update_status);
            $stmt_update_status->execute(['id_doctor' => $id_doctor,
                                            'date_reserve' => $date_reserve,
                                            'time_reserve' => $time_reserve]);

            if($stmt_update_status) {
                return $stmt_insert;
            } else {
                echo "Ошибка: " . $stmt_update_status->error;
            }
            
        } else {
            echo "Ошибка: " . $stmt_insert->error;
        }
    } else {
        echo "Запись с id_doctor $id_doctorservice не найдена в таблице reservations.";
    }
}

public function deleteRowDoctor($id_doctor) {
    // Подготовка SQL-запроса с использованием параметров
    $sql_update_login = "
        DELETE FROM
        doctors
        WHERE id_doctor = :id_doctor";
    
    // Подготовка запроса к базе данных
    $stmt = $this->conn->prepare($sql_update_login);
    
    // Связывание параметров с их значениями
    $stmt->bindParam(':id_doctor', $id_doctor);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        return true; // Запрос успешно выполнен
    } else {
        return false; // Ошибка при выполнении запроса
    }
}

 
}

?>