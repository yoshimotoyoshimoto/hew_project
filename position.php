<?php
//定数呼び出し
require_once './const.php';
//session開始
session_start();
$class = new ConstClass;
//DB接続
$link = @mysqli_connect($class::HOST,$class::USER_ID,$class::PASSWORD,$class::DB_NAME);

mysqli_set_charset($link,'utf8');

//路線名受け取り
$line = $_GET['line'];
if($line == 'hokurikubiwako'){
    $_SESSION['line'] = '北陸本線・琵琶湖線(新疋田～米原～京都)';
    $img = '<img src="./img/a.png" style="width:40px">';
}elseif($line == 'kyoto'){
    $_SESSION['line'] = 'JR京都線(京都～大阪)';
    $img = '<img src="./img/a.png" style="width:40px">';
}elseif($line == 'kobesanyo'){
    $_SESSION['line'] = 'JR神戸線・山陽本線(大阪～姫路～上郡)';
    $img = '<img src="./img/a.png" style="width:40px">';
}elseif($line == 'ako'){
    $_SESSION['line'] = '赤穂線(相生～播州赤穂)';
    $img = '<img src="./img/a.png" style="width:40px">';
}elseif($line == 'kosei'){
    $_SESSION['line'] = '湖西線(近江塩津～堅田～山科)';
    $img = '<img src="./img/b.png" style="width:40px">';
}elseif($line == 'osakahigashi'){
    $_SESSION['line'] = 'おおさか東線(新大阪～久宝寺)';
    $img = '<img src="./img/f.png" style="width:40px">';
}elseif($line == 'takarazuka'){
    $_SESSION['line'] = 'JR宝塚線(大阪～新三田)';
    $img = '<img src="./img/g.png" style="width:40px">';
}elseif($line == 'tozai'){
    $_SESSION['line'] = 'JR東西線(尼崎～京橋)';
    $img = '<img src="./img/h.png" style="width:40px">';
}elseif($line == 'gakkentoshi'){
    $_SESSION['line'] = '学研都市線(京橋～木津)';
    $img = '<img src="./img/h.png" style="width:40px">';
}elseif($line == 'osakaloop'){
    $_SESSION['line'] = '大阪環状線(大阪～天王寺～大阪)';
    $img = '<img src="./img/o.png" style="width:40px">';
}elseif($line == 'yumesaki'){
    $_SESSION['line'] = 'JRゆめ咲線(西九条～ユニバーサルシティ～桜島)';
    $img = '<img src="./img/p.png" style="width:40px">';
}elseif($line == 'yamatoji'){
    $_SESSION['line'] = '大和路線(JR難波～王寺)';
    $img = '<img src="./img/q.png" style="width:40px">';
}elseif($line == 'hanwahagoromo'){
    $_SESSION['line'] = '阪和線・羽衣線(天王寺～和歌山／鳳～東羽衣)';
    $img = '<img src="./img/r.png" style="width:40px">';
}elseif($line == 'kansaiairport'){
    $_SESSION['line'] = '関西空港線)';
    $img = '<img src="./img/s.png" style="width:40px">';
}elseif($line == 'kusatsu'){
    $_SESSION['line'] = '草津線(草津～柘植)';
    $img = '<img src="./img/c.png" style="width:40px">';
}elseif($line == 'nara'){
    $_SESSION['line'] = '奈良線(京都～木津～奈良)';
    $img = '<img src="./img/d.png" style="width:40px">';
}elseif($line == 'sagano'){
    $_SESSION['line'] = '嵯峨野線(京都～園部)';
    $img = '<img src="./img/e.png" style="width:40px">';
}elseif($line == 'sanin1'){
    $_SESSION['line'] = '山陰本線(園部～福知山)';
    $img = '<img src="./img/e.png" style="width:40px">';
}elseif($line == 'sanin2'){
    $_SESSION['line'] = '山陰本線(福知山～居組)';
    $img = '<img src="./img/e.png" style="width:40px"><img src="./img/ea.png" style="width:40px">';
}elseif($line == 'fukuchiyama'){
    $_SESSION['line'] = 'JR宝塚線・福知山線(新三田～篠山口～福知山)';
    $img = '<img src="./img/g.png" style="width:40px">';
}elseif($line == 'bantan'){
    $_SESSION['line'] = '播但線(姫路～和田山)';
    $img = '<img src="./img/j.png" style="width:40px">';
}elseif($line == 'maizuru'){
    $_SESSION['line'] = '舞鶴線(綾部～東舞鶴)';
    $img = '<img src="./img/l.png" style="width:40px">';
}elseif($line == 'wakayama2'){
    $_SESSION['line'] = '和歌山線(王寺～五条)';
    $img = '<img src="./img/t.png" style="width:40px">';
}elseif($line == 'wakayama1'){
    $_SESSION['line'] = '和歌山線(五条～和歌山)';
    $img = '<img src="./img/t.png" style="width:40px">';
}elseif($line == 'manyomahoroba'){
    $_SESSION['line'] = '万葉まほろば線(奈良～高田)';
    $img = '<img src="./img/u.png" style="width:40px">';
}elseif($line == 'kansai'){
    $_SESSION['line'] = '関西本線(加茂～亀山)';
    $img = '<img src="./img/v.png" style="width:40px">';
}elseif($line == 'kinokuni'){
    $_SESSION['line'] = 'きのくに線(和歌山～新宮)';
    $img = '<img src="./img/w.png" style="width:40px">';
}
//JR西日本列車走行位置からJSON情報取得
$json = 'https://www.train-guide.westjr.co.jp/api/v3/'.$line.'.json';
//json_decode：JSONを連想配列にする
//file_get_contents:指定したファイルの内容を読み込み、その内容を文字列として返す
$object = json_decode(file_get_contents($json),true);
//時刻データを日本語化
$update_time = date("Y年m月d日　H時i分");
//列車データを格納
$trains = $object['trains'];
$trainstatus = [];
$max_delay = 0;
//琵琶湖線タイプの場合(両数あり)
if(isset($trains[0]['numberOfCars'])){
    $position_type = '琵琶湖線タイプ';
    //列車の数だけ繰り返す
    foreach($trains as $val){
        //種別：A-SEAT併結車両のみ除外
        if($val['displayType'] == 'A新快○'){
            $val['displayType'] = 'A新快速';
        }
        //種別：JRゆめ咲線直通表記変更
        if($val['displayType'] == '普通２'){
            $val['displayType'] = '普通';
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
        $val['destination'] = mb_convert_kana($val['destination'],'Krn');
        //経由路線
        $destination_line = $val['dest'];
        $val['destination_line'] = $destination_line['line'];
        //湖西線の排除(?)
        if($val['destination_line'] == 'kosei'){
            if($line != 'kosei'){
                $val['direction'] ='2';
                $val['destination_line'] = '湖西線経由';
            }else{
                $val['destination_line'] = '-';
            }
        }
        //草津線の排除(?)
        elseif($val['destination_line'] == 'kusatsu'){
            $val['direction'] ='3';
            $val['destination_line'] = '草津線直通';
        }
        //学研都市線の排除(?)
        elseif($val['destination_line'] == 'tozai'){
            $val['direction'] ='4';
            $val['destination_line'] = 'JR東西線経由';
        }else{
            $val['destination_line'] = '-';
        }
        //進行方向
        if($line == 'hokurikubiwako'){
            $_SESSION['line'] = '北陸本線・琵琶湖線(新疋田～米原～京都)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(米原・敦賀方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(京都方面行き)';
            }elseif($val['direction'] == '2'){
                $val['direction'] = '上り(湖西線：近江今津・敦賀方面行き)';
            }else{
                $val['direction'] = '上り(草津線：柘植方面行き)';
            }
        }elseif($line == 'kyoto'){
            $_SESSION['line'] = 'JR京都線(京都～大阪)';
            if($val['displayType'] == '丹波路快'){
                $val['displayType'] = '丹波路快速';
            }
            if($val['direction'] == '0'){
                $val['direction'] = '上り(京都方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(大阪方面行き)';
            }elseif($val['direction'] == '2'){
                $val['direction'] = '上り(湖西線：近江今津・敦賀方面行き)';
            }else{
                $val['direction'] = '上り(草津線：柘植方面行き)';
            }
        }elseif($line == 'kobesanyo'){
            $_SESSION['line'] = 'JR神戸線・山陽本線(大阪～姫路～上郡)';
            if($val['displayType'] == '丹波路快'){
                $val['displayType'] = '丹波路快速';
            }
            if($val['direction'] == '0'){
                $val['direction'] = '上り(大阪方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(姫路方面行き)';
            }elseif($val['direction'] == '4'){
                $val['direction'] = '上り(JR東西線：京橋・木津方面行き)';
            }else{
                $val['direction'] = '上り(湖西線：近江今津・敦賀方面行き)';
            }
        }
        elseif($line == 'ako'){
            $_SESSION['line'] = '赤穂線(相生～播州赤穂)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(相生・大阪方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(播州赤穂方面行き)';
            }else{
                $val['direction'] = '上り(湖西線：近江今津・敦賀方面行き)';
            }
        }
        elseif($line == 'kosei'){
            $_SESSION['line'] = '湖西線(近江塩津～堅田～山科)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(近江今津・敦賀方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(京都方面行き)';
            }
        }
        elseif($line == 'osakahigashi'){
            $_SESSION['line'] = 'おおさか東線(新大阪～久宝寺)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(新大阪方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(久宝寺方面行き)';
            }
        }
        elseif($line == 'takarazuka'){
            $_SESSION['line'] = 'JR宝塚線(大阪～新三田)';
            if($val['displayType'] == '丹波路快'){
                $val['displayType'] = '丹波路快速';
            }
            if($val['direction'] == '0'){
                $val['direction'] = '上り(尼崎・大阪方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(新三田方面行き)';
            }
        }
        elseif($line == 'tozai'){
            $_SESSION['line'] = 'JR東西線(尼崎～京橋)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(京橋方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(尼崎方面行き)';
            }elseif($val['direction'] == '4'){
                $val['direction'] = '上り(京橋方面行き)';
                $val['destination_line'] = '-';
            }
        }
        elseif($line == 'gakkentoshi'){
            $_SESSION['line'] = '学研都市線(京橋～木津)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(四条畷・木津方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下丹波時快速面行き)';
            }elseif($val['direction'] == '4'){
                $val['direction'] = '下り(京橋方面行き)';
                $val['destination_line'] = '-';
            }
        }
        elseif($line == 'osakaloop'){
            $_SESSION['line'] = '大阪環状線(大阪～天王寺～大阪)';
            if($val['displayType'] == '関空紀州'){
                $val['displayType'] = '関空／紀州路快速';
            }elseif($val['displayType'] == '紀州路快'){
                $val['displayType'] = '紀州路快速';
            }
            if($val['destination'] == '環状'){
                $val['destination'] = '環状運転';
                $val['nickname'] = '4号車は女性専用車両';
            }
            if($val['destination'] == '桜島'){
                $val['nickname'] = 'JRゆめ咲線直通';
            }
            if($val['displayType'] == '大和路快'){
                $val['displayType'] = '大和路快速';
            }
            if($val['direction'] == '0'){
                $val['direction'] = '内回り(大阪→西九条→天王寺→京橋方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '外回り(大阪→京橋→天王寺→西九条方面行き)';
            }
        }
        elseif($line == 'yumesaki'){
            $_SESSION['line'] = 'JRゆめ咲線(西九条～ユニバーサルシティ～桜島)';
            if($val['destination'] == '環状'){
                $val['destination'] = '環状運転';
            }
            $val['nickname'] = '4号車は女性専用車両';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(西九条方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(ユニバーサルシティ・桜島方面行き)';
            }
        }
        elseif($line == 'yamatoji'){
            $_SESSION['line'] = '大和路線(JR難波～王寺)';
            if($val['displayType'] == '大和路快'){
                $val['displayType'] = '大和路快速';
            }
            if($val['displayType'] == 'みやこ快'){
                $val['displayType'] = 'みやこ路快速';
            }
            if($val['destination'] == '環状'){
                $val['destination'] = '大阪環状線';
            }
            if($val['displayType'] == '関空紀州'){
                $val['displayType'] = '関空／紀州路快速';
            }elseif($val['displayType'] == '紀州路快'){
                $val['displayType'] = '紀州路快速';
            }
            if($val['direction'] == '0'){
                $val['direction'] = '上り(JR難波・大阪環状線方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(王寺方面行き)';
            }
        }
        elseif($line == 'hanwahagoromo'){
            $_SESSION['line'] = '阪和線・羽衣線(天王寺～和歌山／鳳～東羽衣)';
            if($val['displayType'] == '関空紀州'){
                $val['displayType'] = '関空／紀州路快速';
            }elseif($val['displayType'] == '紀州路快'){
                $val['displayType'] = '紀州路快速';
            }
            if($val['direction'] == '0'){
                $val['direction'] = '上り(天王寺・大阪環状線方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(和歌山方面行き)';
            }
        }
        elseif($line == 'kansaiairport'){
            $_SESSION['line'] = '関西空港線)';
            if($val['displayType'] == '関空紀州路快'){
                $val['displayType'] = '関空／紀州路快速';
            }elseif($val['displayType'] == '紀州路快'){
                $val['displayType'] = '紀州路快速';
            }
            if($val['direction'] == '0'){
                $val['direction'] = '上り(日根野方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(関西空港方面行き)';
            }
        }
        //遅れ
        if($val['delayMinutes'] == '0'){
            $val['delayMinutes'] = '平常運転中';
        }else{
            if($max_delay < $val['delayMinutes']){
                $max_delay = $val['delayMinutes'];
            }
            $val['delayMinutes'] = '遅れ約'.$val['delayMinutes'].'分';
        }
        //走行位置
        $position_explode = explode('_',$val['pos']);
        //駅停車中の場合に入る
        if($position_explode[1] == '####'){
            $result = mysqli_query($link,"SELECT * FROM station_keihanshin WHERE position_type = '".$position_type."' AND station_id = ".$position_explode[0]."");
            $row = mysqli_fetch_assoc($result);
            $val['station_sort'] = $row['id'];
            $val['station_name_first'] = $row['station_name'];
            $val['station_name_second'] = '';
        }
        //駅間走行中の場合
        else{
            $result = mysqli_query($link,"SELECT * FROM station_keihanshin WHERE position_type = '".$position_type."' AND station_id = ".$position_explode[0]."");
            $row = mysqli_fetch_assoc($result);
            $result_second = mysqli_query($link,"SELECT * FROM station_keihanshin WHERE position_type = '".$position_type."' AND station_id = ".$position_explode[1]."");
            $row_second = mysqli_fetch_assoc($result_second);
            $val['station_sort'] = $row['id'];
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
        $trainstatus[$count]['count'] = $val['station_sort'];
        $trainstatus[$count]['direction'] = $val['direction'];
        $trainstatus[$count]['type'] = $val['displayType'];
        $trainstatus[$count]['train_name'] = $val['nickname'];
        $trainstatus[$count]['destination_line'] = $val['destination_line'];
        $trainstatus[$count]['destination'] = $val['destination'];
        $trainstatus[$count]['delay'] = $val['delayMinutes'];
        $trainstatus[$count]['cars'] = $val['numberOfCars'];
        $trainstatus[$count]['typeChange'] = $val['typeChange'];
        $str = strstr($trainstatus[$count]['direction'],'下り');
        if($str != $val['direction']){
            $trainstatus[$count]['station_first'] = $val['station_name_second'];
            $trainstatus[$count]['station_second'] = $val['station_name_first'];
        }else{
            $trainstatus[$count]['station_first'] = $val['station_name_first'];
            $trainstatus[$count]['station_second'] = $val['station_name_second'];
        }
        $count = $count + 1;
        asort($trainstatus);
        $_SESSION['max_delay'] = $max_delay;
    }
}else{
    $position_type = '';
    //列車の数だけ繰り返す
    foreach($trains as $val){
        //種別：A-SEAT併結車両のみ除外
        if($val['displayType'] == 'A新快○'){
            $val['displayType'] = 'A新快速';
        }
        //特急列車名
        if(!empty($val['nickname'][0])){
            //号数全角を半角化
            $val['nickname'] = mb_convert_kana($val['nickname'][0],'Krn');
        }else{
            $val['nickname'] = '-';
        }
        //行先
        $val['dest'] = mb_convert_kana($val['dest'],'Krn');
        //進行方向
        if($line == 'kusatsu'){
            $_SESSION['line'] = '草津線(草津～柘植)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(草津方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(柘植方面行き)';
            }
        }elseif($line == 'nara'){
            $_SESSION['line'] = '奈良線(京都～木津～奈良)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(京都方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(木津・奈良方面行き)';
            }
        }
        elseif($line == 'sagano'){
            $_SESSION['line'] = '嵯峨野線(京都～園部)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(園部方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(京都方面行き)';
            }
        }
        elseif($line == 'sanin1'){
            $_SESSION['line'] = '山陰本線(園部～福知山)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(福知山方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(園部方面行き)';
            }
        }
        elseif($line == 'sanin2'){
            $_SESSION['line'] = '山陰本線(福知山～居組)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(居組方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(福知山方面行き)';
            }
        }
        elseif($line == 'fukuchiyama'){
            $_SESSION['line'] = 'JR宝塚線・福知山線(新三田～篠山口～福知山)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(福知山方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(新三田方面行き)';
            }
        }
        elseif($line == 'bantan'){
            $_SESSION['line'] = '播但線(姫路～和田山)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(和田山方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(姫路方面行き)';
            }
        }
        elseif($line == 'maizuru'){
            $_SESSION['line'] = '舞鶴線(綾部～東舞鶴)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(綾部方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(東舞鶴方面行き)';
            }
        }
        elseif($line == 'wakayama2'){
            $_SESSION['line'] = '和歌山線(王寺～五条)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(王寺方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(五条方面行き)';
            }
        }
        elseif($line == 'wakayama1'){
            $_SESSION['line'] = '和歌山線(五条～和歌山)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(五条方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(和歌山方面行き)';
            }
        }
        elseif($line == 'manyomahoroba'){
            $_SESSION['line'] = '万葉まほろば線(奈良～高田)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(奈良方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(高田方面行き)';
            }
        }
        elseif($line == 'kansai'){
            $_SESSION['line'] = '関西本線(加茂～亀山)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(加茂方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(亀山方面行き)';
            }
        }
        elseif($line == 'kinokuni'){
            $_SESSION['line'] = 'きのくに線(和歌山～新宮)';
            if($val['direction'] == '0'){
                $val['direction'] = '上り(和歌山方面行き)';
            }elseif($val['direction'] == '1'){
                $val['direction'] = '下り(新宮方面行き)';
            }
        }
        //遅れ
        if($val['delayMinutes'] == '0'){
            $val['delayMinutes'] = '平常運転中';
        }else{
            if($max_delay < $val['delayMinutes']){
                $max_delay = $val['delayMinutes'];
            }
            $val['delayMinutes'] = '遅れ約'.$val['delayMinutes'].'分';
        }
        //走行位置
        $position_explode = explode('_',$val['pos']);
        //駅停車中の場合に入る
        if($position_explode[1] == '####'){
            $result = mysqli_query($link,"SELECT * FROM station_keihanshin WHERE position_type = '".$position_type."' AND station_id = ".$position_explode[0]."");
            $row = mysqli_fetch_assoc($result);
            $val['station_name_first'] = $row['station_name'];
            $val['station_name_second'] = '';
        }
        //駅間走行中の場合
        else{
            $result = mysqli_query($link,"SELECT * FROM station_keihanshin WHERE position_type = '".$position_type."' AND station_id = ".$position_explode[0]."");
            $row = mysqli_fetch_assoc($result);
            $result_second = mysqli_query($link,"SELECT * FROM station_keihanshin WHERE position_type = '".$position_type."' AND station_id = ".$position_explode[1]."");
            $row_second = mysqli_fetch_assoc($result_second);
            $val['station_name_first'] = $row['station_name'];
            $val['station_name_second'] = $row_second['station_name'];
        }
        if(!isset($count)){
            $count = 0;
        }
        $trainstatus[$count]['direction'] = $val['direction'];
        $trainstatus[$count]['type'] = $val['displayType'];
        $trainstatus[$count]['train_name'] = $val['nickname'];
        $trainstatus[$count]['dest'] = $val['dest'];
        $trainstatus[$count]['delay'] = $val['delayMinutes'];
        if($val['direction'] == '下り(京都方面行き)'){
            $trainstatus[$count]['station_first'] = $val['station_name_first'];
            $trainstatus[$count]['station_second'] = $val['station_name_second'];
        }else{
            $trainstatus[$count]['station_first'] = $val['station_name_second'];
            $trainstatus[$count]['station_second'] = $val['station_name_first'];
        }
        $count = $count + 1;
        $_SESSION['max_delay'] = $max_delay;
    }
}

//表示部に連絡
require_once './tpl/position.php';
