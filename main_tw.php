<?php

require_once './vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

function twd() {
    $consumerKey       = getenv("CK");
    $consumerSecret    = getenv("CS");
    $accessToken       = getenv("AT");
    $accessTokenSecret = getenv("AC");

    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

    date_default_timezone_set('Asia/Tokyo');
    $rails_data =[
        "函館本線",
        "東北本線",
        "常磐線",
        "山手線",
        "東海道本線",
        "湘南新宿",
        "横須賀線",
        "横浜線",
        "中央線",
        "中央本線",
        "大阪環状線",
        "環状線",
        "京都線",
        "琵琶湖線",
        "湖西線",
        "大阪メトロ",
        "阪神本線",
        "赤穂線",
        "山陰本線",
        "瀬戸大橋線",
        "予讃線",
        "鹿児島本線",
        "日豊本線",
        "筑肥線"
    ];
    $search_data = [];
    $i = 0;
    $return_tw= [];
    foreach ($rails_data as $key => $value) {
        $search_data[$key] = ''.$value.' 遅延 since:'.date("Y-m-d").'';
    }

    foreach ($search_data as $k => $val) {
        $tweet = $connection->get("search/tweets", array("q" => $val, 'count' => 3, 'result_type' => 'recent'));
        $result = [];
        foreach ($tweet->statuses as $key=>$value) {
            $rusult[] = $value->text;
        }
        if (!empty($rusult)) {
            $return_tw[$rails_data[$i]] = count($rusult);
        }  
        $i++;
    }
    return $return_tw;
}

echo("<pre>");
var_dump(twd());
echo("</pre>");


?>