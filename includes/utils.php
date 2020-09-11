<?php  //區域變數，所有在函數裡面定義的變數，或使用的變數
function get_counter($target) {
    global $conn; //宣告我要使用的$conn，是外面的那個全域變數$conn
    //設定查詢語言，要找的是$target那個記錄值(name, value)
    $sql = "SELECT * from counter WHERE name='$target'";
    $result = $conn->query($sql); //實際執行查詢
    if ($result->num_rows > 0) {  //檢查是否找得到這筆記錄
        $row = $result->fetch_assoc();  //如果有的話就取出
        $value = $row["value"];   //把value欄位的內容放到$value變數中
    } else {
        $value = 0;  //如果找不到，就把$value設定為0
    }
    echo "參觀人次：" . $value . "人。<br>"; //把$value的結果輸出到首頁
    $value ++;
    $sql = "UPDATE counter SET value='$value' WHERE name='$target'";
    $conn->query($sql);
}

function get_video_numbers($id) {
    global $conn;
    $sql = "SELECT COUNT(*) AS numbers from video WHERE pid='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();
        $numbers = $row["numbers"];
    } else {
        $numbers = 0;
    }
    return $numbers;
}
?>