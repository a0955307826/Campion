<?php 
include "../Lib/Util.php";

 // 操作從ajax傳過來的值
$ITINERARY_NUMBER = $_POST['ITINERARY_NUMBER'];

//建立SQL--刪除
// $sql = "DELETE FROM favorite WHERE product_name = ? AND account = ?";
$sql = "DELETE FROM ITINERARY_LIKE WHERE ITINERARY_NUMBER = ?";

// 執行刪除
$statement = getPDO()->prepare($sql);
//給值
$statement->bindValue(1 , $ITINERARY_NUMBER);             
$statement->execute();
echo "done";

?>