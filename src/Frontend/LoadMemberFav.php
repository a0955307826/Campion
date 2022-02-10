<?php
    include('../Lib/Util.php'); 
    include('../Lib/Member.php'); 

    $sql = "SELECT * FROM `ITINERARY_LIKE` JOIN `ITINERARY` ON `ITINERARY_LIKE`.`ITINERARY_NUMBER` = `ITINERARY`.`ID` WHERE `ITINERARY_LIKE`.`MEMBER_ID` = ?";

    $statement = getPDO() -> prepare($sql);
    $statement -> bindValue(1, getMemberID());
    $statement -> execute();
    $data = $statement -> fetchAll();
    echo json_encode($data);
?>