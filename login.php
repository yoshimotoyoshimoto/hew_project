<?php
//処理を書くファイル
//const呼び出し
require_once './const.php';
$class = new ConstClass;

//function呼び出し
require_once './func.php';
//session開始
session_start();

//会員専用ページからログアウトボタンが押されたときの処理
if(!empty($_GET['logout'])){
    session_destroy();
    header('location:./index.php');
    exit;
}

//ログインボタンが押されたときに以下の処理
if(!empty($_POST['login_check'])){
    //入力値チェック(エラーメッセージ定義・エラーフラッグ設定)
    //ログインID：未入力
    if($_POST['mail'] == ''){
        $_SESSION['mail_error'] = '入力されていません(エラーコード：ER-E02)';
        $_SESSION['error_flag'] = 'エラーあり';
    }
    //パスワード：未入力
    if($_POST['password'] == ''){
        $_SESSION['password_error'] = '入力されていません(エラーコード：ER-E03)';
        $_SESSION['error_flag'] = 'エラーあり';
    }
    //ここまでエラーがない場合
    if(!isset($_SESSION['error_flag'])){
        //DB接続
        $link = @mysqli_connect($class::HOST,$class::USER_ID,$class::PASSWORD,$class::DB_NAME);
        //エラー処理(DB接続不可)
        if(!$link){
            $_SESSION['db_error'] = 'システムエラーが発生しました(エラーコード：ER-DB01)';
            header('location:./index.php');
            exit;
        }
        //文字コード設定
        mysqli_set_charset($link,'utf8');
        //SQL定義
        $sql = "SELECT * FROM member WHERE mail='".$_POST['mail']."'";
        //SQL実行
        $result = @mysqli_query($link,$sql);
        //1件情報取得→配列に格納
        $row = mysqli_fetch_assoc($result);
        //DB切断
        mysqli_close($link);

        //ログインIDが一致しない
        if($row['mail'] !== $_POST['mail']){
            $_SESSION['mail_error'] = 'ログインIDが違います(エラーコード：ER-EL01)';
            $_SESSION['error_flag'] = 'エラーあり';
        }

        //パスワードハッシュ化
        //ランダム文字列生成
        $salt = $row['salt'];
        //ループ回数定義
        $stretch = $row['stretch'];
        //PSハッシュ化
        $password = pass_hash($_POST['password'],$salt,$stretch);

        //パスワードが一致しない
        if($password !== $row['password']){
            $_SESSION['password_error'] = 'パスワードが違います(エラーコード：ER-EL02)';
            $_SESSION['error_flag'] = 'エラーあり';
        }

        //入力値異常があるか
        if(!empty($_SESSION['error_flag'])){
            //入力値異常あり：入力内容を残して入力画面に戻す
            //エラーフラッグ消去
            unset($_SESSION['error_flag']);
            $_SESSION['mail'] = $_POST['mail'];
            $_SESSION['password_retry'] = '再度パスワードを入力してください(エラーコード：ER-E06)';
            header("location:./login.php");
            exit;
        }else{
            //入力値異常なし：ログイン
            $_SESSION['status'] = 'ログイン完了';
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header('location:./index.php');
            exit;
        }     
    }else{
        //入力値異常あり：入力内容を残して入力画面に戻す
        //エラーフラッグ消去
        unset($_SESSION['error_flag']);
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['password_retry'] = '再度パスワードを入力してください(エラーコード：ER-E06)';
        header("location:./login.php");
        exit;
    }
}

require_once './tpl/login.php';