<?php

include('../Lib/Util.php'); 
include "../Lib/Member.php";

$memberID = getMemberName();
$ITUNERARYID = $_POST['ITUNERARYID'];

$sqlCheckRepeat = "SELECT * FROM SHOPPING_CART WHERE ITINERARY_ID = ?";
$statementCheck = getPDO()->prepare($sqlCheckRepeat);
$statementCheck->bindValue(1, $ITUNERARYID);
$statementCheck->execute();
$data = $statementCheck->fetchAll();

if($data) {
    echo "商品已存在";
} else {
    $sql = "INSERT INTO `SHOPPING_CART`(`MEMBER_ID`,`ITINERARY_ID`,`BATCH_ID`,`ATTENDEES`,`Status`,`CreateDate`) VALUES(?, ?, 1, 1, 1, CURDATE())";
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1, $memberID);
    $statement->bindValue(2, $ITUNERARYID);
    $statement->execute();
}

?>