<?php
class DoctorService {
    //подключение к бд и к таблице
    private $conn ;
    private string $table_name = "iddoctorservice";

    public function __construct($db) {
        $this->conn = $db;
    }

    //Fetch All Categories  with ID 
    function getDoctorService($id_category, $id_doctor) {
        $sql = "
                SELECT * FROM
                ".$this->table_name."
                WHERE id_category = :id_category
                AND id_doctor =:id_doctor
                AND status = 'free'
                AND (
                    (date_work = CURDATE() AND time_work >= DATE_ADD(NOW(), INTERVAL 2 HOUR))
                    OR date_work > CURDATE()
                  );
                ";   
        
        $result = $this->conn->prepare($sql);
        $result->execute(['id_category'=>$id_category, 'id_doctor'=>$id_doctor]);
        // $result->execute(['id_doctor'=>$id_doctor]);

        $row = $result->FetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    //Filter Date of date_work
    function filterDate($id_category, $id_doctor, $date_work) {
        $sql = "
                SELECT * FROM
                ".$this->table_name."
                WHERE id_category = :id_category
                AND id_doctor =:id_doctor
                AND status = 'free'
                AND date_work =:date_work
                ";   
        
        $result = $this->conn->prepare($sql);
        $result->execute(['id_category'=>$id_category, 'id_doctor'=>$id_doctor, 'date_work'=>$date_work]);

        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }


    //Insert Reservation Information;
    function insertData($id_user, $id_doctorservice) {
        $sql = "
                SELECT id_doctor, id_category, time_work, date_work FROM
                ".$this->table_name."
                WHERE id_doctorservice = :id_doctorservice
                "; 
        $result = $this->conn->prepare($sql);
        $result->execute(['id_doctorservice'=>$id_doctorservice]);

        if($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $id_doctor = $row["id_doctor"];
            $id_category = $row["id_category"];
            $time_reserve = $row["time_work"];
            $date_reserve = $row["date_work"];
            $status = 'confirmed';

            // Вставка данных в таблицу Reservation
            $sql_insert = "INSERT INTO Reservation
                        SET 
                        id_user=:id_user,
                        date_reserve=:date_reserve,
                        time_reserve=:time_reserve,
                        id_doctor=:id_doctor,
                        id_category=:id_category,
                        status=:status
                        "; 
            
            $stmt_insert = $this->conn->prepare($sql_insert);
            $stmt_insert->execute(['id_user'=>$id_user,
                                    'date_reserve'=>$date_reserve,
                                    'time_reserve'=>$time_reserve,
                                    'id_doctor'=>$id_doctor,
                                    'id_category'=>$id_category,
                                    'status'=>$status
                                ]);
            if ($stmt_insert) {
                // Update doctorservice
                $sql_update_status = "UPDATE ".$this->table_name."
                     SET status = 'reserve'
                     WHERE id_doctorservice = :id_doctorservice";

                $stmt_update_status = $this->conn->prepare($sql_update_status);
                $stmt_update_status->execute(['id_doctorservice' => $id_doctorservice]);

                if($stmt_update_status) {
                    return $stmt_insert;
                } else {
                    echo "Ошибка: " . $stmt_update_status->error;
                }
                
            } else {
                echo "Ошибка: " . $stmt_insert->error;
            }
        } else {
            echo "Запись с id_doctorservice $id_doctorservice не найдена в таблице Iddoctorservice.";
        }
    }


    //Get TimeTable Doctor
    function getTimeTableDoctorHome($id_doctor) {
        $today = date('Y-m-d');
        $sql = "
        SELECT *
        FROM
        ".$this->table_name."
        WHERE id_doctor =:id_doctor AND date_work >= :today
        AND status = :status
        ORDER BY date_work ASC, time_work ASC  
        ";
        $result = $this->conn->prepare($sql);
        $result->execute(['id_doctor'=>$id_doctor, 'today' => $today, 'status' => 'reserve']);

        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function getTimeTableDoctor($id_doctor) {
        $today = date('Y-m-d');
        $sql = "
        SELECT *
        FROM
        ".$this->table_name."
        WHERE id_doctor =:id_doctor AND date_work >= :today
        ORDER BY date_work ASC, time_work ASC   
        ";
        $result = $this->conn->prepare($sql);
        $result->execute(['id_doctor'=>$id_doctor, 'today' => $today]);

        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}   

?>