<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="./css/style.css" rel="stylesheet">
<title>列車走行位置|琵琶湖線</title>
</head>

<body>
<h1>列車走行位置駅名登録ページ</h1>
<form action="./insert_station.php" method="post">
    <p>JSON URL</p><input type="text" name="url">
    <p>路線記号</p><input type="text" name="line_code">
    <p>路線名</p><input type="text" name="line_name">
    <button type="submit" name="insert" value="insert">登録する</button>
</form>
</body>
</html>