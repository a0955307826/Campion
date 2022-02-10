<?php 

    include("../Lib/Util.php");
    
    $visible = $_POST["visible"];
    $evaluation_id = $_POST["evaluation_id"];

    $sql = "UPDATE EVALUATION SET IS_VISIBLE = ? WHERE ID = ?";

    //執行
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1 , $visible);
    $statement->bindValue(2 , $evaluation_id);
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo json_encode($data)
?>