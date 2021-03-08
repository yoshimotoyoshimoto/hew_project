<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>列車運行情報　β報：路線選択</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/top_b.css">
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
    <div id="page_top"><a href="#"></a></div>
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
                <h1 class="mt-5">非公式遅延情報</h1>
                <p class="mb-5">Twitterから情報を取得し、非公式の情報として運行情報をお届けします。</p>
                <h2 class="mb-1" style="font-size: 1.4em; font-weight: 200;">路線名を入力して検索</h2>
                <div class="bs-component">
                    <fieldset>
                        <form action="./bata_status.php" method="post">
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label">路線名入力</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="line">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="search" value="search">検索</button>
                        </form>
                    </fieldset>
                </div>
                <h2 class="mb-4" style="font-size: 1.4em; font-weight: 200;">地域別リンク</h2>
                <div class="mb-4">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#hokkaidou">北海道地方</a></li>
                        <li class="list-group-item"><a href="#touhoku">東北地方</a></li>
                        <li class="list-group-item"><a href="#kantou">関東地方</a></li>
                        <li class="list-group-item"><a href="#tyubu">中部地方</a></li>
                        <li class="list-group-item"><a href="#kinki">近畿地方</a></li>
                        <li class="list-group-item"><a href="#tyugoku">中国地方</a></li>
                        <li class="list-group-item"><a href="#sikoku">四国地方</a></li>
                        <li class="list-group-item"><a href="#kyusyu">九州・沖縄地方</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="hokkaidou">
                    <h3 class="mb-3" style="font-size: 1.4em;">北海道地方</h3>
                    <div class="list-group">
                    <?php for ($i=0; $i < count($hokaidou_link); $i++){?>
                        <a href="./bata_status.php?line=<?php echo $hokaidou_link[$i][2]; ?>" class="list-group-item list-group-item-action"><?php echo $hokaidou_link[$i][2]; ?></a><br>
                    <?php } ?>
                    </div>
                </div>
                <div id="touhoku">
                    <h3 class="mb-3" style="font-size: 1.4em;">東北地方</h3>
                    <div class="list-group">
                    <?php for ($i=0; $i < count($touhoku_link); $i++){?>
                        <a href="./bata_status.php?line=<?php echo $touhoku_link[$i][2]; ?>" class="list-group-item list-group-item-action"><?php echo $touhoku_link[$i][2]; ?></a><br>
                    <?php } ?>
                    </div>
                </div>
                <div id="kantou">
                    <h3 class="mb-3" style="font-size: 1.4em;">関東地方</h3>
                    <div class="list-group">
                    <?php for ($i=0; $i < count($kantou_link); $i++){?>
                        <a href="./bata_status.php?line=<?php echo $kantou_link[$i][2]; ?>" class="list-group-item list-group-item-action"><?php echo $kantou_link[$i][2]; ?></a><br>
                    <?php } ?>
                    </div>
                </div>
                <div id="tyubu">
                    <h3 class="mb-3" style="font-size: 1.4em;">中部地方</h3>
                    <div class="list-group">
                    <?php for ($i=0; $i < count($tyubu_link); $i++){?>
                        <a href="./bata_status.php?line=<?php echo $tyubu_link[$i][2]; ?>" class="list-group-item list-group-item-action"><?php echo $tyubu_link[$i][2]; ?></a><br>
                    <?php } ?>
                    </div>
                </div>
                <div id="kinki">
                    <h3 class="mb-3" style="font-size: 1.4em;">近畿地方</h3>
                    <div class="list-group">
                    <?php for ($i=0; $i < count($kinki_link); $i++){?>
                        <a href="./bata_status.php?line=<?php echo $kinki_link[$i][2]; ?>" class="list-group-item list-group-item-action"><?php echo $kinki_link[$i][2]; ?></a><br>
                    <?php } ?>
                    </div>
                </div>
                <div id="tyugoku">
                    <h3 class="mb-3" style="font-size: 1.4em;">中国地方</h3>
                    <div class="list-group">
                    <?php for ($i=0; $i < count($tyugoku_link); $i++){?>
                        <a href="./bata_status.php?line=<?php echo $tyugoku_link[$i][2]; ?>" class="list-group-item list-group-item-action"><?php echo $tyugoku_link[$i][2]; ?></a><br>
                    <?php } ?>
                    </div>
                </div>
                <div id="sikoku">
                    <h3 class="mb-3" style="font-size: 1.4em;">四国地方</h3>
                    <div class="list-group">
                    <?php for ($i=0; $i < count($sikoku_link); $i++){?>
                        <a href="./bata_status.php?line=<?php echo $sikoku_link[$i][2]; ?>" class="list-group-item list-group-item-action"><?php echo $sikoku_link[$i][2]; ?></a><br>
                    <?php } ?>
                    </div>
                </div>
                <div id="kyusyu">
                    <h3 class="mb-3" style="font-size: 1.4em;">九州・沖縄地方</h3>
                    <div class="list-group">
                    <?php for ($i=0; $i < count($kyusyu_link); $i++){?>
                        <a href="./bata_status.php?line=<?php echo $kyusyu_link[$i][2]; ?>" class="list-group-item list-group-item-action"><?php echo $kyusyu_link[$i][2]; ?></a><br>
                    <?php } ?>
                    </div>
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