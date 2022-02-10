<?php

    $orderID = $_POST['OID']; // 取得訂單編號
    // $OID = json_decode($orderID);
    include('../Lib/Util.php'); 
    
    // echo $orderID;
    $sql = "
        select 
            o.ID OID, #訂單編號
            
            ord.ODID, #訂單明細編號
            ord.ITINERARY_ID, #行程編號
            i.INAME,
            ord.UNIT_PRICE,
            ord.ATTENDEES, #各行程參與人數
            (ord.UNIT_PRICE * ord.ATTENDEES) TOTAL #訂單單筆行程金額
        from `ORDER` o
        -- join ORDER_DETAILS
        join
            (select 
                ID ODID, ORDER_ID, ITINERARY_ID, ATTENDEES, UNIT_PRICE
            from ORDER_DETAILS
            group by ODID, ORDER_ID, ITINERARY_ID, ATTENDEES, UNIT_PRICE) ord
        on o.ID = ord.ORDER_ID
        -- join ITINERARY
        join
            (select 
                ID, NAME INAME, PRICE
            from ITINERARY) i
        on i.ID = ord.ITINERARY_ID
        #order by OID
        where o.ID = ?
        ;
    ";
    $statement = getPDO()->prepare($sql); // 預載
    $statement->bindValue(1, $orderID); // (第n個?, 值 || 變數)
    $statement->execute(); // 執行

    $data = $statement->fetchAll();
    echo json_encode($data); // 打包成 json 格式

?>