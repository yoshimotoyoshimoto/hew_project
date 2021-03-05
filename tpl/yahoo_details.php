<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="./css/style.css" rel="stylesheet">
<title>状況詳細</title>
</head>
<body>
<h2>詳細表示</h2>

<h3><?php echo $details_name[0][0]; ?></h3>
<p><?php echo $details_status[0][0]; ?></p>

<?php if(isset($details_status[1][0])){ ?>
<p><?php echo $details_status[1][0]; ?></p>
<?php } ?>

<?php if ($details_check[1][1] == "trouble" || $details_check[1][1] == "trouble suspend") : ?>
<h2>Web版遅延証明書</h2>

<h3>公式遅延証明書</h3>
<?php if ($delay[1] != null) :?>
  <p><a href="<?php echo $delay[1]; ?>" target="_blank" rel="noopener noreferrer"><?php echo $delay[0]; ?></a></p>
<?php else :?>
  <p><?php echo $delay[0]; ?></p>
<?php endif ;?>

<h3>非公式遅延証明書</h3>
  <table>
    <tr>
      <th>路線名</th>
      <td><?php echo $details_name[0][0]; ?></td>
    </tr>
    <tr>
      <th>発生日時</th>
      <td><?php echo date("Y/m/d") ; ?></td>
    </tr>
    <tr>
      <th>理由</th>
      <td><?php echo $details_status[0][0]; ?></td>
    </tr>
  </table>
  <?php if(isset($details_status[1][0])){ ?>
    <table>
    <tr>
      <th>路線名</th>
      <td><?php echo $details_name[0][0]; ?></td>
    </tr>
    <tr>
      <th>発生日時</th>
      <td><?php echo date("Y/m/d") ; ?></td>
    </tr>
    <tr>
      <th>理由</th>
      <td><?php echo $details_status[1][0]; ?></td>
    </tr>
  </table>
  <?php } ?>
<?php endif ;?>

</body>
</html>
