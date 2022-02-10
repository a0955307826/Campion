<?php 
    // 會員發佈評論
    include("../Lib/Util.php");
    include("../Lib/Member.php");
    
    // 取得必要參數
    $account = getMemberID();
    $itineraryId = $_POST["itineraryId"];
    $star = $_POST["star"];
    $content = $_POST["content"];

    // $member = getMemberByAccount($account);

    $insertSql = "INSERT INTO `EVALUATION` (`ITINERARY_ID`, `MEMBER_ID`, `STAR`, `CONTENT`,`DATE`,`IS_VISIBLE`) VALUES (?,?,?,?,NOW(),1);";
    // $member["ID"]
    //執行
    $statement = getPDO()->prepare($insertSql);
    $statement->bindValue(1 , $itineraryId);
    $statement->bindValue(2 , $account);
    $statement->bindValue(3 , $star);
    $statement->bindValue(4 , $content);
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo "<script>alert('發佈成功!'); location.href = '../member.html';</script>";
?>