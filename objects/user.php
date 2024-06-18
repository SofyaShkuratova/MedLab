<?php

class Users  {

    //подключение к бд и к таблице
    public $conn ;

    private string $table_name = "users";


    public function __construct($db) {
        $this->conn = $db;
    }

    //Register New User
    public function register($name, $last_name, $second_name, $phone, $email, $id_role, $age, $created_at, $password) {
        $sql = "  
                INSERT INTO
                ".$this->table_name."   
                SET 
                    name=:name,
                    last_name=:last_name,
                    second_name=:second_name,
                    phone=:phone,
                    email=:email,
                    id_role=:id_role,
                    age=:age,
                    created_at=:created_at,
                    password=:password
                    ";
        $result = $this->conn->prepare($sql);
        
        $result->bindParam(":name", $name);
        $result->bindParam(":last_name", $last_name);
        $result->bindParam(":second_name", $second_name);
        $result->bindParam(":phone", $phone);
        $result->bindParam(":email", $email);
        $result->bindParam(":id_role", $id_role);
        $result->bindParam(":age", $age);
        $result->bindParam(":created_at", $created_at);
        $result->bindParam(":password", $password);

        $result->execute();

        return true;
    }

    //Check if user already registered by email
    public function user_exist($email) {
        $sql = "SELECT email FROM
                                    ".$this->table_name."
                WHERE email = :email";
        $result = $this->conn->prepare($sql);
        $result->execute(['email'=>$email]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }


    //Check if user already registered by phone
    public function phone_exist($phone) {
        $sql = "SELECT phone FROM
                                    ".$this->table_name."
                WHERE phone =:phone";
        $result = $this->conn->prepare($sql);
        $result->execute(['phone'=>$phone]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    //Check Input
    public function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Error Success Message Alert 
    public function showMessage($type, $message, $bg, $color) {
        echo '
                <div class="' .$type.' error-div mt-10" >
                    <strong>' .$message. '</strong>
                    <button class="close-btn '.$bg.' '.$color.'" >&times;</button>
                </div>';
    }

    public function date() {
        return date('Y-m-d H:i:s');
    }

    //Login Existing
    public function login($phone) {
        $sql = "SELECT `phone`, `password` FROM 
                        ".$this->table_name."
                WHERE `phone` = :phone";
        $result = $this->conn->prepare($sql);
        $result->execute(['phone'=>$phone]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    //Login Doctor
    public function loginDoctor($login) {
        $sql = "SELECT `login`, `password` FROM 
                        doctors
                WHERE `login` = :login";
        $result = $this->conn->prepare($sql);
        $result->execute(['login'=>$login]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    //Current User In Session
    public function currentUser($phone) {
        $sql = "SELECT * FROM 
                    ".$this->table_name."
                WHERE `phone` = :phone";  
        $result = $this->conn->prepare($sql);
        $result->execute(['phone'=>$phone]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    //Current Doctor
    public function currentDoctor($login) {
        $sql = "SELECT * FROM 
                    doctors
                WHERE `login` = :login";  
        $result = $this->conn->prepare($sql);
        $result->execute(['login'=>$login]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    //Password Verify
    public function passwordDoctor($password) {
        $sql = "SELECT `login`, `password` FROM 
                        doctors
                WHERE `password` = :password";
        $result = $this->conn->prepare($sql);
        $result->execute(['password'=>$password]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }


    //Изменение данных пользователя
    public function updatePhone($phone, $id_user) {
        // Подготовка SQL-запроса с использованием параметров
        $sql_update_login = "UPDATE 
                            ".$this->table_name." 
                            SET phone = :phone WHERE id_user = :id_user";
        
        // Подготовка запроса к базе данных
        $stmt = $this->conn->prepare($sql_update_login);
        
        // Связывание параметров с их значениями
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id_user', $id_user);
        
        // Выполнение запроса
        if ($stmt->execute()) {
            return true; // Запрос успешно выполнен
        } else {
            return false; // Ошибка при выполнении запроса
        }
    }

    public function updatePassword($password, $id_user) {
        // Подготовка SQL-запроса с использованием параметров
        $sql_update_login = "UPDATE 
                            ".$this->table_name." 
                            SET password = :password 
                            WHERE id_user = :id_user";
        
        // Подготовка запроса к базе данных
        $stmt = $this->conn->prepare($sql_update_login);
        
        // Связывание параметров с их значениями
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id_user', $id_user);
        
        // Выполнение запроса
        if ($stmt->execute()) {
            return true; // Запрос успешно выполнен
        } else {
            return false; // Ошибка при выполнении запроса
        }
    }

    public function updateAge($age, $id_user) {
        // Подготовка SQL-запроса с использованием параметров
        $sql_update_login = "UPDATE 
                            ".$this->table_name." 
                            SET age = :age 
                            WHERE id_user = :id_user";
        
        // Подготовка запроса к базе данных
        $stmt = $this->conn->prepare($sql_update_login);
        
        // Связывание параметров с их значениями
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':id_user', $id_user);
        
        // Выполнение запроса
        if ($stmt->execute()) {
            return true; // Запрос успешно выполнен
        } else {
            return false; // Ошибка при выполнении запроса
        }
    }

    public function updateSname($second_name, $id_user) {
        // Подготовка SQL-запроса с использованием параметров
        $sql_update_login = "UPDATE 
                            ".$this->table_name." 
                            SET second_name = :second_name 
                            WHERE id_user = :id_user";
        
        // Подготовка запроса к базе данных
        $stmt = $this->conn->prepare($sql_update_login);
        
        // Связывание параметров с их значениями
        $stmt->bindParam(':second_name', $second_name);
        $stmt->bindParam(':id_user', $id_user);
        
        // Выполнение запроса
        if ($stmt->execute()) {
            return true; // Запрос успешно выполнен
        } else {
            return false; // Ошибка при выполнении запроса
        }
    }
    public function updateLname($last_name, $id_user) {
        // Подготовка SQL-запроса с использованием параметров
        $sql_update_login = "UPDATE 
                            ".$this->table_name." 
                            SET last_name = :last_name 
                            WHERE id_user = :id_user";
        
        // Подготовка запроса к базе данных
        $stmt = $this->conn->prepare($sql_update_login);
        
        // Связывание параметров с их значениями
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':id_user', $id_user);
        
        // Выполнение запроса
        if ($stmt->execute()) {
            return true; // Запрос успешно выполнен
        } else {
            return false; // Ошибка при выполнении запроса
        }
    }
    public function updateEmail($email, $id_user) {
        // Подготовка SQL-запроса с использованием параметров
        $sql_update_login = "UPDATE 
                            ".$this->table_name." 
                            SET email = :email 
                            WHERE id_user = :id_user";
        
        // Подготовка запроса к базе данных
        $stmt = $this->conn->prepare($sql_update_login);
        
        // Связывание параметров с их значениями
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_user', $id_user);
        
        // Выполнение запроса
        if ($stmt->execute()) {
            return true; // Запрос успешно выполнен
        } else {
            return false; // Ошибка при выполнении запроса
        }
    }

    public function cancelRowUser($id_reserve) {

        $sql = "
                SELECT id_doctor, id_category, time_reserve, date_reserve FROM
                reservation
                WHERE id_reserve = :id_reserve
                "; 
        $result = $this->conn->prepare($sql);
        $result->execute(['id_reserve'=>$id_reserve]);
    
        if($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
    
            $id_doctor = $row["id_doctor"];
            // $id_category = $row["id_category"];
            $time_work = $row["time_reserve"];
            $date_work = $row["date_reserve"];
            $status = 'cancel';
    
            // Обновление данных в таблицу reservation
            $sql_insert = "UPDATE reservation
                        SET status = :status
                        WHERE id_reserve = :id_reserve
                        "; 
            
            $stmt_insert = $this->conn->prepare($sql_insert);
            $stmt_insert->execute(['status'=>$status, 'id_reserve'=>$id_reserve]);
            if ($stmt_insert) {
                // Update doctorservice
                $sql_update_status = "UPDATE iddoctorservice
                        SET status = 'cancel'
                        WHERE id_doctor = :id_doctor AND
                            date_work = :date_work AND
                            time_work = :time_work    ";
    
                $stmt_update_status = $this->conn->prepare($sql_update_status);
                $stmt_update_status->execute(['id_doctor' => $id_doctor,
                                                'date_work' => $date_work,
                                                'time_work' => $time_work]);
    
                if($stmt_update_status) {
                    return $stmt_insert;
                } else {
                    echo "Ошибка: " . $stmt_update_status->error;
                }
                
            } else {
                echo "Ошибка: " . $stmt_insert->error;
            }
        } else {
            echo "Запись с id_doctor $id_reserve не найдена в таблице reservations.";
        }
    }
}
?>