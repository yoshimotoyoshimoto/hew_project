<?php
//cURlの関数
function curl_result($url){
//curlセッション初期化
$ch = curl_init();
//curlオプション設定
curl_setopt_array($ch,
[
    CURLOPT_URL            => $url,
    CURLOPT_HEADER         => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0'
]);
//curl実行
$result = curl_exec($ch);
//エラー処理
if (curl_errno($ch)) {
   $error = curl_error($ch);
   echo $error;
}
//curlセッション終了
curl_close($ch);
//文字コード変換(文字化け対策)
$result = mb_convert_encoding($result,'utf-8','ASCII, JIS, UTF-8, SJIS, sjis-win');
//取得した情報の返却
return $result;
}

//タ次元配列を文字列に変換する関数
//第1引数：送られてきた配列 第2引数：再帰用
function chg_arr($value, $beforeKey='') {
	$delimiter_1 = '=';
	$delimiter_2 = '、';
	$work = [];
	if (is_array($value) === true) {
		foreach ($value as $key=>$row) {
			if (is_array($row) === true) {
				$work[] = chg_arr($row, sprintf('%s[%s]', $beforeKey, $key));
			}else {
				$work[] = sprintf("%s[%s]{$delimiter_1}%s", $beforeKey, $key, $row);
			}
		}
	}else {
		$work[] = $value;
	}
	return implode($delimiter_2, $work);
}

//全て可能(可読性が…)
function extraction_all($url){
//元になるURLからコード取得
  $html = curl_result($url);

//取得したコードから必要な要素を取得
  $text = "/(?<=<div class=\"elmTblLstLine\">).*?(?=<\/div>)/s";
  preg_match_all($text, $html, $midway, PREG_SET_ORDER);

  //リンク取得
  $text_tag = "/(?<=<td>).*?(?=<\/td>)/s";
  preg_match_all($text_tag, chg_arr($midway), $route, PREG_SET_ORDER);
  $text_a = "@<a href=\"https://transit.yahoo.co.jp/traininfo/detail/(.*?)\".*?>(.*?)</a>@mis";
  preg_match_all($text_a, chg_arr($route), $result_1, PREG_SET_ORDER);

//運行情報を取得
  $text_tag = "/(?<=<td>)平常運転(?=<\/td>)|(?<=<td>)運転情報(?=<\/td>)|(?<=<span class=\"colNormal\">).*?(?=<\/span>)|(?<=<span class=\"colTrouble\">).*?(?=<\/span>)|(?<=<span class=\"colTrouble suspend\">).*?(?=<\/span>)/s";
  preg_match_all($text_tag, chg_arr($midway), $result_2, PREG_SET_ORDER);

//結果を配列で返す
  return [$result_1, $result_2];
}

//遅延判断のため
function extraction_class($url, $tag, $parent_tag, $parent_id){
  $html = curl_result($url);
  $text = "/(?<=<$parent_tag id=\"$parent_id\">).*?(?=<\/$parent_tag>)/s";
  preg_match_all($text, $html, $midway, PREG_SET_ORDER);
  $text_tag = '/class=\"(.*?)\"/';
  preg_match_all($text_tag, chg_arr($midway), $result, PREG_SET_ORDER);
  return $result;
}

