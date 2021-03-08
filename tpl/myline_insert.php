<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>列車走行位置</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style type="text/css">
        .bs-component + .bs-component {
          margin-top: 1rem;
        }
        @media (min-width: 768px) {
            .bs-docs-section {
            margin-top: 8em;
            }
            .bs-component {
            position: relative;
            }
            .bs-component .modal {
            position: relative;
            top: auto;
            right: auto;
            bottom: auto;
            left: auto;
            z-index: 1;
            display: block;
            }
            .bs-component .modal-dialog {
            width: 90%;
            }
            .bs-component .popover {
            position: relative;
            display: inline-block;
            width: 220px;
            margin: 20px;
            }
            .nav-tabs {
            margin-bottom: 15px;
            }
            .progress {
            margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary"　id="navbarColor01">
            <div class="container">
                <a class="navbar-brand" href="./">
                <img src="./img/rail_top.png" width="30" height="30" class="d-inline-block align-top mr-1" alt="Honoka">
                遅延情報.net
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">トップ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./yahoo.php">公式遅延情報<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./bata_info.php">非公式遅延情報</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./position_top.php">列車走行位置</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./entry.php">新規会員登録</a>
                        </li>
                        <?php if(!isset($_SESSION['name'])){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./login.php">ログイン</a>
                        </li>
                        <?php }else{ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./myline.php">お気に入り路線</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./myline_insert.php">お気に入り路線登録</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./login.php?logout=logout">ログアウト</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="row">
            <div class="col-lg-12">
                
            </div>
        </div>
    </main>
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