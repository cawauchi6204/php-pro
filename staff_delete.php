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
        $code = $_GET['staffcode'];
        // 前の画面からとってきたstaffcodeを変数codeに格納している
        $sql = 'SELECT code,name FROM mst_staff WHERE code = :code';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":code", $code);
        $stmt->execute();

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($rec);
        
        $rec_name = $rec['name'];
        $rec_code = $rec['code'];

        // $codeの名前をデータベースからとってきてそれを変数$nameに格納してからinputのvalueに入力する
        echo '<p>スタッフ削除</p>';
        echo 'スタッフコード:<span>' . $code . '</span><br>';
        echo 'スタッフ名:<span>' . $rec_name . '</span><br>';
        echo '<p>このスタッフを削除してもよろしいですか?</p>';
        echo '<form method="post" action="staff_delete_done.php">';
        echo '<input type="hidden" name="staffcode" value="' . $code . '">';
        echo '<input type="submit" value="OK">';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '</form>';
    } catch (PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>
</body>
</html>