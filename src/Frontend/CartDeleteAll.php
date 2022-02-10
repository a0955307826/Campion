<?php        	
	include("../Lib/Member.php");
    include("../Lib/Util.php");

    //取得購物車商品--------------------------------------------
    $productID = $_GET['products_ID'];
    // $aaa = json_decode($productID)
    echo $productID;

    // //建立SQL
    $sql = "DELETE FROM SHOPPING_CART WHERE ID = ?";
        
    // //執行
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1 , $productID);
    $statement->execute();
    $data = $statement->fetchAll();

    // //回傳json
    echo json_encode($data); 
?>