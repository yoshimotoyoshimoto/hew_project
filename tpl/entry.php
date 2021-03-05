<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="./css/style.css" rel="stylesheet">
<title>会員登録</title>
</head>

<body>
  <h1>会員登録</h1>
  <h2>以下の項目を入力してください(すべて必須項目です)</h2>
  <?php if(isset($_SESSION['db_error'])){ ?><p class="error_message"><?php echo $_SESSION['db_error']; ?></p><?php unset($_SESSION['eb_error']);} ?>
  <form action="./entry.php" method="post">
    <h3>氏名</h3>
    <input type="text" name="name" value="<?php if(!empty($name)){ echo $name; }?>">
    <?php if(isset($_SESSION['name_error'])){ ?><p class="error_message"><?php echo $_SESSION['name_error']; ?></p><?php unset($_SESSION['name_error']);} ?>
    <h3>ログインID</h3>
    <input type="text" name="mail" value="<?php if(!empty($mail)){ echo $mail; }?>">
    <?php if(isset($_SESSION['mail_error'])){ ?><p class="error_message"><?php echo $_SESSION['mail_error']; ?></p><?php unset($_SESSION['mail_error']);} ?>
    <h3>パスワード</h3>
    <input type="password" name="password">
    <?php if(isset($_SESSION['password_error'])){ ?><p class="error_message"><?php echo $_SESSION['password_error']; ?></p><?php unset($_SESSION['password_error']);} ?>
    <?php if(isset($_SESSION['password_retry'])){ ?><p class="error_message"><?php echo $_SESSION['password_retry']; ?></p><?php unset($_SESSION['password_retry']);} ?>
    <br>
    <button type="submit" name="entry_check" value="entry_check">確認</button>
  </form>
</body>
</html>