//遅延証明が発行している場合リンクを送る
function delay_certificate($route_name){
  //配列用意
  $delay_certificate = [
    ['路線名','URL'],
    ['札幌市営東西線','https://operationstatus.city.sapporo.jp/unkojoho/rireki_all.html'],
    ['札幌市営南北線','https://operationstatus.city.sapporo.jp/unkojoho/rireki_all.html'],
    ['札幌市営東豊線','https://operationstatus.city.sapporo.jp/unkojoho/rireki_all.html'],
    ['東北本線[福島～仙台]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['東北本線[仙台～一ノ関]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['東北本線[黒磯～福島]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['東北本線[一ノ関～盛岡]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['仙山線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['仙石線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['常磐線[いわき～仙台]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['磐越東線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['磐越西線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['只見線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['石巻線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['気仙沼線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['大船渡線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['釜石線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['山田線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['八戸線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['大湊線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['山形線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['奥羽本線[新庄～秋田]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['奥羽本線[秋田～青森]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['米坂線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['左沢線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['陸羽東線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['陸羽西線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['北上線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['田沢湖線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['花輪線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['男鹿線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['五能線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['津軽線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['羽越本線[新津～酒田]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['羽越本線[酒田～秋田]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['白新線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['仙台市営東西線','https://www.kotsu.city.sendai.jp/unkou/chien/index.html'],
    ['山手線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['京浜東北根岸線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['湘南新宿ライン','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['東海道本線[東京～熱海]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['横須賀線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['横浜線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['相模線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['南武線[川崎～立川]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['南武線[浜川崎～尻手]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['鶴見線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['中央線(快速)[東京～高尾]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['中央総武線(各停)','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['中央本線[高尾～大月]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['青梅線[立川～青梅]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['青梅線[青梅～奥多摩]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['五日市線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['宇都宮線[東京～宇都宮]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['宇都宮線[宇都宮～黒磯]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['高崎線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['埼京川越線[羽沢横浜国大～川越]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['八高川越線[八王子～川越]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['八高線[高麗川～高崎]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['日光線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['烏山線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['常磐線(快速)[品川～取手]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['常磐線(各停)','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['常磐線[品川～水戸]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['常磐線[水戸～いわき]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['総武線(快速)[東京～千葉]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['総武本線[千葉～銚子]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['内房線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['外房線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['成田線[我孫子～成田]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['成田線[千葉～成田空港・銚子]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['京葉線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['武蔵野線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['東金線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['久留里線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['鹿島線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['吾妻線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['伊東線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['上越線[高崎～水上]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['信越本線[高崎～横川]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['水郡線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['水戸線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['両毛線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['上野東京ライン','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['東武スカイツリーライン','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武亀戸線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武大師線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武日光線[南栗橋～東武日光]','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武東上線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武越生線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武宇都宮線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武鬼怒川線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武小泉線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武佐野線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武桐生線','https://www.tobu.co.jp/railway/useful/delay/'],
    ['東武伊勢崎線[久喜～伊勢崎]','https://www.tobu.co.jp/railway/useful/delay/'],
    ['西武池袋線・秩父線','https://www.seiburailway.jp/delay/'],
    ['西武新宿線','https://www.seiburailway.jp/delay/'],
    ['西武西武園線','https://www.seiburailway.jp/delay/'],
    ['西武国分寺線','https://www.seiburailway.jp/delay/'],
    ['西武多摩湖線','https://www.seiburailway.jp/delay/'],
    ['西武有楽町線','https://www.seiburailway.jp/delay/'],
    ['西武豊島線','https://www.seiburailway.jp/delay/'],
    ['西武狭山線','https://www.seiburailway.jp/delay/'],
    ['西武拝島線','https://www.seiburailway.jp/delay/'],
    ['西武多摩川線','https://www.seiburailway.jp/delay/'],
    ['西武山口線','https://www.seiburailway.jp/delay/'],
    ['東京メトロ銀座線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['東京メトロ丸ノ内線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['東京メトロ日比谷線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['東京メトロ東西線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['東京メトロ千代田線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['東京メトロ有楽町線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['東京メトロ半蔵門線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['東京メトロ南北線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['東京メトロ副都心線','https://www.tokyometro.jp/delay/history/ginza.html'],
    ['京王線','https://twitter.com/home'],
    ['京王新線','https://twitter.com/home'],
    ['京王相模原線','https://twitter.com/home'],
    ['京王高尾線','https://twitter.com/home'],
    ['京王競馬場線','https://twitter.com/home'],
    ['京王動物園線','https://twitter.com/home'],
    ['京王井の頭線','https://twitter.com/home'],
    ['東急東横線','http://syoumeisyo.tokyu.co.jp/'],
    ['東急目黒線','http://syoumeisyo.tokyu.co.jp/'],
    ['東急田園都市線','http://syoumeisyo.tokyu.co.jp/'],
    ['東急大井町線','http://syoumeisyo.tokyu.co.jp/'],
    ['東急多摩川線','http://syoumeisyo.tokyu.co.jp/'],
    ['東急池上線','http://syoumeisyo.tokyu.co.jp/'],
    ['東急世田谷線','http://syoumeisyo.tokyu.co.jp/'],
    ['京成本線','https://www.keisei.co.jp/keisei/tetudou/delay/delay.php'],
    ['京成東成田線','https://www.keisei.co.jp/keisei/tetudou/delay/delay.php'],
    ['京成押上線','https://www.keisei.co.jp/keisei/tetudou/delay/delay.php'],
    ['京成千葉線・千原線','https://www.keisei.co.jp/keisei/tetudou/delay/delay.php'],
    ['京成金町線','https://www.keisei.co.jp/keisei/tetudou/delay/delay.php'],
    ['成田スカイアクセス線','https://www.keisei.co.jp/keisei/tetudou/delay/delay.php'],
    ['都営浅草線','https://www.kotsu.metro.tokyo.jp/subway/schedule/delay.html'],
    ['都営三田線','https://www.kotsu.metro.tokyo.jp/subway/schedule/delay.html'],
    ['都営新宿線','https://www.kotsu.metro.tokyo.jp/subway/schedule/delay.html'],
    ['都営大江戸線','https://www.kotsu.metro.tokyo.jp/subway/schedule/delay.html'],
    ['都電荒川線','https://www.kotsu.metro.tokyo.jp/subway/schedule/delay.html'],
    ['日暮里・舎人ライナー','https://www.kotsu.metro.tokyo.jp/subway/schedule/delay.html'],
    ['京急本線','https://delay.keikyu.co.jp/delay/'],
    ['京急空港線','https://delay.keikyu.co.jp/delay/'],
    ['京急大師線','https://delay.keikyu.co.jp/delay/'],
    ['京急逗子線','https://delay.keikyu.co.jp/delay/'],
    ['京急久里浜線','https://delay.keikyu.co.jp/delay/'],
    ['小田急小田原線','https://www.odakyu.jp/program/emg/'],
    ['小田急江ノ島線','https://www.odakyu.jp/program/emg/'],
    ['小田急多摩線','https://www.odakyu.jp/program/emg/'],
    ['関東鉄道常総線','https://www.kantetsu.co.jp/delayinfo/'],
    ['関東鉄道竜ケ崎線','https://www.kantetsu.co.jp/delayinfo/'],
    ['みなとみらい線','https://www.mm21railway.co.jp/service/delay/'],
    ['こどもの国線','https://www.mm21railway.co.jp/service/delay/'],
    ['ブルーライン','https://cgi.city.yokohama.lg.jp/koutuu/chien/list.cgi'],
    ['グリーンライン','https://cgi.city.yokohama.lg.jp/koutuu/chien/list.cgi'],
    ['シーサイドライン','https://www.seasideline.co.jp/guidance/delay_certificate/'],
    ['つくばエクスプレス線','https://www.mir.co.jp/info/delay.html'],
    ['ゆりかもめ線','https://www.yurikamome.co.jp/ride-guidance/delay/'],
    ['相鉄線','https://www.sotetsu.co.jp/train/status/certificate/'],
    ['新京成線','https://www.shinkeisei.co.jp/train/rail_info/'],
    ['北総線','https://www.hokuso-railway.co.jp/delay/'],
    ['東葉高速線','https://www.toyokosoku.co.jp/station/delay'],
    ['埼玉高速鉄道線','https://www.s-rail.co.jp/delay/'],
    ['りんかい線','https://service.twr.co.jp/delay_certificate/index.html'],
    ['秩父鉄道線','https://www.chichibu-railway.co.jp/blog/delay/list/'],
    ['多摩都市モノレール線','https://www.tama-monorail.co.jp/monorail/operation/delay/index.html'],
    ['東京モノレール線','http://www.tokyo-monorail.co.jp/delay/index.asp'],
    ['湘南モノレール線','https://www.shonan-monorail.co.jp/delay/'],
    ['名鉄名古屋本線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄西尾線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄三河線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄豊田線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄蒲郡線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄常滑線・空港線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄築港線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄河和線・知多新線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄瀬戸線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄小牧線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄各務原線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄犬山線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄広見線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄津島線・尾西線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄竹鼻・羽島線','https://www.meitetsu.co.jp/delay-train/'],
    ['名鉄豊川線','https://www.meitetsu.co.jp/delay-train/'],
    ['中央本線[大月～塩尻]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['小海線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['篠ノ井線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['大糸線[松本～南小谷]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['信越本線[直江津～新潟]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['飯山線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['越後線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['弥彦線','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['上越線[水上～長岡]','https://traininfo.jreast.co.jp/delay_certificate/'],
    ['北陸本線','https://delay.trafficinfo.westjr.co.jp/'],
    ['九頭竜線','https://delay.trafficinfo.westjr.co.jp/'],
    ['七尾線','https://delay.trafficinfo.westjr.co.jp/'],
    ['氷見線','https://delay.trafficinfo.westjr.co.jp/'],
    ['城端線','https://delay.trafficinfo.westjr.co.jp/'],
    ['高山本線[猪谷～富山]','https://delay.trafficinfo.westjr.co.jp/'],
    ['大糸線[南小谷～糸魚川]','https://delay.trafficinfo.westjr.co.jp/'],
    ['名古屋市営東山線','https://www.kotsu.city.nagoya.jp/jp/pc/subway/delay.html'],
    ['名古屋市営名城線・名港線','https://www.kotsu.city.nagoya.jp/jp/pc/subway/delay.html'],
    ['名古屋市営鶴舞線','https://www.kotsu.city.nagoya.jp/jp/pc/subway/delay.html'],
    ['名古屋市営桜通線','https://www.kotsu.city.nagoya.jp/jp/pc/subway/delay.html'],
    ['名古屋市営上飯田線','https://www.kotsu.city.nagoya.jp/jp/pc/subway/delay.html'],
    ['近鉄名古屋線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄鈴鹿線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄湯の山線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄山田線・鳥羽線・志摩線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['あいの風とやま鉄道線','https://trafficinfo.ainokaze.co.jp/delay'],
    ['大阪環状線','https://delay.trafficinfo.westjr.co.jp/'],
    ['JRゆめ咲線','https://delay.trafficinfo.westjr.co.jp/'],
    ['JR宝塚線','https://delay.trafficinfo.westjr.co.jp/'],
    ['琵琶湖線','https://delay.trafficinfo.westjr.co.jp/'],
    ['JR京都線','https://delay.trafficinfo.westjr.co.jp/'],
    ['湖西線','https://delay.trafficinfo.westjr.co.jp/'],
    ['草津線','https://delay.trafficinfo.westjr.co.jp/'],
    ['嵯峨野線','https://delay.trafficinfo.westjr.co.jp/'],
    ['学研都市線','https://delay.trafficinfo.westjr.co.jp/'],
    ['JR東西線','https://delay.trafficinfo.westjr.co.jp/'],
    ['JR神戸線','https://delay.trafficinfo.westjr.co.jp/'],
    ['阪和線','https://delay.trafficinfo.westjr.co.jp/'],
    ['紀勢本線[和歌山～和歌山市]','https://delay.trafficinfo.westjr.co.jp/'],
    ['羽衣線','https://delay.trafficinfo.westjr.co.jp/'],
    ['大和路線','https://delay.trafficinfo.westjr.co.jp/'],
    ['関西本線[亀山～加茂]','https://delay.trafficinfo.westjr.co.jp/'],
    ['奈良線','https://delay.trafficinfo.westjr.co.jp/'],
    ['桜井線','https://delay.trafficinfo.westjr.co.jp/'],
    ['和歌山線','https://delay.trafficinfo.westjr.co.jp/'],
    ['関西空港線','https://delay.trafficinfo.westjr.co.jp/'],
    ['和田岬線','https://delay.trafficinfo.westjr.co.jp/'],
    ['きのくに線','https://delay.trafficinfo.westjr.co.jp/'],
    ['加古川線','https://delay.trafficinfo.westjr.co.jp/'],
    ['播但線','https://delay.trafficinfo.westjr.co.jp/'],
    ['舞鶴線','https://delay.trafficinfo.westjr.co.jp/'],
    ['小浜線','https://delay.trafficinfo.westjr.co.jp/'],
    ['福知山線[篠山口～福知山]','https://delay.trafficinfo.westjr.co.jp/'],
    ['山陰本線[園部～鳥取]','https://delay.trafficinfo.westjr.co.jp/'],
    ['おおさか東線','https://delay.trafficinfo.westjr.co.jp/'],
    ['近鉄大阪線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄奈良線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄けいはんな線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄京都線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄橿原線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄天理線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄信貴線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄生駒線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄田原本線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄南大阪線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄道明寺線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄御所線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄吉野線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['近鉄長野線','https://www.kintetsu.co.jp/gyoumu/delay/'],
    ['阪急京都本線','https://www.hankyu.co.jp/delay/'],
    ['阪急伊丹線','https://www.hankyu.co.jp/delay/'],
    ['阪急今津線','https://www.hankyu.co.jp/delay/'],
    ['阪急甲陽線','https://www.hankyu.co.jp/delay/'],
    ['阪急神戸本線','https://www.hankyu.co.jp/delay/'],
    ['阪急宝塚本線','https://www.hankyu.co.jp/delay/'],
    ['阪急箕面線','https://www.hankyu.co.jp/delay/'],
    ['阪急千里線','https://www.hankyu.co.jp/delay/'],
    ['阪急嵐山線','https://www.hankyu.co.jp/delay/'],
    ['ニュートラム','https://subway.osakametro.co.jp/delay_list.php'],
    ['大阪メトロ御堂筋線','https://subway.osakametro.co.jp/delay_list.php'],
    ['大阪メトロ谷町線','https://subway.osakametro.co.jp/delay_list.php'],
    ['大阪メトロ四つ橋線','https://subway.osakametro.co.jp/delay_list.php'],
    ['大阪メトロ中央線','https://subway.osakametro.co.jp/delay_list.php'],
    ['大阪メトロ千日前線','https://subway.osakametro.co.jp/delay_list.php'],
    ['大阪メトロ堺筋線','https://subway.osakametro.co.jp/delay_list.php'],
    ['大阪メトロ長堀鶴見緑地線','https://subway.osakametro.co.jp/delay_list.php'],
    ['大阪メトロ今里筋線','https://subway.osakametro.co.jp/delay_list.php'],
    ['南海本線','https://www.traffic.nankai.co.jp/delay/'],
    ['南海空港線','https://www.traffic.nankai.co.jp/delay/'],
    ['南海高師浜線','https://www.traffic.nankai.co.jp/delay/'],
    ['南海多奈川線','https://www.traffic.nankai.co.jp/delay/'],
    ['南海加太線','https://www.traffic.nankai.co.jp/delay/'],
    ['南海和歌山港線','https://www.traffic.nankai.co.jp/delay/'],
    ['南海高野線','https://www.traffic.nankai.co.jp/delay/'],
    ['南海汐見橋線','https://www.traffic.nankai.co.jp/delay/'],
    ['京阪本線・中之島線','https://www.keihan.co.jp/traffic/traintraffic/delay/'],
    ['京阪交野線','https://www.keihan.co.jp/traffic/traintraffic/delay/'],
    ['京阪宇治線','https://www.keihan.co.jp/traffic/traintraffic/delay/'],
    ['京阪京津線','https://www.keihan.co.jp/traffic/traintraffic/delay/'],
    ['京阪石山坂本線','https://www.keihan.co.jp/traffic/traintraffic/delay/'],
    ['阪神本線','https://rail.hanshin.co.jp/delay/'],
    ['阪神なんば線','https://rail.hanshin.co.jp/delay/'],
    ['阪神武庫川線','https://rail.hanshin.co.jp/delay/'],
    ['神戸高速線','https://rail.hanshin.co.jp/delay/'],
    ['神戸電鉄有馬・三田線','https://www.shintetsu.co.jp/railway/delay/'],
    ['神戸電鉄公園都市線','https://www.shintetsu.co.jp/railway/delay/'],
    ['神戸電鉄粟生線','https://www.shintetsu.co.jp/railway/delay/'],
    ['山陽電鉄本線','http://www.sanyo-railway.co.jp/railway/delay/index.html'],
    ['山陽電鉄網干線','http://www.sanyo-railway.co.jp/railway/delay/index.html'],
    ['ポートライナー','https://www.knt-liner.co.jp/po_delay/'],
    ['六甲ライナー','https://www.knt-liner.co.jp/po_delay/'],
    ['能勢電鉄線','https://noseden.hankyu.co.jp/railway/delay/'],
    ['大阪モノレール線','http://www.osaka-monorail.co.jp/delay/'],
    ['近江鉄道線','https://www.ohmitetudo.co.jp/railway/delay/'],
    ['阪堺電気軌道線','https://www.hankai.co.jp/delay-certificate/'],
    ['北大阪急行線','https://www.kita-kyu.co.jp/info_train/certificate'],
    ['赤穂線','https://delay.trafficinfo.westjr.co.jp/'],
    ['山陰本線[鳥取～益田]','https://delay.trafficinfo.westjr.co.jp/'],
    ['山陰本線[益田～下関]','https://delay.trafficinfo.westjr.co.jp/'],
    ['山陽本線[姫路～三原]','https://delay.trafficinfo.westjr.co.jp/'],
    ['山陽本線[三原～岩国]','https://delay.trafficinfo.westjr.co.jp/'],
    ['山陽本線[岩国～下関]','https://delay.trafficinfo.westjr.co.jp/'],
    ['姫新線','https://delay.trafficinfo.westjr.co.jp/'],
    ['瀬戸大橋線[岡山～児島]','https://delay.trafficinfo.westjr.co.jp/'],
    ['宇野線[茶屋町～宇野]','https://delay.trafficinfo.westjr.co.jp/'],
    ['津山線','https://delay.trafficinfo.westjr.co.jp/'],
    ['因美線','https://delay.trafficinfo.westjr.co.jp/'],
    ['吉備線','https://delay.trafficinfo.westjr.co.jp/'],
    ['伯備線','https://delay.trafficinfo.westjr.co.jp/'],
    ['境線','https://delay.trafficinfo.westjr.co.jp/'],
    ['芸備線','https://delay.trafficinfo.westjr.co.jp/'],
    ['福塩線','https://delay.trafficinfo.westjr.co.jp/'],
    ['木次線','https://delay.trafficinfo.westjr.co.jp/'],
    ['呉線','https://delay.trafficinfo.westjr.co.jp/'],
    ['可部線','https://delay.trafficinfo.westjr.co.jp/'],
    ['岩徳線','https://delay.trafficinfo.westjr.co.jp/'],
    ['宇部線','https://delay.trafficinfo.westjr.co.jp/'],
    ['小野田線','https://delay.trafficinfo.westjr.co.jp/'],
    ['山口線','https://delay.trafficinfo.westjr.co.jp/'],
    ['美祢線','https://delay.trafficinfo.westjr.co.jp/'],
    ['伊予鉄高浜線・横河原線','https://www.iyotetsu.co.jp/kinkyu/'],
    ['伊予鉄郡中線','https://www.iyotetsu.co.jp/kinkyu/'],
    ['伊予鉄松山市内線','https://www.iyotetsu.co.jp/kinkyu/'],
    ['鹿児島本線[門司港～大牟田]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['鹿児島本線[大牟田～八代]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['日豊本線[小倉～大分]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['日豊本線[大分～宮崎]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['日豊本線[宮崎～鹿児島中央]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['福北ゆたか線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['原田線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['若松線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['香椎線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['日田彦山線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['後藤寺線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['鹿児島本線[川内～鹿児島中央]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['筑肥線[姪浜～西唐津]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['筑肥線[西唐津～伊万里]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['唐津線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['長崎本線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['佐世保線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['大村線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['久大本線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['豊肥本線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['三角線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['肥薩線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['吉都線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['宮崎空港線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['日南線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['指宿枕崎線','https://www.jrkyushu.co.jp/railway/delay/'],
    ['山陽本線[下関～門司]','https://www.jrkyushu.co.jp/railway/delay/'],
    ['博多南線','https://delay.trafficinfo.westjr.co.jp/']
  ];
//判断
  for ($i=0; $i < count($delay_certificate); $i++) {
    if ($route_name[0][0] == $delay_certificate[$i][0]) {
      $result[0] = "公式の電子証明書のリンクはこちらです。";
      $result[1] = $delay_certificate[$i][1];
      break;
    }else {
    $result[0] = "公式の電子遅延証明は存在しません。";
    $result[1] = null;
  }
}
//判断処理の結果を返す
  return $result;
}
//文字列の抽出
//運転情報を取得する
function extraction_operation($url, $tag, $class, $elseclass, $other, $parent_tag, $parent_class){
  $html = curl_result($url);
  $text = "/(?<=<$parent_tag class=\"$parent_class\">).*?(?=<\/$parent_tag>)/s";
  preg_match_all($text, $html, $midway, PREG_SET_ORDER);
  $text_tag = "/(?<=<td>)平常運転(?=<\/td>)|(?<=<td>)運転情報(?=<\/td>)|(?<=<$tag class=\"$class\">).*?(?=<\/$tag>)|(?<=<$tag class=\"$elseclass\">).*?(?=<\/$tag>)|(?<=<$tag class=\"$other\">).*?(?=<\/$tag>)/s";
  preg_match_all($text_tag, chg_arr($midway), $result, PREG_SET_ORDER);
  return $result;
}
//aタグのリンク取得
function extraction_link($url, $tag, $parent_tag, $parent_class){
  $html = curl_result($url);
  $text = "/(?<=<$parent_tag class=\"$parent_class\">).*?(?=<\/$parent_tag>)/s";
  preg_match_all($text, $html, $midway, PREG_SET_ORDER);
  $text_tag = "/(?<=<$tag>).*?(?=<\/$tag>)/s";
  preg_match_all($text_tag, chg_arr($midway), $route, PREG_SET_ORDER);
  $text_a = "@<a href=\"https://transit.yahoo.co.jp/traininfo/detail/(.*?)\".*?>(.*?)</a>@mis";
  preg_match_all($text_a, chg_arr($route), $result, PREG_SET_ORDER);
  return $result;
}

//クラス無
function extraction_1($url, $tag){
  $html = curl_result($url);
  $text = "/(?<=<$tag>).*?(?=<\/$tag>)/s";
  preg_match_all($text, $html, $result, PREG_SET_ORDER);
  return $result;
}
//クラス有
function extraction_2($url, $tag, $class){
  $html = curl_result($url);
  $text = "/(?<=<$tag class=\"$class\">).*?(?=<\/$tag>)/s";
  preg_match_all($text, $html, $result, PREG_SET_ORDER);
  return $result;
}
//クラスが二つある(遅延発生時にクラスが変わったりするやつ)
function extraction_3($url, $tag, $class, $elseclass){
  $html = curl_result($url);
  $text = "/(?<=<$tag class=\"$class\">).*?(?=<\/$tag>)|(?<=<$tag class=\"$elseclass\">).*?(?=<\/$tag>)/s";
  preg_match_all($text, $html, $result, PREG_SET_ORDER);
  return $result;
}
//クラスが三つある(遅延発生時にクラスが変わったりするやつ)
function extraction_4($url, $tag, $class, $elseclass, $es_class){
  $html = curl_result($url);
  $text = "/(?<=<$tag class=\"$class\">).*?(?=<\/$tag>)|(?<=<$tag class=\"$elseclass\">).*?(?=<\/$tag>)|(?<=<$tag class=\"$es_class\">).*?(?=<\/$tag>)/s";
  preg_match_all($text, $html, $result, PREG_SET_ORDER);
  return $result;
}
//抽出したのを抽出するよう
function extraction_1x($html, $tag){
  $text = "/(?<=<$tag>).*?(?=<\/$tag>)/s";
  preg_match_all($text, $html, $result, PREG_SET_ORDER);
  return $result;
}
//抽出したいタグにクラスはないが親要素にある場合
function extraction_2x($url, $tag, $class, $parent_tag){
  $html = curl_result($url);
  $text = "/(?<=<$parent_tag class=\"$class\">).*?(?=<\/$parent_tag>)/s";
  preg_match_all($text, $html, $midway, PREG_SET_ORDER);
  $text_tag = "/(?<=<$tag>).*?(?=<\/$tag>)/s";
  preg_match_all($text_tag, chg_arr($midway), $result, PREG_SET_ORDER);
  return $result;
}
//抽出したいタグにクラスはないが親要素にある場合かつクラスが二つある
function extraction_3x($url, $tag, $class, $elseclass, $parent_tag){
  $html = curl_result($url);
  $text = "/(?<=<$parent_tag class=\"$class\">).*?(?=<\/$parent_tag>)|(?<=<$parent_tag class=\"$elseclass\">).*?(?=<\/$parent_tag>)/s";
  preg_match_all($text, $html, $midway, PREG_SET_ORDER);
  $text_tag = "/(?<=<$tag>).*?(?=<\/$tag>)/s";
  preg_match_all($text_tag, chg_arr($midway), $result, PREG_SET_ORDER);
  return $result;
}
 ?>
