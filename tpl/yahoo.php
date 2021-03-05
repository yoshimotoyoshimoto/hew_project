<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <link href="./css/style.css" rel="stylesheet">
  <title>TOP</title>
</head>
<body>

  <!-- <h2>テスト</h2>
  <table>
  </>?php for ($i=0; $i < count($a_link); $i++) :?>
    <tr>
      <td><a href="./yahoo_details.php?url=</>?php echo $a_link[$i][1]; ?>"></>?php echo $a_link[$i][2] ;?></a></td>
    </tr>
  </?php endfor; ?>
  </table> -->

  <a href="#hokaidou">北海道地方</a>
  <a href="#touhoku">東北地方</a>
  <a href="#kantou">関東地方</a>
  <a href="#tyubu">中部地方</a>
  <a href="#kinki">近畿地方</a>
  <a href="#tyugoku">中国地方</a>
  <a href="#sikoku">四国地方</a>
  <a href="#kyusyu">九州・沖縄地方</a>

  <div id="hokaidou">
  <h2>北海道地方</h2>
  <table>
  <?php for ($i=0; $i < count($hokaidou[0]); $i++) :?>
    <tr>
      <td><a href="./yahoo_details.php?url=<?php echo $hokaidou[0][$i][1]; ?>"><?php echo $hokaidou[0][$i][2] ;?></a></td>
      <td><?php if($hokaidou[1][$i][0] == 'その他' || $hokaidou[1][$i][0] == '運転計画'){ echo '一部列車運休・その他輸送障害'; }else{ echo $hokaidou[1][$i][0] ;}?></td>
    </tr>
  <?php endfor; ?>
  </table>
  </div>

  <div id="touhoku">
  <h2>東北地方</h2>
  <table>
  <?php for ($i=0; $i < count($touhoku[0]); $i++) :?>
    <tr>
      <td><a href="./yahoo_details.php?url=<?php echo $touhoku[0][$i][1]; ?>"><?php echo $touhoku[0][$i][2] ;?></a></td>
      <td><?php if($touhoku[1][$i][0] == 'その他' || $touhoku[1][$i][0] == '運転計画'){ echo '一部列車運休・その他輸送障害'; }else{ echo $touhoku[1][$i][0]; } ;?></td>
    </tr>
  <?php endfor; ?>
  </table>
  </div>

  <div id="kantou">
  <h2>関東地方</h2>
  <table>
    <?php for ($i=0; $i < count($kantou[0]); $i++) :?>
    <tr>
      <td><a href="./yahoo_details.php?url=<?php echo $kantou[0][$i][1]; ?>"><?php echo $kantou[0][$i][2] ;?></a></td>
      <td><?php if($kantou[1][$i][0] == 'その他' || $kantou[1][$i][0] == '運転計画'){ echo '一部列車運休・その他輸送障害'; }else{ echo $kantou[1][$i][0]; } ;?></td>
    </tr>
  <?php endfor; ?>
  </table>
  </div>

  <div id="tyubu">
  <h2>中部地方</h2>
  <table>
    <?php for ($i=0; $i < count($tyubu[0]); $i++) :?>
    <tr>
      <td><a href="./yahoo_details.php?url=<?php echo $tyubu[0][$i][1]; ?>"><?php echo $tyubu[0][$i][2] ;?></a></td>
      <td><?php if($tyubu[1][$i][0] == 'その他' || $tyubu[1][$i][0] == '運転計画'){ echo '一部列車運休・その他輸送障害'; }else{ echo $tyubu[1][$i][0]; } ;?></td>
    </tr>
  <?php endfor; ?>
  </table>
  </div>

  <div id="kinki">
  <h2>近畿地方</h2>
  <table>
    <?php for ($i=0; $i < count($kinki[0]); $i++) :?>
    <tr>
      <td><a href="./yahoo_details.php?url=<?php echo $kinki[0][$i][1]; ?>"><?php echo $kinki[0][$i][2] ;?></a></td>
      <td><?php if($kinki[1][$i][0] == 'その他' || $kinki[1][$i][0] == '運転計画'){ echo '一部列車運休・その他輸送障害'; }else{ echo $kinki[1][$i][0]; } ;?></td>
    </tr>
  <?php endfor; ?>
  </table>
  </div>

  <div id="tyugoku">
  <h2>中国地方</h2>
  <table>
    <?php for ($i=0; $i < count($tyugoku[0]); $i++) :?>
    <tr>
      <td><a href="./yahoo_details.php?url=<?php echo $tyugoku[0][$i][1]; ?>"><?php echo $tyugoku[0][$i][2] ;?></a></td>
      <td><?php if($tyugoku[1][$i][0] == 'その他' || $tyugoku[1][$i][0] == '運転計画'){ echo '一部列車運休・その他輸送障害'; }else{ echo $tyugoku[1][$i][0]; } ;?></td>
    </tr>
  <?php endfor; ?>
  </table>
  </div>

  <div id="sikoku">
  <h2>四国地方</h2>
  <table>
  <?php for ($i=0; $i < count($sikoku[0]); $i++) :?>
      <tr>
        <td><a href="./yahoo_details.php?url=<?php echo $sikoku[0][$i][1]; ?>"><?php echo $sikoku[0][$i][2] ;?></a></td>
        <td><?php if($sikoku[1][$i][0] == 'その他' || $sikoku[1][$i][0] == '運転計画'){ echo '一部列車運休・その他輸送障害'; }else{ echo $sikoku[1][$i][0]; } ;?></td>
      </tr>
  <?php endfor; ?>
  </table>
  </div>

  <div id="kyusyu">
  <h2>九州地方</h2>
  <table>
  <?php for ($i=0; $i < count($kyusyu[0]); $i++) :?>
    <tr>
      <td><a href="./yahoo_details.php?url=<?php echo $kyusyu[0][$i][1]; ?>"><?php echo $kyusyu[0][$i][2] ;?></a></td>
      <td><?php if($kyusyu[1][$i][0] == 'その他' || $kyusyu[1][$i][0] == '運転計画'){ echo '一部列車運休・その他輸送障害'; }else{ echo $kyusyu[1][$i][0]; } ;?></td>
    </tr>
  <?php endfor; ?>
  </table>
  </div>

</body>
</html>
