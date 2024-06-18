<?php
class Service {
    //подключение к бд и к таблице
    private $conn ;
    private string $table_name = "services";

    private int $id_service;
    private string $title_service;
    private string $description_service;
    private int $price;
    private int $id_category;
    private $created;
    // public $modified;

    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function service_exist($title_service) {
        $sql = "SELECT title_service FROM
                                    ".$this->table_name."
                WHERE title_service = :title_service";
        $result = $this->conn->prepare($sql);
        $result->execute(['title_service'=>$title_service]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function createService($title_service, $description_service, $price, $id_category) 
    {
        $sql = "
                        INSERT INTO
                        ".$this->table_name."   
                        SET 
                            title_service=:title_service,
                            description_service=:description_service,
                            price=:price,
                            id_category=:id_category
                            ";
        $result = $this->conn->prepare($sql);
        $result->bindParam(":title_service", $title_service);
        $result->bindParam(":description_service", $description_service);
        $result->bindParam(":price", $price);
        $result->bindParam(":id_category", $id_category);

        $result->execute();

        return true;
    }


    function showServices ($id_category) {
        $sql = "
                        SELECT * FROM
                        ".$this->table_name."   
                        WHERE id_category=:id_category
                        ";
        $result = $this->conn->prepare($sql);
        $result->execute(['id_category'=>$id_category]);

        return $result;
    }


    //Fetch All Categories  with ID 
    public function getServices() {
        $sql = "
            SELECT *
            FROM services s
            JOIN categories c ON s.id_category = c.id_category
        ";
        $result = $this->conn->prepare($sql);
        $result->execute();

        $row = $result->FetchAll(PDO::FETCH_ASSOC);
        return $row;
    }


    public function deleteRow($id_service) {
        // Подготовка SQL-запроса с использованием параметров
        $sql = "DELETE FROM
                ".$this->table_name."  
                WHERE id_service = :id_service";
        
        // Подготовка запроса к базе данных
        $stmt = $this->conn->prepare($sql);
        
        // Связывание параметров с их значениями
        $stmt->bindParam(':id_service', $id_service);
        
        // Выполнение запроса
        if ($stmt->execute()) {
            return true; // Запрос успешно выполнен
        } else {
            return false; // Ошибка при выполнении запроса
        }
    }

}

?>