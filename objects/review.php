<?php

class Review {
    //подключение к бд и к таблице
    private $conn ;
    private string $table_name = "review";

    public function __construct($db) {
        $this->conn = $db;
    }


    function displayNumReview($id_doctor) {
        $sql = "
            SELECT COUNT(*)
            FROM
            ".$this->table_name."
            WHERE id_doctor = $id_doctor
            
        ";
        $result = $this->conn->prepare($sql);
        $result->execute();

        $row = $result->FetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function reviewStar($id_doctor) {
        $sql = "
            SELECT AVG(review_star)
            FROM
            ".$this->table_name."
            WHERE id_doctor = $id_doctor
            
        ";
        $result = $this->conn->prepare($sql);
        $result->execute();

        $row = $result->Fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    function doctorReview($id_doctor) {
        $sql = "
        SELECT *
        FROM review r
        JOIN users u ON r.id_user = u.id_user
        WHERE id_doctor = $id_doctor
        ";
        
        $result = $this->conn->prepare($sql);
        $result->execute();

        $row = $result->FetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    function insertDataReview($id_reserve, $id_user, $text_review, $review_star, $id_doctor) {
        $sql = "  
            INSERT INTO
            ".$this->table_name."   
            SET 
                id_user=:id_user,
                text_review=:text_review,
                review_star=:review_star,
                id_doctor=:id_doctor
                ";
        $result = $this->conn->prepare($sql);
        
        $result->execute(['id_user'=>$id_user,
                                'text_review'=>$text_review,
                                'review_star'=>$review_star,
                                'id_doctor'=>$id_doctor
                            ]);

        if($result) {
            //Update Reservation Table
            $sql_update_status = "UPDATE
                        reservation
                     SET status = 'завершен'
                     WHERE id_reserve = :id_reserve";

            $stmt_update_status = $this->conn->prepare($sql_update_status);
            $stmt_update_status->execute(['id_reserve' => $id_reserve]);

            if($stmt_update_status) {
                return $result;
            } else {
                echo "Ошибка: " . $stmt_update_status->error;
            }
        } else {
            echo "Ошибка: " . $result->error;
        }
    }
}
    

?>