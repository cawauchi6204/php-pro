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

        $dsn = 'mysql:dbname=shop;host=127.0.0.1;charset=utf8';
        $user='root';
        $password='root';
        $dbh = new PDO($dsn, $user , $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // ここまではテンプレ
        $code = $_GET['procode'];
        // 前の画面からとってきたprocodeを変数codeに格納している
        $sql = 'SELECT code,name,price FROM mst_product WHERE code = :code';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":code" , $code);
        $stmt->execute();

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($rec);
        
        $rec_name = $rec['name'];
        $rec_code = $rec['code'];
        $rec_price = $rec['price'];
        // methodsはpost

        // $codeの名前をデータベースからとってきてそれを変数$nameに格納してからinputのvalueに入力する
        echo '<form method="post" action="pro_edit_check.php">';
        echo '商品コード:<span>' . $code . '</span><br>';
        echo '商品名前:<input type="text" name="name" value="'.$rec_name.'"><br>';
        echo '商品価格:<input type="text" name="price" value="'.$rec_price.'"><br>';
        echo '<input type="hidden" name="procode" value="' . $code . '">';
        echo '<input type="submit" value="修正">';
        echo '</form>';
        
    } catch(PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>
</body>
</html>