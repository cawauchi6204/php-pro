<?php
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) == false) {
        echo 'ログインされていません';
        echo '<a href="staff_login.html">ログイン画面へ</a>';
    } else {
        echo $_SESSION['staff_name'];
        echo 'さんログイン中<br>';
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
  <form action="staff_add_check.php" method="post">
    <h1>スタッフ追加</h1>
    <label for="">スタッフ名を入力してください<br>
    <input type="text" name="name" id="" style="width:200px">
  </label><br>
    <label for="">パスワードを入力してください<br>
    <input type="password" name="pass" id="" style="width:100px">
  </label><br>
    <label for="">パスワードをもう一度入力してください<br>
    <input type="password" name="pass2" id="" style="width:100px">
  </label><br>
  <input type="button" value="戻る" onclick="history.back()">
  <input type="submit" value="OK">
  </form>
</body>
</html>
