<?php        	
	include("../Lib/Member.php");
    include("../Lib/Util.php");

    //取得購物車商品--------------------------------------------
    $CartID = $_GET['CartID'];
    // $attendess = $_GET['attendess'];
    $attendess = $_GET['attendess'];
    
    $cart = json_decode($CartID);
    // print_r($cart);

    $sql = "UPDATE SHOPPING_CART SET ATTENDEES = ?, Status = 2, UpdateDate = NOW() WHERE ID = ?";
    
    foreach($cart as $index => $value){ // as $index => $value (變數可以自訂)
        $statement = getPDO()->prepare($sql);
        $statement->bindValue(1, $attendess);
        $statement->bindValue(2 , $value);
        $statement->execute();
        $data = $statement->fetchAll(); 
    }
    //回傳json
    echo json_encode($data); 
?>