<?php
	include("../Lib/Member.php");
    include("../Lib/Util.php");

    $sql = "SELECT COUNT(*) FROM `ORDER`";
    // //執行
    $statement = getPDO()->prepare($sql);     
    $statement->execute();
    $data = $statement->fetchAll();
    echo json_encode($data);
?>