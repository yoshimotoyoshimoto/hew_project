<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="./css/style.css" rel="stylesheet">
<title>マイ路線登録</title>
</head>

<body>
<h1>マイ路線登録</h1>
<p>お気に入り路線を登録し、すぐに確認することができます。</p>
<?php if(isset($_SESSION['cant_insert'])){ ?>
<p><?php echo $_SESSION['cant_insert']; ?></p>
<?php unset($_SESSION['cant_insert']); ?>
<?php } ?>
<h2>路線を選択して検索</h2>
<h3>北海道地方</h3>
<?php for ($i=0; $i < count($hokaidou_link); $i++){?>
    <form action="./myline_insert.php" method="post">
        <?php echo $hokaidou_link[$i][2]; ?><input type="hidden" name="line" value="<?php echo $hokaidou_link[$i][2]; ?>"><button type="submit" name="line_insert" value="line_insert">登録する</button><br>
    </form>
<?php } ?>
<h3>東北地方</h3>
<?php for ($i=0; $i < count($touhoku_link); $i++){?>
    <form action="./myline_insert.php" method="post">
        <?php echo $touhoku_link[$i][2]; ?><input type="hidden" name="line" value="<?php echo $touhoku_link[$i][2]; ?>"><button type="submit" name="line_insert" value="line_insert">登録する</button><br>
    </form>
<?php } ?>
<h3>関東地方</h3>
<?php for ($i=0; $i < count($kantou_link); $i++){ ?>
    <form action="./myline_insert.php" method="post">
        <?php echo $kantou_link[$i][2]; ?><input type="hidden" name="line" value="<?php echo $kantou_link[$i][2]; ?>"><button type="submit" name="line_insert" value="line_insert">登録する</button><br>
    </form>
<?php } ?>
<h3>中部地方</h3>
<?php for ($i=0; $i < count($tyubu_link); $i++){?>
    <form action="./myline_insert.php" method="post">
        <?php echo $tyubu_link[$i][2]; ?><input type="hidden" name="line" value="<?php echo $tyubu_link[$i][2]; ?>"><button type="submit" name="line_insert" value="line_insert">登録する</button><br>
    </form>
<?php } ?>
<h3>近畿地方</h3>
<?php for ($i=0; $i < count($kinki_link); $i++){?>
    <form action="./myline_insert.php" method="post">
        <?php echo $kinki_link[$i][2]; ?><input type="hidden" name="line" value="<?php echo $kinki_link[$i][2]; ?>"><button type="submit" name="line_insert" value="line_insert">登録する</button><br>
    </form>
<?php } ?>
<h3>中国地方</h3>
<?php for ($i=0; $i < count($tyugoku_link); $i++){?>
    <form action="./myline_insert.php" method="post">
        <?php echo $tyugoku_link[$i][2]; ?><input type="hidden" name="line" value="<?php echo $tyugoku_link[$i][2]; ?>"><button type="submit" name="line_insert" value="line_insert">登録する</button><br>
    </form>
<?php } ?>
<h3>四国地方</h3>
<?php for ($i=0; $i < count($sikoku_link); $i++){?>
    <form action="./myline_insert.php" method="post">
        <?php echo $sikoku_link[$i][2]; ?><input type="hidden" name="line" value="<?php echo $sikoku_link[$i][2]; ?>"><button type="submit" name="line_insert" value="line_insert">登録する</button><br>
    </form>
<?php } ?>
<h3>九州・沖縄地方</h3>
<?php for ($i=0; $i < count($kyusyu_link); $i++){?>
    <form action="./myline_insert.php" method="post">
        <?php echo $kyusyu_link[$i][2]; ?><input type="hidden" name="line" value="<?php echo $kyusyu_link[$i][2]; ?>"><button type="submit" name="line_insert" value="line_insert">登録する</button><br>
    </form>
<?php } ?>
</body>
</html>