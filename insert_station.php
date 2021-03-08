<?php
//DB接続
$link = @mysqli_connect(getenv('DB_HOSTNAME'),getenv('DB_USERNAME'),getenv('DB_PASSWORD'),getenv('DATA_NAME'));
//文字設定
mysqli_set_charset($link,'utf8');
if(!empty($_POST['insert'])){
    //駅名JSONデータ受け取り
    $url = $_POST['url'];
    //json_decode：JSONを連想配列にする
    //file_get_contents:指定したファイルの内容を読み込み、その内容を文字列として返す
    $object = json_decode(file_get_contents($url),true);
    //駅名データを格納
    $stations = $object['stations'];
    //駅の数だけ繰り返す
    foreach($stations as $val){
        $station_id = $val['info']['code'];
        $station_name = $val['info']['name'];
        $line_code = $_POST['line_code'];
        $line_name = $_POST['line_name'];
        $sql = "INSERT INTO station_biwako(station_id,station_name,line_code,line_name) VALUES('".$station_id."','".$station_name."','".$line_code."','".$line_name."')";
        $result = mysqli_query($link,$sql);
    }
}

require_once './tpl/insert_station.php';