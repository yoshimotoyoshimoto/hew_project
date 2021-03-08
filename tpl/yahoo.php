<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>公式遅延情報</title>
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
                <h1 class="mt-5">公式遅延情報</h1>
                <h2 class="mb-4" style="font-size: 1.4em; font-weight: 200;">地域別リンク</h2>
                <div class="mb-4">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#hokaidou">北海道地方</a></li>
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
        <div id="hokaidou" class="mb-5">
            <h3 class="mb-3" style="font-size: 1.4em;">北海道地方</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <?php for ($i=0; $i < count($hokaidou[0]); $i++) :?>
                                <?php if($hokaidou[1][$i][0] == 'その他' || $hokaidou[1][$i][0] == '運転計画'):?>
                                    <tr class="table-danger">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $hokaidou[0][$i][1]; ?>"><?php echo $hokaidou[0][$i][2] ;?></a></th>
                                        <td>一部列車運休・その他輸送障害</td>
                                    </tr>
                                <?php else: ?>
                                    <tr class="table-info">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $hokaidou[0][$i][1]; ?>"><?php echo $hokaidou[0][$i][2] ;?></a></th>
                                        <td><?php echo $hokaidou[1][$i][0]; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="touhoku" class="mb-5">
            <h3 class="mb-3" style="font-size: 1.4em;">東北地方</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <?php for ($i=0; $i < count($touhoku[0]); $i++) :?>
                                <?php if($touhoku[1][$i][0] == 'その他' || $touhoku[1][$i][0] == '運転計画'):?>
                                    <tr class="table-danger">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $touhoku[0][$i][1]; ?>"><?php echo $touhoku[0][$i][2] ;?></a></th>
                                        <td>一部列車運休・その他輸送障害</td>
                                    </tr>
                                <?php else: ?>
                                    <tr class="table-info">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $touhoku[0][$i][1]; ?>"><?php echo $touhoku[0][$i][2] ;?></a></th>
                                        <td><?php echo $touhoku[1][$i][0]; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="kantou" class="mb-5">
            <h3 class="mb-3" style="font-size: 1.4em;">関東地方</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <?php for ($i=0; $i < count($kantou[0]); $i++) :?>
                                <?php if($kantou[1][$i][0] == 'その他' || $kantou[1][$i][0] == '運転計画'):?>
                                    <tr class="table-danger">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $kantou[0][$i][1]; ?>"><?php echo $kantou[0][$i][2] ;?></a></th>
                                        <td>一部列車運休・その他輸送障害</td>
                                    </tr>
                                <?php else: ?>
                                    <tr class="table-info">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $kantou[0][$i][1]; ?>"><?php echo $kantou[0][$i][2] ;?></a></th>
                                        <td><?php echo $kantou[1][$i][0]; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="tyubu" class="mb-5">
            <h3 class="mb-3" style="font-size: 1.4em;">中部地方</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <?php for ($i=0; $i < count($tyubu[0]); $i++) :?>
                                <?php if($tyubu[1][$i][0] == 'その他' || $tyubu[1][$i][0] == '運転計画'):?>
                                    <tr class="table-danger">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $tyubu[0][$i][1]; ?>"><?php echo $tyubu[0][$i][2] ;?></a></th>
                                        <td>一部列車運休・その他輸送障害</td>
                                    </tr>
                                <?php else: ?>
                                    <tr class="table-info">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $tyubu[0][$i][1]; ?>"><?php echo $tyubu[0][$i][2] ;?></a></th>
                                        <td><?php echo $tyubu[1][$i][0]; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="kinki" class="mb-5">
            <h3 class="mb-3" style="font-size: 1.4em;">近畿地方</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <?php for ($i=0; $i < count($kinki[0]); $i++) :?>
                                <?php if($kinki[1][$i][0] == 'その他' || $kinki[1][$i][0] == '運転計画'):?>
                                    <tr class="table-danger">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $kinki[0][$i][1]; ?>"><?php echo $kinki[0][$i][2] ;?></a></th>
                                        <td>一部列車運休・その他輸送障害</td>
                                    </tr>
                                <?php else: ?>
                                    <tr class="table-info">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $kinki[0][$i][1]; ?>"><?php echo $kinki[0][$i][2] ;?></a></th>
                                        <td><?php echo $kinki[1][$i][0]; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="tyugoku" class="mb-5">
            <h3 class="mb-3" style="font-size: 1.4em;">中国地方</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <?php for ($i=0; $i < count($tyugoku[0]); $i++) :?>
                                <?php if($tyugoku[1][$i][0] == 'その他' || $tyugoku[1][$i][0] == '運転計画'):?>
                                    <tr class="table-danger">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $tyugoku[0][$i][1]; ?>"><?php echo $tyugoku[0][$i][2] ;?></a></th>
                                        <td>一部列車運休・その他輸送障害</td>
                                    </tr>
                                <?php else: ?>
                                    <tr class="table-info">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $tyugoku[0][$i][1]; ?>"><?php echo $tyugoku[0][$i][2] ;?></a></th>
                                        <td><?php echo $tyugoku[1][$i][0]; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="sikoku" class="mb-5">
            <h3 class="mb-3" style="font-size: 1.4em;">四国地方</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <?php for ($i=0; $i < count($sikoku[0]); $i++) :?>
                                <?php if($sikoku[1][$i][0] == 'その他' || $sikoku[1][$i][0] == '運転計画'):?>
                                    <tr class="table-danger">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $sikoku[0][$i][1]; ?>"><?php echo $sikoku[0][$i][2] ;?></a></th>
                                        <td>一部列車運休・その他輸送障害</td>
                                    </tr>
                                <?php else: ?>
                                    <tr class="table-info">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $sikoku[0][$i][1]; ?>"><?php echo $sikoku[0][$i][2] ;?></a></th>
                                        <td><?php echo $sikoku[1][$i][0]; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="kyusyu" class="mb-5">
            <h3 class="mb-3" style="font-size: 1.4em;">九州地方</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <?php for ($i=0; $i < count($kyusyu[0]); $i++) :?>
                                <?php if($kyusyu[1][$i][0] == 'その他' || $kyusyu[1][$i][0] == '運転計画'):?>
                                    <tr class="table-danger">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $kyusyu[0][$i][1]; ?>"><?php echo $kyusyu[0][$i][2] ;?></a></th>
                                        <td>一部列車運休・その他輸送障害</td>
                                    </tr>
                                <?php else: ?>
                                    <tr class="table-info">
                                        <th scope="row"><a href="./yahoo_details.php?url=<?php echo $kyusyu[0][$i][1]; ?>"><?php echo $kyusyu[0][$i][2] ;?></a></th>
                                        <td><?php echo $kyusyu[1][$i][0]; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
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
