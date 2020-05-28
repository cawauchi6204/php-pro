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
        $pass = $_POST['password'];

        $code = htmlspecialchars($code, ENT_QUOTES, 'UTF-8');
        $pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');

        $pass = md5($pass);
        // 前の画面からとってきたstaffcodeを変数codeに格納している
        $sql = 'SELECT code,password,name FROM mst_staff WHERE code = :code AND password = :pass';
        // sql文の中のnameが書いていなかったためnameが$recの中に格納されていなく、名前の表示がされていなかった
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":code", $code);
        $stmt->bindValue(":pass", $pass);
        $stmt->execute();

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        // パスワードもコードもどちらもデータベースにあるならtrueが帰ってくる
        // methodsはpost
        // $codeの名前をデータベースからとってきてそれを変数$nameに格納してからinputのvalueに入力する
        if ($rec != false) {
            session_start();
            $_SESSION['login'] = 1;
            // 次の画面で$SESSIONをissetで確認するためこの変数の中身は取り合えず何でも良い
            $_SESSION['staff_code'] = $code;
            $_SESSION['staff_name'] = $rec['name'];
            header('Location:staff_top.php');
            exit();
        } else {
            echo '<p>スタッフコードかパスワードが間違っています</p>';
            echo '<a href="staff_login.html">戻る</a>';
        }
    } catch (PDOExeption $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }
