<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ろくまる農園</title>
</head>
<body>
  <?php

    if(isset($_POST['edit']) == true ) {
        if(isset($_POST['staffcode']) == false) {
            header('Location:staff_ng.php');
            exit();
        }
        $staff_code = $_POST['staffcode'];
        header('Location:staff_edit.php?staffcode='.$staff_code);
        exit();
    }

    if(isset($_POST['delete']) == true ) {
        if(isset($_POST['staffcode']) == false) {
            header('Location:staff_ng.php');
            exit();
        }
        header('Location:staff_delete.php');
        exit();
    }

  ?>
</body>
</html>