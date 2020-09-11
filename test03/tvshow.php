
<?php
  require "../includes/config.php";
  $pid = $_GET["pid"];
  $name = $_GET["name"];
  $vid = $_GET["vid"];
  if ($vid==NULL) {
    $vid = "7BHQGLbjdT0";
  }
  session_start();
  //先從Session中取出user_type
  //以備後續確認瀏覽者的身份別
  $user_type = $_SESSION["user_type"];
  $tag = "<iframe width='560' height='320' src='https://www.youtube.com/embed/^^^^' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
  $imgtag = "https://i.ytimg.com/vi/^^^^/hqdefault.jpg";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body {
        font-family:微軟正黑體;
    }
</style>
<title>我的播放清單~~</title>
</head>
<body>   
<h2><?php echo $name; ?></h2>
<hr>
<?php include "../includes/menu.php"; ?>
<hr>
<?php


//以下建立SQL查詢指令
$sql = "SELECT * FROM video WHERE pid='$pid'";
//以下執行SQL查詢指令，並把結果傳回給$result變數
$result = $conn->query($sql);
if ($user_type!=NULL) {
  //如果已經登入的話，要有可以新增影片的表單
  echo "<form method=POST action=addvideo.php>";
  echo "<input type=hidden value='$pid' name=pid>";
  echo "<input type=hidden value='$name' name=name>";
  echo "影片名稱：<input type=text name=title size=40>";
  echo "影片ID：<input type=text name=vid size=15>";
  echo "<input type=submit value=新增>";
  echo "</form>";
}
if ($result->num_rows > 0) { //檢查記錄的數量，看看是否有資料
  // output data of each row
  echo "<center>";

  echo "<table width=800>";
  echo "<tr><td align=center>";
  echo str_replace("^^^^", $vid, $tag);
  echo "</td></tr>";
  echo "</table>";

  echo "<table width=800>";
  $vc = 0;
  echo "<tr bgcolor=#ffffcc>";
  while($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $vidindb = $row["vid"];
    echo "<td>"; 
    echo "<a href='tvshow.php?pid=$pid&name=$name&vid=$vidindb'>";
    echo "<img src='" . 
      str_replace("^^^^", $row["vid"], $imgtag) . 
      "' width=200></a><br>"; 
    echo $row["title"] . "<br>";
    // 如果是已登入使用者，要加上貼文管理（連結）的欄位
    if ($user_type!=NULL) {
      echo "<a href='delvideo.php?id=$id&pid=$pid&name=$name'>刪除</a>";
    }
    $vc++;
    echo "<br>$vc";
    echo "</td>";
    if ($vc%4==0) {
      echo "</tr><tr bgcolor=#ffffcc>";
    }
  }
  echo "</tr>";
  echo "</table></center>";
} else {
  echo "0 results"; // 如果資料表中沒有記錄，要顯示的內容
}
$conn->close();
?>
<hr>
<?php include "../includes/footer.php"; ?>
</body>
</html>