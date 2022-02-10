<?php
    $searchId = $_POST['searchId'];
    $searchName = $_POST['searchName'];

    include('../Lib/Util.php'); 
    
    $sql = "SELECT * from `ORDER` o
        -- join MEMBER
        join
            (select 
                ID MID, ACCOUNT, PHONE
            from MEMBER) m
        on o.MEMBER_ID = m.MID 
        where o.ID like ? or m.ACCOUNT like ?";    
    $statement = getPDO()->prepare($sql); // 預載
    $statement->bindValue(1, '%'.$searchId.'%'); 
    $statement->bindValue(2, '%'.$searchName.'%'); 
    $statement->execute(); // 執行

    $data = $statement->fetchAll();
    echo json_encode($data); // 打包成 json 格式

?>