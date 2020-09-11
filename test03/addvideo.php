<?php
    //本程式實際執行張貼（插入）新的影片項目記錄
    $title = $_POST["title"];
    $vid = $_POST["vid"];
    $pid = $_POST["pid"];
    $name = $_POST["name"];

    //如果標題或vid是空的（任一項成立的話），就要返回tvshow.php
    if ($title==NULL || $vid==NULL) {
        header("Location: tvshow.php?pid=$pid&name=$name");
        exit;
    }
    require "../includes/config.php";
    //要新增資料之前，先檢查，該筆vid有沒有在資料庫裡面
    $sql = "SELECT * FROM video WHERE vid='$vid'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) 
    {
        //要使用SQL 的 INSERT INTO 指令 
        $sql = "INSERT INTO video (title, vid, pid) values ('$title', '$vid', '$pid')";
        //以下執行SQL查詢指令，並把結果傳回給$result變數
        $conn->query($sql);
    }
    $conn->close();
    //資料庫操作完畢之後，隨即轉址回練習首頁
    header("Location: tvshow.php?pid=$pid&name=$name");
    exit;
?>