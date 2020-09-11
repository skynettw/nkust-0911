<?php
    require "includes/config.php";
    require "includes/utils.php";
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
<title>何敏煌0908</title>
</head>
<body>
<h2>何敏煌0911 PHP練習記錄</h2>
<hr>
<?php
    get_counter("homepage");
    $conn->close();
?>

<?php include "includes/menu.php"; ?>
<hr>
<?php include "includes/footer.php"; ?>
</body>
</html>