<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
ini_set('display_errors', 1);

$pro_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$pro_price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');

if ($pro_name == '') {
    echo '商品名が入力されていません。<br />';
} else {
    echo '商品名:';
    echo $pro_name;
    echo '<br />';
}

if (preg_match('/^[0-9a-zA-Z]*$/', $pro_price) == 0) {
    echo '価格の入力に不備があります。<br />';
} else {
    echo '価格:';
    echo $pro_price;
    echo '円<br />';
}

if ($pro_name == '' || preg_match('/^[0-9a-zA-Z]*$/', $pro_price) == 0) {
    // priceに正規処理が入る
    echo '<form>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '</form>';
} else {
    echo '<form method="post" action="pro_add_done.php">';
    echo '<input type="hidden" name="name" value="'.$pro_name.'">';
    echo '<input type="hidden" name="price" value="'.$pro_price.'"><br>';
    // 今回input入力がないので$_POST['hoge']をhiddenで次のページに渡すT
    echo '<p>上記の商品を追加します</p>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK">';
    echo '</form>';
}

?>
</body>
</html>