<?php
class TimeTable {
    //подключение к бд и к таблице
    private $conn ;
    private string $table_name = "reservation";

    public function __construct($db) {
        $this->conn = $db;
    }


    function getTimeTableUser($id_user) {
        $today = date('Y-m-d');
        $sql = "
        SELECT *
        FROM reservation
        INNER JOIN categories ON reservation.id_category = categories.id_category
        INNER JOIN doctors ON reservation.id_doctor = doctors.id_doctor
        WHERE id_user =:id_user AND date_reserve >= :today
        AND status = :status
        ;   
            ";
        $result = $this->conn->prepare($sql);
        $result->execute(['id_user'=>$id_user, 'today' => $today, 'status' => 'ожидание']);

        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function getTimeTableUserHome($id_user) {
        $today = date('Y-m-d');
        $sql = "
        SELECT *
        FROM reservation
        INNER JOIN categories ON reservation.id_category = categories.id_category
        INNER JOIN doctors ON reservation.id_doctor = doctors.id_doctor
        WHERE id_user =:id_user
        ORDER BY date_reserve ASC, time_reserve ASC
        ;   
            ";
        $result = $this->conn->prepare($sql);
        $result->execute(['id_user'=>$id_user]);

        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function countTableUser($id_user) {
        $today = date('Y-m-d');
        $sqlCount = "
        SELECT COUNT(*)
        FROM reservation
        WHERE id_user = :id_user AND date_reserve >= :today
        AND status = :status
        ";
        $resultCount = $this->conn->prepare($sqlCount);
        $resultCount->execute(['id_user' => $id_user, 'today' => $today, 'status' => 'ожидание']);

        $rowCount = $resultCount->fetchColumn();
        return ['count' => $rowCount];
    }

    function getReserveInfo($id_reserve) {
        $today = date('Y-m-d');
        $sql = "
        SELECT *
        FROM reservation
        INNER JOIN categories ON reservation.id_category = categories.id_category
        INNER JOIN doctors ON reservation.id_doctor = doctors.id_doctor
        WHERE id_reserve =:id_reserve 
        ";
        $result = $this->conn->prepare($sql);
        $result->execute(['id_reserve' => $id_reserve]);

        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    
}