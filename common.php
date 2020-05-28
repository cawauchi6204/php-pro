<?php
//htmlspecialcharsによるサニタイズ関数
function h($before)
{
    foreach ($before as $key => $value) {
        $after[$key] = htmlspecialchars($value, ENT_QUOTES);
    }

    return $after;
}

?>
