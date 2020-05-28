<?php
    session_start();
    session_regenerate_id(true);
    require_once('./common.php');
    if (isset($_SESSION['login']) == false) {
        echo 'ログインされていません';
        echo '<a href="staff_login.html">ログイン画面へ</a>';
        exit();
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
    ini_set('display_errors', 1);
    try {
        $post = h($_POST);
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_img_name = $post['img'];
        var_dump($pro_img_name);

        $pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
        $pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

        $dsn = 'mysql:dbname=shop;host=127.0.0.1;charset=utf8';
        $user='root';
        $password='root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO mst_product (name,price,gazou) VALUES (?,?,?)';
        $stmt = $dbh->prepare($sql);

        $dbh = null;
        
        $data[] = $pro_name;
        $data[] = $pro_price;
        $data[] = $pro_img_name;
        $stmt->execute($data);

        echo $pro_name . 'を追加しました。';
    } catch (PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        echo $e->getMessage();
        exit();
    }

  ?>

  <a href="pro_list.php">戻る</a> 
</body>
</html>
