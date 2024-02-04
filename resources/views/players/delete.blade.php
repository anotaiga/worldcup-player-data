<?php
    $referer = @$_SERVER['HTTP_REFERER'];

    if (empty($referer)) {
        // リダイレクトの場合
        header(("Location: ../index1/1"));
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>