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
        <div class="bs-docs-section clearfix">
            <h1 style="font-size: 2em; margin-top:50px ;">会員登録</h1>
            <h2 style="font-size: 1.2em; font-weight: 100;">以下の項目を入力してください</h2>
            <h2 style="font-size: 1.2em; font-weight: 100;">(すべて必須項目です)</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="bs-component">
                        <div class="jumbotron">
                            <fieldset>
                                <?php if(isset($_SESSION['db_error'])){ ?><p class="error_message"><?php echo $_SESSION['db_error']; ?></p><?php unset($_SESSION['eb_error']);} ?>
                                <form action="./entry.php" method="post">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-form-label">氏名</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" value="<?php if(!empty($name)){ echo $name; }?>">
                                            <?php if(isset($_SESSION['name_error'])){ ?><p class="error_message"><?php echo $_SESSION['name_error']; ?></p><?php unset($_SESSION['name_error']);} ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-form-label">メールアドレス</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="mail" value="<?php if(!empty($mail)){ echo $mail; }?>">
                                            <?php if(isset($_SESSION['mail_error'])){ ?><p class="error_message"><?php echo $_SESSION['mail_error']; ?></p><?php unset($_SESSION['mail_error']);} ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-form-label">パスワード</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password">
                                            <?php if(isset($_SESSION['password_error'])){ ?><p class="error_message"><?php echo $_SESSION['password_error']; ?></p><?php unset($_SESSION['password_error']);} ?>
                                            <?php if(isset($_SESSION['password_retry'])){ ?><p class="error_message"><?php echo $_SESSION['password_retry']; ?></p><?php unset($_SESSION['password_retry']);} ?>
                                        </div>
                                    </div>
                                   <button type="submit" class="btn btn-primary" name="entry_check" value="entry_check">確認</button>
                                </form>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('.bs-component [data-toggle="popover"]').popover();
    $('.bs-component [data-toggle="tooltip"]').tooltip();
    </script>
</body>
</html>
