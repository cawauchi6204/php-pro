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
    <form action="pro_add_check.php" method="post" enctype="multipart/form-data">
        <h1>商品追加</h1>
        <label for="">商品名を入力してください<br>
        <input type="text" name="name" id="" style="width:200px">
    </label><br>
        <label for="">価格を入力してください<br>
        <input type="text" name="price" id="" style="width:50px">
    </label><br>
        <label for="">画像を選んでください<br>
        <input type="file" name="img" id="" style="width:400px">
    </label><br>
    <input type="button" value="戻る" onclick="history.back()">
    <input type="submit" value="OK">
    </form>
</body>
</html>
