<?php
//処理を書くファイル
//const呼び出し
// require_once './const.php';
// $class = new ConstClass;

//function呼び出し
require_once './func.php';
//session開始
session_start();

//直接このページを開いた場合：entry.phpへ遷移
if(!isset($_SESSION['status'])){
    header('location:./entry.php');
    exit;
}

//entry.phpから来た場合
if(isset($_SESSION['status'])){
    if($_SESSION['status'] == '登録実施'){
        //入力値受け取り
        $name = $_SESSION['name'];
        $mail = $_SESSION['mail'];
        $password = $_SESSION['password'];
        //パスワードハッシュ化
        //ランダム文字列生成
        $salt = uniqid();
        //ループ回数定義
        $stretch = rand('1000','10000');
        //PSハッシュ化
        $password = pass_hash($password,$salt,$stretch);

        //DB接続
        $link = @mysqli_connect(getenv('DB_HOSTNAME'),getenv('DB_USERNAME'),getenv('DB_PASSWORD'),getenv('DATA_NAME'));
        //エラー処理(DB接続不可)
        if(!$link){
            $_SESSION['db_error'] = 'システムエラーが発生しました(エラーコード：ER-DB01)';
            header('location:./entry.php');
            exit;
        }
        //文字コード設定
        mysqli_set_charset($link,'utf8');

        //SQL定義
        $sql = "INSERT INTO member(name,mail,password,salt,stretch) VALUES('".$name."','".$mail."','".$password."','".$salt."',".$stretch.")";
        //SQL実行
        $result = @mysqli_query($link,$sql);
        //ID取得(オートインクリメント)
        $id = mysqli_insert_id($link);
        //DB切断
        mysqli_close($link);
        
        //ステータス削除
        session_destroy();
    }
}

require_once './tpl/entry_complete.php';