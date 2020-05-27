<?php
    session_start();
    session_regenerate_id(true);
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
        $code = $_POST['staffcode'];
        // 前の画面からとってきたstaffcodeを変数codeに格納している
        $sql = 'DELETE FROM mst_staff WHERE code = :code';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":code", $code);
        $stmt->execute();

        // $codeの名前をデータベースからとってきてそれを変数$nameに格納してからinputのvalueに入力する
        echo '<p>削除しました</p>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
    } catch (PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>
</body>
</html>
