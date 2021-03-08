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
                            <a class="nav-link" href="./myline.php">お気に入り路線</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./myline_insert.php">お気に入り路線登録</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="my-3">
            <div class="jumbotron">
                <h1 style="font-size: 1.4em; font-weight: bold;"><?php echo $details_name[0][0]; ?></h1>
                <p class="lead"><?php echo $details_status[0][0]; ?></p>
                <?php if(isset($details_status[1][0])){ ?>
                <p><?php echo $details_status[1][0]; ?></p>
                <?php } ?>
                <hr class="my-2">
                <?php if ($details_check[1][1] == "trouble" || $details_check[1][1] == "trouble suspend") : ?>
                <h2 style="font-size: 1.2em; font-weight: 100;">公式web遅延証明</h2>
                <?php if ($delay[1] != null) :?>
                <p><a href="<?php echo $delay[1]; ?>" target="_blank" rel="noopener noreferrer"><?php echo $delay[0]; ?></a></p>
                <?php else :?>
                <p><?php echo $delay[0]; ?></p>
                <?php endif ;?>
            </div>
        </div>
        <div class="card border-secondary mb-3" style="text-align: center;">
            <div class="card-header"><h2 style="font-size: 1.4em; font-weight: bold;">非公式遅延証明書</h2></div>
            <div class="card-body">
                <div class="mb-2">
                    <h3 style="font-size: 1.3em; font-weight: bold;">路線名</h3>
                    <p><?php echo $details_name[0][0]; ?></p>
                </div>
                <div class="mb-2">
                    <h3 style="font-size: 1.3em; font-weight: bold;">発生日時</h3>
                    <p><?php echo date("Y/m/d") ; ?></p>
                </div>
                <div class="mb-2">
                    <h3 style="font-size: 1.3em; font-weight: bold;">理由</h3>
                    <p><?php echo $details_status[0][0]; ?></p>
                </div>
            </div>
            <?php if(isset($details_status[1][0])){ ?>
                <div class="card-body">
                    <div class="mb-2">
                        <h3 style="font-size: 1.3em; font-weight: bold;">路線名</h3>
                        <p><?php echo $details_name[0][0]; ?></p>
                    </div>
                    <div class="mb-2">
                        <h3 style="font-size: 1.3em; font-weight: bold;">発生日時</h3>
                        <p><?php echo date("Y/m/d") ; ?></p>
                    </div>
                    <div class="mb-2">
                        <h3 style="font-size: 1.3em; font-weight: bold;">理由</h3>
                        <p><?php echo $details_status[1][0]; ?></p>
                    </div>
                </div>
                <?php } ?>
            <?php endif ;?>
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
