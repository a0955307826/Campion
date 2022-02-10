<?php

    include('../Lib/Util.php'); 

    $sql = "SELECT * FROM `ITINERARY_LIKE`, `ITINERARY` WHERE `ITINERARY`.`ID` = `ITINERARY_LIKE`.`ITINERARY_NUMBER`";

    $statement = getPDO() -> prepare($sql);
    $statement -> execute();
    $data = $statement -> fetchAll();
    echo json_encode($data);

?>