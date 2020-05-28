<?php
    session_start();
    // session_regenerate_id(true);
    if (isset($_SESSION['login']) == false) {
        echo 'ログインされていません';
        echo '<a href="staff_login.html">ログイン画面へ</a>';
        exit();
    } else {
        var_dump($_SESSION);
        echo $_SESSION['staff_name'];
        echo 'さんログイン中<br>';
        // sessionがstaff_top.phpに引き継がれないエラー発生
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ろくまる農園</title>
</head>
<body>
  <a href="pro_list.php">商品管理</a><br>
  <a href="staff_logout.php">ログアウト</a>
</body>
</html>
