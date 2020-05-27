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
<html lang="en">
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
        $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
        // SELECT * FROM table_name WHERE 1
        // これは機能的には SELECT * FROM table_name; と何ら変わりない。
        // MySQLでは整数の1はTRUEと等価である。
        // select文にpriceを追加してfetchする
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        echo '商品一覧<br><br>';

        echo '<form method="post" action="pro_branch.php">';

        while(true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            if($rec == false) {
                break;
            }

            echo '<input type="radio" name="procode" value="'.$rec['code'].'">';
            // この一文が重要(valueにコード番号を入れて識別している)
            echo $rec['name'] . '---';
            echo $rec['price'] . '円<br>';
        }

        echo '<input type="submit" name="disp" value="参照">';
        echo '<input type="submit" name="add" value="追加">';
        echo '<input type="submit" name="edit" value="修正">';
        echo '<input type="submit" name="delete" value="削除">';
        echo '</form>';
        
    } catch(PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>
</body>
</html>
