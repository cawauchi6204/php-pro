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
        $pro_name = $_POST['name'];
        $pro_price = $_POST['price'];

        $pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
        $pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

        $dsn = 'mysql:dbname=shop;host=127.0.0.1;charset=utf8';
        $user='root';
        $password='root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO mst_product (name,price) VALUES (?,?)';
        $stmt = $dbh->prepare($sql);

        $dbh = null;
        
        $data[] = $pro_name;
        $data[] = $pro_price;
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