<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園</title>
</head>
<body>
    <form action="pro_add_check.php" method="post">
        <h1>商品追加</h1>
        <label for="">商品名を入力してください<br>
        <input type="text" name="name" id="" style="width:200px">
    </label><br>
        <label for="">価格を入力してください<br>
        <input type="text" name="price" id="" style="width:50px">
    </label><br>
    <input type="button" value="戻る" onclick="history.back()">
    <input type="submit" value="OK">
    </form>
</body>
</html>