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
        $dsn = 'mysql:dbname=shop;host=127.0.0.1;charset=utf8';
        $user='root';
        $password='root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // ここまではテンプレ

        $post = h($_POST);
        $code = $post['procode'];
        $name = $post['name'];
        $price = $post['price'];
        $old_img = $post['old_img'];
        $new_img = $post['new_img'];

        $sql = 'UPDATE mst_product SET name=:name,price=:price,gazou=:new_img WHERE code=:code';
        // $sql = 'UPDATE mst_staff SET (name=:name , password=:password) WHERE code=:code';
        // SET以降に()をつけていてそれがエラーになっていた
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":code", $code);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":price", $price);
        $stmt->bindValue(":new_img", $new_img);
        $stmt->execute();
        
        if ($old_img != $new_img) {
            if ($old_img != '') {
                unlink('./img/'.$old_img);
            }
        }
        // unlink('ファイル名');でファイルを削除することができる

        var_dump($name, $code, $price, $old_img, $new_img);
        echo '登録情報を変更しました';
    } catch (PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>
</body>
</html>
