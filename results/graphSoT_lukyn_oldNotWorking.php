<!DOCTYPE html>
<html>
<head>
  <title>Success over Time - Quiz graph</title>
  <style type="text/css">
    html{
      width: 100%;
      height: 100%;
      background-color: #2e3136; /*black, transparent;*/
    }body{
      background: transparent;
    }#graph{
      background-color: #2e3136;
      width: 100%;
      height: 100%;

      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
    }
  </style>
</head>
<body>
  <?php 

  //include $_SERVER['DOCUMENT_ROOT'].'htmlParts/header.php';
  //
  function getData(){
    include $_SERVER['DOCUMENT_ROOT'].'controlDatabase/dbconnect.php';

    $date0 = round(microtime(true) * 1000)-28800000;
    $date1 = round(microtime(true) * 1000)-25200000;
    $date2 = round(microtime(true) * 1000)-21600000;
    $date3 = round(microtime(true) * 1000)-18000000;
    $date4 = round(microtime(true) * 1000)-14400000;
    $date5 = round(microtime(true) * 1000)-10800000;
    $date6 = round(microtime(true) * 1000)- 7200000;
    $date7 = round(microtime(true) * 1000)- 3600000;

    $maxScore0=0;
    $count0=0;
    $maxScore1=0;
    $count1=0;
    $maxScore2=0;
    $count2=0;
    $maxScore3=0;
    $count3=0;
    $maxScore4=0;
    $count4=0;
    $maxScore5=0;
    $count5=0;
    $maxScore6=0;
    $count6=0;
    $maxScore7=0;
    $count7=0;

    if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

    $answersSql = "SELECT * FROM rank";
    $answersQuery = mysqli_query($conn, $answersSql);

    while ($answerRow = mysqli_fetch_array($answersQuery)) {
        if ($date0<=$answerRow['saveTime']) {
          $maxScore0+=$answerRow['score'];
          $count0+=1;
        }elseif ($date1<=$answerRow['saveTime']) {
          $maxScore1+=$answerRow['score'];
          $count1+=1;
        }elseif ($date2<=$answerRow['saveTime']) {
          $maxScore2+=$answerRow['score'];
          $count2+=1;
        }elseif ($date3<=$answerRow['saveTime']) {
          $maxScore3+=$answerRow['score'];
          $count3+=1;
        }elseif ($date4<=$answerRow['saveTime']) {
          $maxScore4+=$answerRow['score'];
          $count4+=1;
        }elseif ($date5<=$answerRow['saveTime']) {
          $maxScore5+=$answerRow['score'];
          $count5+=1;
        }elseif ($date6<=$answerRow['saveTime']) {
          $maxScore6+=$answerRow['score'];
          $count6+=1;
        }elseif ($date7<=$answerRow['saveTime']) {
          $maxScore7+=$answerRow['score'];
          $count7+=1;
        }  
      }
    mysqli_close($conn);

    //return getAvg($maxScore0,$count0).",".getAvg($maxScore1,$count1).",".getAvg($maxScore2,$count2).",".getAvg($maxScore3,$count3).",".getAvg($maxScore4,$count4).",".getAvg($maxScore5,$count5).",".getAvg($maxScore6,$count6).",".getAvg($maxScore7,$count7);
    //
    return getAvg($maxScore7,$count7).",".getAvg($maxScore6,$count6).",".getAvg($maxScore5,$count5).",".getAvg($maxScore4,$count4).",".getAvg($maxScore3,$count3).",".getAvg($maxScore2,$count2).",".getAvg($maxScore1,$count1).",".getAvg($maxScore0,$count0);
  }

  function getAvg($maxScore,$count){
    if ($maxScore==0) {
      return 0;
    }else{
      return $count/$maxScore;
    }
  }
  ?>
  <script src="/results/Chart.js"></script>
  <canvas id="graph"></canvas>
  <script>
    new Chart(document.getElementById("graph"),{
      "type":"line",
      "data":{"labels":[
      <?php echo "'".date("H:i:s",(round(microtime(true) * 1000)-25200000)/ 1000)."'";?>,
      <?php echo "'".date("H:i:s",(round(microtime(true) * 1000)-21600000)/ 1000)."'";?>,
      <?php echo "'".date("H:i:s",(round(microtime(true) * 1000)-18000000)/ 1000)."'";?>,
      <?php echo "'".date("H:i:s",(round(microtime(true) * 1000)-14400000)/ 1000)."'";?>,
      <?php echo "'".date("H:i:s",(round(microtime(true) * 1000)-10800000)/ 1000)."'";?>,
      <?php echo "'".date("H:i:s",(round(microtime(true) * 1000)- 7200000)/ 1000)."'";?>,
      <?php echo "'".date("H:i:s",(round(microtime(true) * 1000)- 3600000)/ 1000)."'";?>,"now",],
      "datasets":[{"label":"Success over Time",
      "data":[<?php echo getData();?>],
      "fill":false,
      "borderColor":"rgb(0,255,0)",
      "backgroundColor":"rgb(0,255,0)",
      "lineTension":0.1}]},
      "options":{
        "legend": {
            "labels": {
                  "fontColor": 'green' //change to better green color
              }
            }
          }
        }
      );
  </script>
</body>
</html>