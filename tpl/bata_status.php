<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>列車運行情報　β報：路線選択</title>
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
                <h2 class="mt-5">列車運行情報　β報</h2>
                <div class="my-3">
                    <div class="jumbotron">
                    <?php if(!empty($line3)){ ?>
                        <h2 style="font-size: 1.4em; font-weight: bold;"><?php echo $line_name; ?>　運転再開の可能性</h2>
                        <p>Twitter上から、運転を見合わせていた線区の運転再開の情報が複数件上がっています。ただし順次運転再開となるため、動くまで時間のかかる列車がある場合があります。また、再度運転見合わせとなったり、運転再開後も遅れや運転取りやめが発生する場合があります。</p>
                    <?php }elseif(!empty($line4)){ ?>
                        <h2 style="font-size: 1.4em; font-weight: bold;"><?php echo $line_name; ?>　トラブル発生速報</h2>
                        <p>Twitter上から輸送障害の原因となるトラブル発生の情報が複数件上がっています。状況により、今後<?php echo $line_name; ?>では遅れや運転見合わせの可能性があります。今後の情報にご注意ください。</p>
                    <?php }elseif(!empty($line2)){ ?>
                        <h2 style="font-size: 1.4em; font-weight: bold;"><?php echo $line_name; ?>　運転見合わせの可能性</h2>
                        <p>Twitter上から輸送障害発生(運転見合わせ)の情報が複数件上がっています。<?php echo $line_name; ?>では現在一部区間で運転を見合わせているか、今後運転を見合わせる可能性があります。</p>
                    <?php }elseif(!empty($line)){ ?>
                        <h2 style="font-size: 1.4em; font-weight: bold;"><?php echo $line_name; ?>　遅延の可能性</h2>
                        <p>Twitter上から輸送障害発生(遅延)の情報が複数件上がっています。<?php echo $line_name; ?>では現在10分以下の遅延などの輸送障害が発生しているか、今後発生する可能性があります。</p>
                    <?php }if(empty($line) && empty($line2)&& empty($line3)&& empty($line4)){ ?>
                        <h2 style="font-size: 1.4em; font-weight: bold;"><?php echo $line_name; ?>　該当情報なし</h2>
                        <p>現在のところTwitter上からは輸送障害の情報を検知できません。平常運転の可能性が高いですが、Twitterでは見つからないが輸送障害が発生している可能性もあります。公式運行情報も併せてご確認ください。</p>
                    <?php } ?>
                    </div>
                </div>
                <div class="bs-component">
                    <div class="card border-warning mb-3">
                        <div class="card-header">
                            <p>閲覧上のご注意</p>
                        </div>
                        <div class="card-body">
                            <p>・長期間にわたる列車の運休などは反映されない可能性があります。</p>
                            <p>・Twitterのツイート数により精度が変動するため、路線によっては表示されていなくても輸送障害が発生している可能性があります。あくまで参考程度にご利用いただき、正確な運行情報は現地や鉄道会社のHPでご確認ください。</p>
                            <p>・新型コロナウイルス感染症(COVID-19)発生に伴い、利用状況を踏まえて一部列車の運転が取りやめられています。この情報は反映されないことがありますので運休情報は必ず鉄道会社HPや駅係員までご確認ください。</p>
                            <p>・この情報は非公式で、正確性よりも速報性を重視したものです。この情報を利用することにより生じた損害などについては一切責任を負いません。正確性を必要とする場合は、公式運行情報のページ、または鉄道会社のHPをご覧ください。</p>
                        </div>
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