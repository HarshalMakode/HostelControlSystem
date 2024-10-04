<?php
    include("includes/dbconfig.php");

    $status = 0; 

        if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "SELECT amount FROM students WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $student = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($student['amount'])) {
            $status = 1; // Payment is pending
        }
    }

    echo json_encode(['status' => $status]);
?>