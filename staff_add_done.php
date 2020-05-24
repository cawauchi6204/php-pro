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
        $staff_name = $_POST['name'];
        $staff_pass = $_POST['pass'];

        $staff_name = htmlspecialchars($staff_name , ENT_QUOTES , 'UTF-8');
        $staff_pass = htmlspecialchars($staff_pass , ENT_QUOTES , 'UTF-8');

        $dsn = 'mysql:dbname=shop;host=127.0.0.1;charset=utf8';
        $user='root';
        $password='root';
        $dbh = new PDO($dsn, $user , $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO mst_staff (name,password) VALUES (?,?)';
        $stmt = $dbh->prepare($sql);

        $dbh = null;
        
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $stmt->execute($data);

        echo $staff_name . 'さんを追加しました。';
    } catch(PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }

  ?>

  <a href="staff_list.php">戻る</a> 
</body>
</html>