<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="./css/style.css" rel="stylesheet">
<title>列車走行位置|琵琶湖線</title>
</head>

<body>
<h1>列車走行位置</h1>
<h2><?php echo $img; ?> <?php echo $_SESSION['line']; session_destroy(); ?></h2>
<p>更新時刻：<?php echo $update_time; ?></p>
<?php if(isset($trains[0]['numberOfCars'])){ ?>
    <?php if(!$trainstatus){ ?>
        <p style="text-align:center">表示できる列車が存在しません</p>
    <?php }else{ ?>
    <table border="1">
    <tr>
        <td>進行方向</td><td>種別</td><td>列車名</td><td>経由</td><td>行先</td><td>遅れ</td><td>両数</td><td>種別変異</td><td>状況</td>
    </tr>
    <?php foreach($trainstatus as $val){ ?>
    <tr>
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
    <table border="1">
    <tr>
        <td>進行方向</td><td>種別</td><td>列車名</td><td>行先</td><td>遅れ</td><td>状況</td>
    </tr>
    <?php foreach($trainstatus as $val){ ?>
    <tr>
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
    </table>
    <?php } ?>
<?php } ?>
</body>
</html>