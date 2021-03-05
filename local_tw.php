<?php


require_once './vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

function twd($rails_data) {

    $consumerKey       = getenv("CK");
    $consumerSecret    = getenv("CS");
    $accessToken       = getenv("AT");
    $accessTokenSecret = getenv("AC");
    //インスタンスを生成
    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    
    //タイムゾーンを日本に設定
    date_default_timezone_set('Asia/Tokyo');
    //検索ワードを収納する配列
    $search_data = [];
    //foreachで使う変数
    $i = 0;
    //最後に返す戻り値の連想配列
    $return_tw= [];
    //検索時刻(1時間前まで)
    $search_time = date("H:i:s",strtotime("-30 minute"));
    //検索ワードを生成して配列に格納
    foreach ($rails_data as $key => $value) {
        if(strpos($value,'[') !== false){
            $explode_search = explode('[',$value);
            $search_data[$key] = ''.$explode_search[0].' 遅れ since:'.date("Y-m-d").'_'.$search_time.'_JST';
        }else{
            $search_data[$key] = ''.$value.' 遅れ since:'.date("Y-m-d").'_'.$search_time.'_JST';
        }
    }

    //検索して出たツイート数をカウントして路線名を入れた連想配列に入れる
    foreach ($search_data as $k => $val) {
        $tweet = $connection->get("search/tweets", array("q" => $val, 'count' => 3, 'result_type' => 'recent'));
        $result = [];
        //検索結果のオブジェクトからツイート内容を抜き出す
        foreach ($tweet->statuses as $key=>$value) {
            $result[] = $value->text;
        }
        //検索結果がNULLじゃないなら処理を行う
        if (1 <= count($result)) {
            $return_tw[] = $rails_data[$i];
        }  
        $i++;
    }
    return $return_tw;
}


function twd2($rails_data) {

    $consumerKey       = getenv("CK");
    $consumerSecret    = getenv("CS");
    $accessToken       = getenv("AT");
    $accessTokenSecret = getenv("AC");
    //インスタンスを生成
    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    
    //タイムゾーンを日本に設定
    date_default_timezone_set('Asia/Tokyo');
    //検索ワードを収納する配列
    $search_data = [];
    //foreachで使う変数
    $i = 0;
    //検索時刻(1時間前まで)
    $search_time = date("H:i:s",strtotime("-30 minute"));
    //最後に返す戻り値の連想配列
    $return_tw= [];
    //検索ワードを生成して配列に格納
    foreach ($rails_data as $key => $value) {
        if(strpos($value,'[') !== false){
            $explode_search = explode('[',$value);
            $search_data[$key] = ''.$explode_search[0].' 運転を見合わせ since:'.date("Y-m-d").'_'.$search_time.'_JST';
        }else{
            $search_data[$key] = ''.$value.' 運転を見合わせ since:'.date("Y-m-d").'_'.$search_time.'_JST';
        }
    }

    //検索して出たツイート数をカウントして路線名を入れた連想配列に入れる
    foreach ($search_data as $k => $val) {
        $tweet = $connection->get("search/tweets", array("q" => $val, 'count' => 3, 'result_type' => 'recent', "tweet_mode" => "extended"));
        $result = [];
        //検索結果のオブジェクトからツイート内容を抜き出す
        foreach ($tweet->statuses as $key=>$value) {
            $result[] = $value->full_text;
        }
        //検索結果がNULLじゃないなら処理を行う
        if (1 <= count($result)) {
            $return_tw[] = $rails_data[$i];
        }
        $i++;
    }
    return $return_tw;
}


function twd3($rails_data) {

    $consumerKey       = getenv("CK");
    $consumerSecret    = getenv("CS");
    $accessToken       = getenv("AT");
    $accessTokenSecret = getenv("AC");
    //インスタンスを生成
    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    
    //タイムゾーンを日本に設定
    date_default_timezone_set('Asia/Tokyo');
    //検索ワードを収納する配列
    $search_data = [];
    //foreachで使う変数
    $i = 0;
    //検索時刻(1時間前まで)
    $search_time = date("H:i:s",strtotime("-10 minute"));
    //最後に返す戻り値の連想配列
    $return_tw= [];
    //検索ワードを生成して配列に格納
    foreach ($rails_data as $key => $value) {
        if(strpos($value,'[') !== false){
            $explode_search = explode('[',$value);
            $search_data[$key] = ''.$explode_search[0].' 運転再開 since:'.date("Y-m-d").'_'.$search_time.'_JST';
        }else{
            $search_data[$key] = ''.$value.' 運転再開 since:'.date("Y-m-d").'_'.$search_time.'_JST';
        }
    }

    //検索して出たツイート数をカウントして路線名を入れた連想配列に入れる
    foreach ($search_data as $k => $val) {
        $tweet = $connection->get("search/tweets", array("q" => $val, 'count' => 3, 'result_type' => 'recent', "tweet_mode" => "extended"));
        $result = [];
        //検索結果のオブジェクトからツイート内容を抜き出す
        foreach ($tweet->statuses as $key=>$value) {
            $result[] = $value->full_text;
        }
        //検索結果がNULLじゃないなら処理を行う
        if (1 <= count($result)) {
            $return_tw[] = $rails_data[$i];
        }
        $i++;
    }
    return $return_tw;
}



function twd4($rails_data) {

    $consumerKey       = getenv("CK");
    $consumerSecret    = getenv("CS");
    $accessToken       = getenv("AT");
    $accessTokenSecret = getenv("AC");
    //インスタンスを生成
    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    
    //タイムゾーンを日本に設定
    date_default_timezone_set('Asia/Tokyo');
    //検索ワードを収納する配列
    $search_data = [];
    //foreachで使う変数
    $i = 0;
    //検索時刻(1時間前まで)
    $search_time = date("H:i:s",strtotime("-5 minute"));
    //最後に返す戻り値の連想配列
    $return_tw= [];
    //検索ワードを生成して配列に格納
    foreach ($rails_data as $key => $value) {
        if(strpos($value,'[') !== false){
            $explode_search = explode('[',$value);
            $search_data[$key] = ''.$explode_search[0].' 以下の路線でダイヤ乱れの可能性 since:'.date("Y-m-d").'_'.$search_time.'_JST';
        }else{
            $search_data[$key] = ''.$value.' 以下の路線でダイヤ乱れの可能性 since:'.date("Y-m-d").'_'.$search_time.'_JST';
        }
    }

    //検索して出たツイート数をカウントして路線名を入れた連想配列に入れる
    foreach ($search_data as $k => $val) {
        $tweet = $connection->get("search/tweets", array("q" => $val, 'count' => 3, 'result_type' => 'recent', "tweet_mode" => "extended"));
        $result = [];
        //検索結果のオブジェクトからツイート内容を抜き出す
        foreach ($tweet->statuses as $key=>$value) {
            $result[] = $value->full_text;
        }
        //検索結果がNULLじゃないなら処理を行う
        if (1 <= count($result)) {
            $return_tw[] = $rails_data[$i];
        }
        $i++;
    }
    return $return_tw;
}
?>