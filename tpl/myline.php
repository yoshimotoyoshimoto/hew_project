<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="./css/style.css" rel="stylesheet">
<title>マイ路線一覧</title>
</head>
<body>
<h1>お気に入り路線</h1>
<h2>登録されている路線の運行状況を確認できます。</h2>
<?php if($row['line_1'] == ''){ ?>
    <p>登録されている路線がありません。よく利用する路線を登録しましょう！</p>
    <a href="./myline_insert.php">路線を登録する</a>
<?php }elseif($row['line_2'] == ''){ ?>
    <p>お気に入り路線①：<?php echo $row['line_1']; ?><a href="">公式運行情報(α報)</a><a href="./bata_status.php?line=<?php echo $row['line_1']; ?>">非公式運行情報(β報)</a></p>
<?php }elseif($row['line_3'] == ''){ ?>
    <p>お気に入り路線①：<?php echo $row['line_1']; ?><a href="">公式運行情報(α報)</a><a href="./bata_status.php?line=<?php echo $row['line_1']; ?>">非公式運行情報(β報)</a></p>
    <p>お気に入り路線②：<?php echo $row['line_2']; ?><a href="">公式運行情報(α報)</a><a href="./bata_status.php?line=<?php echo $row['line_2']; ?>">非公式運行情報(β報)</a></p>
<?php }else{ ?>
    <p>お気に入り路線①：<?php echo $row['line_1']; ?><a href="">公式運行情報(α報)</a><a href="./bata_status.php?line=<?php echo $row['line_1']; ?>">非公式運行情報(β報)</a></p>
    <p>お気に入り路線②：<?php echo $row['line_2']; ?><a href="">公式運行情報(α報)</a><a href="./bata_status.php?line=<?php echo $row['line_2']; ?>">非公式運行情報(β報)</a></p>
    <p>お気に入り路線③：<?php echo $row['line_3']; ?><a href="">公式運行情報(α報)</a><a href="./bata_status.php?line=<?php echo $row['line_3']; ?>">非公式運行情報(β報)</a></p>
<?php } ?>
</body>
</html>