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
        $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code = :code';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":code" , $code);
        $stmt->execute();

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($rec);
        
        $rec_name = $rec['name'];
        $rec_code = $rec['code'];
        $rec_price = $rec['price'];
        $rec_old_img = $rec['gazou'];
        // methodsはpost

        if($rec_old_img === '') {
          $disp_img = '';
      } else {
          $disp_img ='<img src="./img/' . $rec_old_img . '">';
      }

        // $codeの名前をデータベースからとってきてそれを変数$nameに格納してからinputのvalueに入力する
        echo '<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">';
        echo '商品コード:<span>' . $code . '</span><br>';
        echo '商品名前:<input type="text" name="name" value="'.$rec_name.'"><br>';
        echo '商品価格:<input type="text" name="price" value="'.$rec_price.'"><br>';
        echo '<input type="hidden" name="procode" value="' . $code . '">';
        echo '<input type="hidden" name="img_old_name" value="' . $rec_old_img . '">';
        echo '<input type="submit" value="修正">';
        echo '</form>';
        echo $disp_img . '<br><span>画像を選んでください</span>';
        echo '<input type="file" name="img" style="width:400px"><br>';
        
    } catch(PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>
</body>
</html>