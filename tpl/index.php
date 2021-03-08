<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>遅延情報.net</title>
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
        <section class="page-header">
            <div class="row my-5">
                <div class="col-12">
                    <h2 class="display-5">サイトについて</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="bs-component">
                        <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                            <div class="card-header">公式情報</div>
                            <div class="card-body">
                                <h4 class="card-title">正確な遅延情報</h4>
                                <p class="card-text">JR公式サイトから情報を取得し、遅延情報をいち早く知ることができます</p>
                            </div>
                            <img style="width: 100%; display: block;" src="./img/rails_img.jpeg" alt="Card image">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <div class="bs-component">
                        <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                            <div class="card-header">分析</div>
                            <div class="card-body">
                                <h4 class="card-title">高度な分析</h4>
                                <p class="card-text">一般のユーザーツイートを取得し、遅延情報として表示します</p>
                                <p class="card-text">公式情報に比べ、いち早く情報を知ることができます</p>
                            </div>
                            <img style="width: 100%; display: block;" src="./img/sns.jpeg" alt="Card image">
                        </div>
                    </div>   
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <div class="bs-component">
                        <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                            <div class="card-header">マイ路線</div>
                            <div class="card-body">
                                <h4 class="card-title">いつも使うルートを登録</h4>
                                <p class="card-text">登録したルートの遅延情報を手間無くかんたんに参照できます</p>
                            </div>
                            <img style="width: 100%; display: block;" src="./img/root.jpeg" alt="Card image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
