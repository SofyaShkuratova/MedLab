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
    public function test_input ($data) {
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
}
?>