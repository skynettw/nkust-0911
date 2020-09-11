<?php
    //本程式實際執行張貼（插入）資料記錄
    //先取得要新增的播放清單（從表單來，POST協定）
    //取得的播放清單名稱放到$playlistname變數中備用
    $playlistname = $_POST["playlistname"];
    //如果名字是空的，就要返回index.php
    if ($playlistname==NULL) {
        header("Location: index.php");
        exit;
    }
    require "../includes/config.php";
    //要使用SQL 的 INSERT INTO 指令 
    $sql = "INSERT INTO playlist (name) values ('$playlistname')";
    //以下執行SQL查詢指令，並把結果傳回給$result變數
    $result = $conn->query($sql);
    $conn->close();
    //資料庫操作完畢之後，隨即轉址回練習首頁
    header("Location: index.php");
    exit;
?>