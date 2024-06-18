<?php
    class Categories {
        // подключение к базе данных и имя таблицы
        private $conn ;
        private $table_name = "categories";

        // свойства объекта
        public $id_category ;
        public $title_category ; 
        public $description_category ;

        public function __construct($db) {
            $this->conn = $db;
        }

        // данный метод используется в раскрывающемся списке
        public function read() {
            // запрос MySQL: выбираем столбцы в таблице «categories»
            $query = "
                        SELECT 
                        id_category, title_category, photo FROM
                        ".$this->table_name."
                        
                    ";
            $result = $this->conn->prepare($query);
            $result->execute();

            return $result;
        }
        //WHERE id_category limit 7 

        //получение названия категории по её ID

        public function readName() {
            //запрос в Mysql
            $query = " 
                        SELECT
                        title_category FROM
                        ".$this->table_name."
                        WHERE id_category = ? limit 0,1
                    ";
            $result = $this->conn->prepare($query);
            $result->bindParam(1, $this->id_category);
            $result->execute();

            $row = $result->fetch(PDO::FETCH_ASSOC);

            $this->title_category = $row["title_category"];
        }

        //Создание категории 
        public function createCategory($title_category, $description_category, $photo) {
            $sql = "
                        INSERT INTO
                        ".$this->table_name."   
                        SET 
                            title_category=:title_category,
                            description_category=:description_category,
                            photo=:photo
                            ";
            $result = $this->conn->prepare($sql);
            $result->bindParam(":title_category", $title_category);
            $result->bindParam(":description_category", $description_category);
            $result->bindParam(":photo", $photo);

            $result->execute();

            return true;
        }

        //Check if user already registered by email
        public function category_exist($title_category) {
        $sql = "SELECT title_category FROM
                                    ".$this->table_name."
                WHERE title_category = :title_category";
        $result = $this->conn->prepare($sql);
        $result->execute(['title_category'=>$title_category]);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
        }

        //Fetch All Categories  with ID 
        public function get_category() {
            $sql = "
                    SELECT * FROM
                    ".$this->table_name."     
            ";
            $result = $this->conn->prepare($sql);
            $result->execute();

            $row = $result->FetchAll(PDO::FETCH_ASSOC);
            return $row;
        }


        //Fetch All Categories for Navigation

        public function navCategory() {
            $sql = "
                    SELECT id_category, title_category FROM
                    ".$this->table_name."     
            ";
            $result = $this->conn->prepare($sql);
            $result->execute();

            $row = $result->FetchAll(PDO::FETCH_ASSOC);
            return $row;
        }


        public function diplayInfoCategory($id_category) {
            $sql = "
                SELECT *
                FROM categories 
                WHERE id_category =:id_category
            ";
            $result = $this->conn->prepare($sql);
            $result->execute(['id_category'=>$id_category]);

            $row = $result->Fetch(PDO::FETCH_ASSOC);
            return $row;
        }


        public function deleteRow($id_category) {
            // Подготовка SQL-запроса с использованием параметров
            $sql = "DELETE FROM
                                ".$this->table_name."  
                                WHERE id_category = :id_category";
            
            // Подготовка запроса к базе данных
            $stmt = $this->conn->prepare($sql);
            
            // Связывание параметров с их значениями
            $stmt->bindParam(':id_category', $id_category);
            
            // Выполнение запроса
            if ($stmt->execute()) {
                return true; // Запрос успешно выполнен
            } else {
                return false; // Ошибка при выполнении запроса
            }
        }
    }

?>