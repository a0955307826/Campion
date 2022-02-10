<?php
include "../Lib/Util.php";
$ITINERARY_NUMBER = $_POST['ITINERARY_NUMBER'];

// 建立SQL
$sql = "SELECT * FROM ITINERARY_LIKE WHERE ITINERARY_NUMBER = ?";
$statement = getPDO() -> prepare($sql);
$statement-> bindValue(1, $ITINERARY_NUMBER);
$statement-> execute();
$data = $statement -> fetchAll();
echo json_encode($data);

?>