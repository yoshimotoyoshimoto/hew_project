<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="./css/style.css" rel="stylesheet">
<title>列車運行情報　β報：路線選択</title>
</head>

<body>
<h1>非公式運行情報</h1>
<p>Twitterから情報を取得し、非公式の情報として運行情報をお届けします。</p>
<h2>路線名を入力して検索</h2>
<form action="./bata_status.php" method="post">
    <input type="text" name="line">
    <button type="submit" name="search" value="search">検索</button>
</form>
<h2>路線を選択して検索</h2>
<a href="#hokaidou">北海道地方</a>
<a href="#touhoku">東北地方</a>
<a href="#kantou">関東地方</a>
<a href="#tyubu">中部地方</a>
<a href="#kinki">近畿地方</a>
<a href="#tyugoku">中国地方</a>
<a href="#sikoku">四国地方</a>
<a href="#kyusyu">九州・沖縄地方</a>

<div id="hokaidou">
<h3>北海道地方</h3>
<?php for ($i=0; $i < count($hokaidou_link); $i++){?>
    <a href="./bata_status.php?line=<?php echo $hokaidou_link[$i][2]; ?>"><?php echo $hokaidou_link[$i][2]; ?></a><br>
<?php } ?>
</div>
<div id="touhoku">
<h3>東北地方</h3>
<?php for ($i=0; $i < count($touhoku_link); $i++){?>
    <a href="./bata_status.php?line=<?php echo $touhoku_link[$i][2] ;?>"><?php echo $touhoku_link[$i][2] ;?></a><br>
<?php } ?>
</div>
<div id="kantou">
<h3>関東地方</h3>
<?php for ($i=0; $i < count($kantou_link); $i++){ ?>
    <a href="./bata_status.php?line=<?php echo $kantou_link[$i][2] ;?>"><?php echo $kantou_link[$i][2] ;?></a><br>
<?php } ?>
</div>
<div id="tyubu">
<h3>中部地方</h3>
<?php for ($i=0; $i < count($tyubu_link); $i++){?>
    <a href="./bata_status.php?line=<?php echo $tyubu_link[$i][2] ;?>"><?php echo $tyubu_link[$i][2] ;?></a><br>
<?php } ?>
</div>
<div id="kinki">
<h3>近畿地方</h3>
<?php for ($i=0; $i < count($kinki_link); $i++){?>
    <a href="./bata_status.php?line=<?php echo $kinki_link[$i][2] ;?>"><?php echo $kinki_link[$i][2] ;?></a><br>
<?php } ?>
</div>
<div id="tyugoku">
<h3>中国地方</h3>
<?php for ($i=0; $i < count($tyugoku_link); $i++){?>
    <a href="./bata_status.php?line=<?php echo $tyugoku_link[$i][2] ;?>"><?php echo $tyugoku_link[$i][2] ;?></a><br>
<?php } ?>
</div>
<div id="sikoku">
<h3>四国地方</h3>
<?php for ($i=0; $i < count($sikoku_link); $i++){?>
    <a href="./bata_status.php?line=<?php echo $sikoku_link[$i][2] ;?>"><?php echo $sikoku_link[$i][2] ;?></a><br>
<?php } ?>
</div>
<div id="kyusyu">
<h3>九州・沖縄地方</h3>
<?php for ($i=0; $i < count($kyusyu_link); $i++){?>
    <a href="./bata_status.php?line=<?php echo $kyusyu_link[$i][2] ;?>"><?php echo $kyusyu_link[$i][2] ;?></a><br>
<?php } ?>
</div>
</body>
</html>