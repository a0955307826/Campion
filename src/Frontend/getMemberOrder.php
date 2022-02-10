<?php

    include('../Lib/Util.php');
    include('../Lib/Member.php');  

    $sql = "select 
                o.ID OID, #訂單編號
                o.MEMBER_ID, #訂單會員編號
                o.ORDER_DATE, #訂單日期

                ord.ODID, #訂單明細編號
                ord.ITINERARY_ID, #行程編號

                i.COUNTRY, #國家
                i.CITY,    #城市
                i.INAME,   #行程名稱
                i.IMG,     #圖片
                i.BATCH,   #梯次
                i.START_DATE, #開始日期
                i.END_DATE,  #結束日期

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
                    ID, NAME INAME, COUNTRY, CITY, BATCH, IMG, START_DATE, END_DATE,PRICE
                from ITINERARY) i
            on i.ID = ord.ITINERARY_ID
            #order by OID
            where o.MEMBER_ID = ?
            ;";

    $statement = getPDO() -> prepare($sql);
    $statement -> bindValue(1 , getMemberID()); 
    $statement -> execute();
    $data = $statement -> fetchAll();
    echo json_encode($data);

?>