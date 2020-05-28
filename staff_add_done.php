<?php
    session_start();
    session_regenerate_id(true);
    require_once('./common.php');
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
  <?php
    
    try {
        $post = h($_POST);
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];

        $dsn = 'mysql:dbname=shop;host=127.0.0.1;charset=utf8';
        $user='root';
        $password='root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO mst_staff (name,password) VALUES (?,?)';
        $stmt = $dbh->prepare($sql);

        $dbh = null;
        
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $stmt->execute($data);

        echo $staff_name . 'さんを追加しました。';
    } catch (PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>

  <a href="staff_list.php">戻る</a> 
</body>
</html>
