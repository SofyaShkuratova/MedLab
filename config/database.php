<?php
class Database
{
    // укажите свои собственные учетные данные для базы данных
    private string $host = "localhost";
    private string $db_name = "medlab";
    private string $db_username = "root";
    private string $db_password = "root";
    public $conn ;

    // получение соединения с базой данных
    public function getConnection () {  
        $this ->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->db_username, $this->db_password);
            // echo "Соединение установлено";
        } catch (PDOException $exception) {
            echo "Ошибка соединения: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>