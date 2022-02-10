<?php

    include('../Lib/Util.php'); 
        
    $sql = "delete from SHOPPING_CART where ID != ''";    
    $statement = getPDO()->prepare($sql); // 預載
   
    $statement->execute(); // 執行

   
    echo '刪除成功!';

?>