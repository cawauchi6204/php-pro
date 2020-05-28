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
// methodsはpost
$post = h($_POST);
$name = $post['name'];
$pass = $post['password'];
$pass2 = $post['password2'];
$code = $post['staffcode'];

if ($name != '' || $pass != '' || $pass == $pass2) {
    $pass = md5($pass);
    echo '<p>こちらでお間違い無いですか？</p>';
    echo '<form method="post" action="staff_edit_done.php">';
    echo '変更後のお名前:<p>' . $name . '</p><br>';
    // hiddenで次の画面にpost値を持ち越す
    echo '<input type="hidden" name="name" value="' . $name . '">';
    echo '新規パスワード:表示されません<br>';
    // hiddenで次の画面にpost値を持ち越す
    echo '<input type="hidden" name="password" value="' . $pass . '">';
    echo '<input type="hidden" name="staffcode" value="' . $code . '">';
    echo '<input type="submit" value="送信">';
    echo '</form>';
} else {
    echo '入力内容に不備があります';
    echo '<input type="button" value="戻る" onclick="history.back()">';
}

  ?>
</body>
</html>
