<?php        	
	include("../Lib/Member.php");
    include("../Lib/Util.php");

    // 取得購物車商品
    $CartID = $_GET['CartID'];

    $sql = "UPDATE SHOPPING_CART SET Status = 1, UpdateDate = NOW() WHERE ID = ?";
    
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1 , $CartID);
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo json_encode($data); 
?>