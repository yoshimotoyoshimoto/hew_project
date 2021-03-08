<?php
//DB接続
$link = @mysqli_connect(getenv('DB_HOSTNAME'),getenv('DB_USERNAME'),getenv('DB_PASSWORD'),getenv('DATA_NAME'));
//文字設定
mysqli_set_charset($link,'utf8');
//JR西日本列車走行位置からJSON情報取得
$json = 'https://www.train-guide.westjr.co.jp/api/v3/hokurikubiwako.json';
//json_decode：JSONを連想配列にする
//file_get_contents:指定したファイルの内容を読み込み、その内容を文字列として返す
$object = json_decode(file_get_contents($json),true);
//時刻データを日本語化
$update_time = date("Y年m月d日　H時i分");
//列車データを格納
$trains = $object['trains'];
$trainstatus = [];
//列車の数だけ繰り返す
foreach($trains as $val){
    //種別：A-SEAT併結車両のみ除外
    if($val['displayType'] == 'A新快○'){
        $val['displayType'] = 'A新快速';
    }
    //特急列車名
    if(!empty($val['nickname'])){
        //号数全角を半角化
        $val['nickname'] = mb_convert_kana($val['nickname'],'Krn');
    }else{
        $val['nickname'] = '-';
    }
    //行先
    $destination = $val['dest'];
    $val['destination'] = $destination['text'];
    //経由路線
    $destination_line = $val['dest'];
    $val['destination_line'] = $destination_line['line'];
    //湖西線の排除(?)
    if($val['destination_line'] == 'kosei'){
        $val['direction'] ='2';
        $val['destination_line'] = '湖西線経由';
    }
    //草津線の排除(?)
    elseif($val['destination_line'] == 'kusatsu'){
        $val['direction'] ='3';
        $val['destination_line'] = '草津線直通';
    }else{
        $val['destination_line'] = '-';
    }
    //進行方向
    if($val['direction'] == '0'){
        $val['direction'] = '上り(米原・長浜・近江塩津方面行き)';
    }elseif($val['direction'] == '1'){
        $val['direction'] = '下り(京都方面行き)';
    }elseif($val['direction'] == '2'){
        $val['direction'] = '上り(湖西線：堅田・近江今津方面行き)';
    }else{
        $val['direction'] = '上り(草津線：柘植方面行き)';
    }
    //遅れ
    if($val['delayMinutes'] == '0'){
        $val['delayMinutes'] = '平常運転中';
    }else{
        $val['delayMinutes'] = '遅れ約'.$val['delayMinutes'].'分';
    }
    //走行位置
    $position_explode = explode('_',$val['pos']);
    //駅停車中の場合に入る
    if($position_explode[1] == '####'){
        $result = mysqli_query($link,"SELECT * FROM station_biwako WHERE station_id = ".$position_explode[0]."");
        $row = mysqli_fetch_assoc($result);
        $val['station_name_first'] = $row['station_name'];
        $val['station_name_second'] = '';
    }
    //駅間走行中の場合
    else{
        $result = mysqli_query($link,"SELECT * FROM station_biwako WHERE station_id = ".$position_explode[0]."");
        $row = mysqli_fetch_assoc($result);
        $result_second = mysqli_query($link,"SELECT * FROM station_biwako WHERE station_id = ".$position_explode[1]."");
        $row_second = mysqli_fetch_assoc($result_second);
        $val['station_name_first'] = $row['station_name'];
        $val['station_name_second'] = $row_second['station_name'];
    }
    //経由
    if($val['via'] == ''){
        $val['via'] = '';
    }
    //種別変異
    if($val['typeChange'] == ''){
        $val['typeChange'] = '';
    }
    if(!isset($count)){
        $count = 0;
    }
    $trainstatus[$count]['direction'] = $val['direction'];
    $trainstatus[$count]['type'] = $val['displayType'];
    $trainstatus[$count]['train_name'] = $val['nickname'];
    $trainstatus[$count]['destination_line'] = $val['destination_line'];
    $trainstatus[$count]['destination'] = $val['destination'];
    $trainstatus[$count]['delay'] = $val['delayMinutes'];
    $trainstatus[$count]['cars'] = $val['numberOfCars'];
    $trainstatus[$count]['typeChange'] = $val['typeChange'];
    if($val['direction'] == '下り(京都方面行き)'){
        $trainstatus[$count]['station_first'] = $val['station_name_first'];
        $trainstatus[$count]['station_second'] = $val['station_name_second'];
    }else{
        $trainstatus[$count]['station_first'] = $val['station_name_second'];
        $trainstatus[$count]['station_second'] = $val['station_name_first'];
    }
    $count = $count + 1;
}

require_once './tpl/biwako.php';