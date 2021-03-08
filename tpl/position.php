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
                <h1 class="mt-4">列車走行位置</h1>
                <h2 class="mt-5" style="font-size: 1.4em;"><?php echo $img; ?> <?php echo $_SESSION['line']; session_destroy(); ?></h2>
                <p>更新時刻：<?php echo $update_time; ?></p>
                <?php if(isset($trains[0]['numberOfCars'])){ ?>
                <?php if(!$trainstatus){ ?>
                    <p style="text-align:center">表示できる列車が存在しません</p>
                <?php }else{ ?>
                <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-info">
                        <th>進行方向</th>
                        <th>種別</th>
                        <th>列車名</th>
                        <th>経由</th>
                        <th>行先</th>
                        <th>遅れ</th>
                        <th>両数</th>
                        <th>種別変異</th>
                        <th>状況</th>
                    </tr>
                    <?php foreach($trainstatus as $val){ ?>
                        <tr class="table-info">
                            <td><?php echo $val['direction']; ?></td>
                            <td><?php echo $val['type']; ?></td>
                            <td><?php echo $val['train_name']; ?></td>
                            <td><?php echo $val['destination_line']; ?></td>
                            <td><?php echo $val['destination']; ?></td>
                            <td><?php echo $val['delay']; ?></td>
                            <td><?php echo $val['cars']; ?>両編成</td>
                            <td><?php echo $val['typeChange']; ?></td>
                            <?php if($val['station_second'] == ''){ ?>
                            <td><?php echo $val['station_first']; ?>駅に停車中</td>
                            <?php }elseif($val['station_first'] == ''){ ?>
                            <td><?php echo $val['station_second']; ?>駅に停車中</td>
                            <?php }else{ ?>
                            <td><?php echo $val['station_first']; ?>駅～<?php echo $val['station_second']; ?>駅間を走行中</td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        </table>
                        <?php } ?>
                        <?php }else{ ?>
                        <?php if(!$trainstatus){ ?>
                            <p style="text-align:center">表示できる列車が存在しません</p>
                        <?php }else{ ?>
                        <table>
                        <tr class="table-info">
                            <td>進行方向</td><td>種別</td><td>列車名</td><td>行先</td><td>遅れ</td><td>状況</td>
                        </tr>
                        <?php foreach($trainstatus as $val){ ?>
                        <tr class="table-info">
                            <td><?php echo $val['direction']; ?></td>
                            <td><?php echo $val['type']; ?></td>
                            <td><?php echo $val['train_name']; ?></td>
                            <td><?php echo $val['dest']; ?></td>
                            <td><?php echo $val['delay']; ?></td>
                            <?php if($val['station_second'] == ''){ ?>
                            <td><?php echo $val['station_first']; ?>駅に停車中</td>
                            <?php }elseif($val['station_first'] == ''){ ?>
                            <td><?php echo $val['station_second']; ?>駅に停車中</td>
                            <?php }else{ ?>
                            <td><?php echo $val['station_first']; ?>駅～<?php echo $val['station_second']; ?>駅間を走行中</td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        </tobody>
                        </table>
                        <?php } ?>
                        <?php } ?>
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