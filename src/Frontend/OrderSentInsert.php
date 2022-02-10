<?php        	
	include("../Lib/Member.php");
    include("../Lib/Util.php");

    // ==== 取得訂單明細 ==== //
    $lineitems = $_POST['lineitems'];
    
    $total = $_POST['total'];
    $paychoose = $_POST['paychoose'];
    // $neworderID = $_POST['newOrderID'];

    // 取得新增訂單ID
    $PDO = getPDO();
    $orderID = insertOrder($PDO,  $total, $paychoose);

    // 新增訂單寫入訂單明細
    insertOrderDetails($PDO, $orderID);

    // 清空原本購物車內的商品紀錄->更新Status=2(已結帳)
    updateCar($PDO, $lineitems);

    // ---------------- 自訂義function ------------------ //

    // ==== 寫入訂單資料表 ==== //
    function insertOrder($PDO , $total, $paychoose){
        $sql = "INSERT INTO `ORDER`(MEMBER_ID, TOTAL_AMOUNT, PAY_CHOOSE, PAY_STATE, ORDER_DATE, ORDER_STATE) VALUES(?, ?, ?, ?, NOW(),'訂單成立')";
        $statement = $PDO->prepare($sql);
        $statement->bindValue(1, getMemberID());
        $statement->bindValue(2 , $total);
        $statement->bindValue(3 , $paychoose);
        if($paychoose == '信用卡付款'){
            $statement->bindValue(4 , '已付款');
        }else if($paychoose == '轉帳付款'){
            $statement->bindValue(4 , '未付款');
        }
        $statement->execute();
    
        return $PDO ->lastInsertId();
    }


    // ==== 寫入訂單明細資料表 ==== //
    function insertOrderDetails($PDO, $orderID){
        $sql = "SELECT SHOPPING_CART.ID,
                    SHOPPING_CART.MEMBER_ID,
                    SHOPPING_CART.ITINERARY_ID,
                    SHOPPING_CART.BATCH_ID,
                    SHOPPING_CART.ATTENDEES,
                    ITINERARY.PRICE
                FROM SHOPPING_CART
                JOIN ITINERARY ON SHOPPING_CART.ITINERARY_ID = ITINERARY.ID 
                where SHOPPING_CART.Status = 2";
        //執行
        $statement = getPDO()->prepare($sql);     
        $statement->execute();
        $data = $statement->fetchAll();
    
        foreach($data as $index => $row){ // as $index => $value (變數可以自訂)
            $sql = "INSERT INTO `ORDER_DETAILS`(`ORDER_ID`,`ITINERARY_ID`,`BATCH_ID`,`ATTENDEES`,`UNIT_PRICE`) VALUES(?, ?, ?, ?, ?)";
            $statement = $PDO->prepare($sql);
            $statement->bindValue(1 , $orderID);
            $statement->bindValue(2 , $row['ITINERARY_ID']);
            $statement->bindValue(3 , $row['BATCH_ID']);
            $statement->bindValue(4 , $row['ATTENDEES']);
            $statement->bindValue(5 , $row['PRICE']);
            
            $statement->execute();
        }
    }

    // ==== 更新購物車狀態 ==== //
    function updateCar($PDO, $lineitems){
        foreach($lineitems as $index => $row){
            // echo $row['ID'];
            $sql = "DELETE FROM `SHOPPING_CART` WHERE ID = ?";
            $statement = $PDO->prepare($sql);
            $statement->bindValue(1 , $row['ID']);
            $statement->execute();
        }
    }

    echo '成功!';
    
    
    



   
    

    // 回傳json
    // echo json_encode($OID);
    // print_r($OID);
    // $OID = getPDO();
    // return getPDO() ->lastInsertId();
    

    // $sql = "SELECT * FROM `ORDER` WHERE MEMBER_ID = ?";
    // $statement = getPDO()->prepare($sql);
    // $statement->bindValue(1 , getMemberID());
    // $statement->execute();
    // $data = $statement->fetchAll();
    // $data = $statement->fetchAll();

    // foreach($cart as $index => $value){ // as $index => $value (變數可以自訂)
    //     $statement = getPDO()->prepare($sql);
    //     $statement->bindValue(1, $attendess);
    //     $statement->bindValue(2 , $value);
    //     $statement->execute();
    //     $data = $statement->fetchAll(); 
    // }
    
?>