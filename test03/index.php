<?php
  require "../includes/config.php";
  require "../includes/utils.php";
  session_start();
  //先從Session中取出user_type
  //以備後續確認瀏覽者的身份別
  $user_type = $_SESSION["user_type"];
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
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
</head>
<body>  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class='container'>
<center>
<table width=400>
<tr><td>
<canvas id="myChart" width="400" height="400"></canvas>
</td></tr>
</table>
</center>
  <div class="jumbotron">
  <script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
    <h1 class="display-4">我的播放清單(最終版)</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </div>
   
  <?php include "../includes/menu.php"; ?>
  <hr>
  <?php

  //以下建立SQL查詢指令
  $sql = "SELECT * FROM playlist order by id desc";
  //以下執行SQL查詢指令，並把結果傳回給$result變數
  $result = $conn->query($sql);
  if ($user_type==NULL) {
    //如果還沒登入的話，要顯示登入用表單
    //以下建立一個用來輸入密碼的表單
    //使用者按下「登入」之後，即會前往chkpass.php檢查密碼
    echo "<form method=POST action=chkpass.php>";
    echo "管理員密碼：<input type=password name=password>";
    echo "<input type=submit value=登入>";
    echo "</form>";
  } else {
    //如果已經登入的話，要有張貼訊息的表單
    echo "<form method=POST action=post.php>";
    echo "播放清單名稱：<input type=text name=playlistname size=40>";
    echo "<input type=submit value=新增>";
    echo "</form>";
    echo "<button><a href=logout.php>登出</a></button>";
  }
  if ($result->num_rows > 0) { //檢查記錄的數量，看看是否有資料
    // output data of each row
    echo "<table width=800 bgcolor=#ff00ff>";
    //下面這行是表格的標題列
    if ($user_type==NULL) {
      //如果未登入的話，就維持原有的標題
      echo "<tr bgcolor=#bbbbbb><td>播放清單</td></tr>";
    } else {
      //如果已經登入的話，就加上「貼文管理」欄位
      echo "<tr bgcolor=#bbbbbb><td>播放清單</td><td>貼文管理</td></tr>";
    }
    while($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $name = $row["name"];
      
      $sql = "SELECT * FROM video WHERE pid=$id";
      $r = $conn->query($sql);
      $video_row = $r->fetch_assoc();
      $vid = $video_row["vid"];

      echo "<tr bgcolor=#ffffcc>";
      echo "<td><a href=tvshow.php?pid=$id&name=$name&vid=$vid>" . 
          $row["name"] . "</a>(" . 
          get_video_numbers($id) . 
          "支影片)</td>"; 

      // 如果是已登入使用者，要加上貼文管理（連結）的欄位
      if ($user_type!=NULL) {
        echo "<td>";
        echo "<a href='edit.php?id=$id'>編輯</a>";
        echo " - ";
        echo "<a href='delete.php?id=$id'>刪除</a>";
        echo "</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "0 results"; // 如果資料表中沒有記錄，要顯示的內容
  }
    get_counter("test03");
    $conn->close();
  ?>
</div>
<hr>
<?php include "../includes/footer.php"; ?>
</body>
</html>