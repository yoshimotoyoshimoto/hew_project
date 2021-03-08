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
                <h1 class="mt-5">列車走行位置</h1>
                <div class="list-group">
                    <p class="list-group-item list-group-item-action"><img src="./img/a.png" style="width:40px">北陸本線・琵琶湖線(新疋田～米原～京都)：<a href="./position.php?line=hokurikubiwako">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[0]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/a.png" style="width:40px">JR京都線(京都～大阪)：<a href="./position.php?line=kyoto">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[1]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/a.png" style="width:40px">JR神戸線・山陽本線(大阪～姫路～上郡)：<a href="./position.php?line=kobesanyo">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[2]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/a.png" style="width:40px">赤穂線(相生～播州赤穂)：<a href="./position.php?line=ako">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[3]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/b.png" style="width:40px">湖西線(山科～堅田～近江塩津)：<a href="./position.php?line=kosei">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[4]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/c.png" style="width:40px">草津線(草津～柘植)：<a href="./position.php?line=kusatsu">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[5]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/d.png" style="width:40px">奈良線(京都～木津)：<a href="./position.php?line=nara">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[6]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/e.png" style="width:40px">嵯峨野線(京都～園部)：<a href="./position.php?line=sagano">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[7]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/e.png" style="width:40px">山陰本線(園部～福知山)：<a href="./position.php?line=sanin1">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[8]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/e.png" style="width:40px"><img src="./img/ea.png" style="width:40px">山陰本線(福知山～居組)：<a href="./position.php?line=sanin2">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[9]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/f.png" style="width:40px">おおさか東線(新大阪～久宝寺)：<a href="./position.php?line=osakahigashi">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[10]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/g.png" style="width:40px">JR宝塚線(大阪～新三田)：<a href="./position.php?line=takarazuka">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[11]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/g.png" style="width:40px">JR宝塚線・福知山線(新三田～福知山)：<a href="./position.php?line=fukuchiyama">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[12]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/h.png" style="width:40px">JR東西線(尼崎～京橋)：<a href="./position.php?line=tozai">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[13]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/h.png" style="width:40px">学研都市線(京橋～木津)：<a href="./position.php?line=gakkentoshi">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[14]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/j.png" style="width:40px">播但線(姫路～和田山)：<a href="./position.php?line=bantan">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[15]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/l.png" style="width:40px">舞鶴線(綾部～東舞鶴)：<a href="./position.php?line=maizuru">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[16]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/o.png" style="width:40px">大阪環状線(大阪～天王寺～大阪)：<a href="./position.php?line=osakaloop">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[17]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/p.png" style="width:40px">JRゆめ咲線(西九条～ユニバーサルシティ～桜島)：<a href="./position.php?line=yumesaki">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[18]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/q.png" style="width:40px">大和路線(JR難波～加茂)：<a href="./position.php?line=yamatoji">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[19]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/r.png" style="width:40px">阪和線(天王寺～和歌山)・羽衣線(鳳～東羽衣)：<a href="./position.php?line=hanwahagoromo">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[20]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/s.png" style="width:40px">関西空港線(日根野～関西空港)：<a href="./position.php?line=kansaiairport">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[21]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/t.png" style="width:40px">和歌山線(王寺～五条)：<a href="./position.php?line=wakayama2">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[22]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/t.png" style="width:40px">和歌山線(五条～和歌山)：<a href="./position.php?line=wakayama1">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[23]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/u.png" style="width:40px">万葉まほろば線(奈良～高田)：<a href="./position.php?line=manyomahoroba">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[24]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/v.png" style="width:40px">関西本線(加茂～亀山)：<a href="./position.php?line=kansai">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[25]]; ?></p>
                    <p class="list-group-item list-group-item-action"><img src="./img/w.png" style="width:40px">きのくに線(和歌山～新宮)：<a href="./position.php?line=kinokuni">列車走行位置</a>現在の最大遅延分数：<?php echo $_SESSION[$line[26]]; ?></p>
                </div>
            </div>
        </div>
    </main>
    <div class="center_in">
        <div class="card-body">
            <blockquote class="blockquote mb-0">
            <footer class="blockquote-footer">HEW-Special-Teams<cite title="Source Title">遅延情報.net</cite></footer>
            </blockquote>
        </div>  
    </div>  
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('.bs-component [data-toggle="popover"]').popover();
    $('.bs-component [data-toggle="tooltip"]').tooltip();
    </script>
</body>
</html>