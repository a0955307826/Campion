<?php
    // 更新行程圖片
    //------------------------ 將更新圖片上傳到指定專案資料夾 ------------------------
    // 判斷是否上傳成功
    // $item_ID = $_POST["item_ID"];
    $newImg = $_FILES['file'];
    if($newImg["error"] > 0){ // 陣列
        echo "上傳失敗: 錯誤代碼".$newImg["error"];
    }else{
        if($newImg){
            //取得上傳的檔案資訊
            $fileName = $newImg["name"];    //檔案名稱含副檔名（二維陣列）        
            $filePath_Temp = $newImg["tmp_name"];   //Server上的暫存檔路徑含檔名        
            $fileType = $newImg["type"];    //檔案種類        
           
            // Web根目錄真實路徑
            $ServerRoot = $_SERVER["DOCUMENT_ROOT"]; 
            // server團專資料夾位置
            // $fileProject = "/tfd104/g2/";
            // 檔案最終存放位置
            $filePath = $ServerRoot."/tfd104/g2/dist/images/summer_camp/".$fileName; //上線版
            // $filePath = $ServerRoot."/project_g2/dist/images/summer_camp/".$fileName; //開發版
       
            // 先判斷檔案格式是否正確
            // 再將暫存檔搬移到正確位置
            if(getExtensionName($filePath) == 'jpg' || getExtensionName($filePath) == 'png'){
                move_uploaded_file($filePath_Temp, $filePath); // (檔案原本的位置, 要搬移到哪裡)
                
            }else{
                echo '檔案格式錯誤，請重新上傳';
                echo '<br>';
            }

        }

    }

    // // 取得檔案副檔名：前後端 double check 雙保險：上傳檔案格式是否合乎規定（前端也要先驗證阻擋！）
    function getExtensionName($filePath){
        $path_parts = pathinfo($filePath);
        return $path_parts["extension"];
    }

    // pathinfo_dirname   //完整路徑
    // pathinfo_basename  //完整檔名
    // pathinfo_extension //副檔名
    // pathinfo_filename  //檔名

    header('location: ../admin_commodity.html');
    
?>