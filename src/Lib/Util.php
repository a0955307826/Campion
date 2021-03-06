<?php

    //取得PDO物件
    function getPDO(){
 
        // 本機端
        // $db_host = "127.0.0.1";
        // $db_user = "root";
        // $db_pass = "password";
        // $db_select = "CAMPION"; 

        // 伺服器端
        $db_host = "127.0.0.1";
        $db_user = "tibamefe_since2021";
        $db_pass = "vwRBSb.j&K#E";
        $db_select = "tibamefe_tfd104g2";

        //建立資料庫連線物件
        $dsn = "mysql:host=".$db_host.";dbname=".$db_select;

        //建立PDO物件，並放入指定的相關資料
        $pdo = new PDO($dsn, $db_user, $db_pass);

        return $pdo;
        
    }

    //上傳檔案的放置位置(路徑)
    function getFilePath(){        

        //Apache實際的根目錄路徑
        $ServerRoot = $_SERVER["DOCUMENT_ROOT"];

        //Apache根目錄之下的檔案存放路徑
        $filePath = "/project_g2/dist/images/";
        
        return $ServerRoot.$filePath;

    }

      // 取得用戶
      function getMemberByAccount($account){
        $member_sql = "SELECT * FROM MEMBER WHERE ACCOUNT = ?";
    
        //執行
        $statement = getPDO()->prepare($member_sql);
        $statement->bindValue(1 , $account);    
        $statement->execute();
        $data = $statement->fetchAll();
    
        return array_values($data)[0];
        }

?>
