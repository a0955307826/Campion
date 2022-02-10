<?php
    include "../Lib/Util.php";
    include "../Lib/Member.php";

    //建立SQL
    $sql = "SELECT * FROM MEMBER WHERE ID > 2 and ID = ?";

    //給值
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1, getMemberID());
    $statement->execute();
    $data = $statement->fetchAll();

    echo json_encode($data);
?>