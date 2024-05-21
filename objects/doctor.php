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
            SELECT *
            FROM doctors 
            JOIN categories ON doctors.id_category = categories.id_category
            WHERE doctors.id_doctor 
            ORDER BY doctor_lastname $value
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
 
}

?>