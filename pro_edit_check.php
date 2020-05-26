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
// methodsはpost
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$price = htmlspecialchars($_POST['price'], ENT_QUOTES);
$code = $_POST['procode'];

if ($name != '' || preg_match('/^[0-9a-zA-Z]*$/', $price) != 0) {
    echo '<p>こちらでお間違い無いですか？</p>';
    echo '<form method="post" action="pro_edit_done.php">';
    echo '変更後の商品名:<p>' . $name . '</p><br>';
    // hiddenで次の画面にpost値を持ち越す
    // hiddenで次の画面にpost値を持ち越す
    echo '<input type="hidden" name="procode" value="' . $code . '">';
    echo '<input type="hidden" name="name" value="' . $name . '">';
    echo '<input type="hidden" name="price" value="' . $price . '">';
    echo '<input type="submit" value="送信">';
    echo '</form>';
} else {
    echo '入力内容に不備があります';
    echo '<input type="button" value="戻る" onclick="history.back()">';
}

  ?>
</body>
</html>