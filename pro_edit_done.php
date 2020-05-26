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
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // ここまではテンプレ

        $code = $_POST['procode'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $old_img = $_POST['old_img'];
        $new_img = $_POST['new_img'];

        $sql = 'UPDATE mst_product SET name=:name,price=:price,gazou=:new_img WHERE code=:code';
        // $sql = 'UPDATE mst_staff SET (name=:name , password=:password) WHERE code=:code';
        // SET以降に()をつけていてそれがエラーになっていた
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":code", $code);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":price", $price);
        $stmt->bindValue(":new_img", $new_img);
        $stmt->execute();
        
        if($old_img != $new_img) {
          if($old_img != '') {
            unlink('./img/'.$old_img);
          }
        }
        // unlink('ファイル名');でファイルを削除することができる

        var_dump($name, $code, $price,$old_img,$new_img);
        echo '登録情報を変更しました';
    } catch (PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>
</body>
</html>