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
  function getDataTime(){
    // this method return data for graph
    include $_SERVER['DOCUMENT_ROOT'].'controlDatabase/dbconnect.php';
    $date0 =round(microtime(true) * 1000)- 3600000;
    $date1 =round(microtime(true) * 1000)- 7200000;
    $date2 =round(microtime(true) * 1000)-10800000;
    $date3 =round(microtime(true) * 1000)-14400000;
    $date4 =round(microtime(true) * 1000)-18000000;
    $date5 =round(microtime(true) * 1000)-21600000;
    $date6 =round(microtime(true) * 1000)-25200000;
    $date7 =round(microtime(true) * 1000)-28800000;

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

/*    $totalTimeScoreQuery = mysqli_query($conn, "SELECT `timeAQ".(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)."` FROM answers");
    if (!$totalTimeScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
    $startTimeScoreQuery = mysqli_query($conn, "SELECT `startTime` FROM answers");
    if (!$startTimeScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
    
    echo bcdiv(bcsub(mysqli_fetch_array($totalTimeScoreQuery)[0],mysqli_fetch_array($startTimeScoreQuery)[0]),'1000',2);*/
    $answersSql = "SELECT * FROM answers";
    $answersQuery = mysqli_query($conn, $answersSql);
    if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

    while ($answerRow = mysqli_fetch_array($answersQuery)) {
        if ($date0<=$answerRow['startTime']) {
          $maxScore0 += bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2);
          $count0+=1;
        }else if ($date1<=bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2)) {
          $maxScore1 += bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2);
          $count1+=1;
        }else if ($date2 <= $answerRow["startTime"]) {
          $maxScore2 += bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2);
          $count2+=1;
        }else if ($date3 <= $answerRow["startTime"]) {
          $maxScore3 += bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2);
          $count3+=1;
        }else if ($date4 <= $answerRow["startTime"]) {
          $maxScore4 += bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2);
          $count4+=1;
        } else if ($date5 <= $answerRow["startTime"]) {
          $maxScore5 += bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2);
          $count5+=1;
        } else if ($date6 <= $answerRow["startTime"]) {
          $maxScore6 += bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2);
          $count6+=1;
        } else if ($date7 <= $answerRow["startTime"]) {
          $maxScore7 += bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2);
          $count7+=1;
        }  
      }
    mysqli_close($conn);
    return  ($maxScore7*10).",".
            ($maxScore6*10).",".
            ($maxScore5*10).",".
            ($maxScore4*10).",".
            ($maxScore3*10).",".
            ($maxScore2*10).",".
            ($maxScore1*10).",".
            ($maxScore0*10);
  }

  function getData(){
    // this method return data for graph
    include $_SERVER['DOCUMENT_ROOT'].'controlDatabase/dbconnect.php';

    $date0 =round(microtime(true) * 1000)- 3600000;
    $date1 =round(microtime(true) * 1000)- 7200000;
    $date2 =round(microtime(true) * 1000)-10800000;
    $date3 =round(microtime(true) * 1000)-14400000;
    $date4 =round(microtime(true) * 1000)-18000000;
    $date5 =round(microtime(true) * 1000)-21600000;
    $date6 =round(microtime(true) * 1000)-25200000;
    $date7 =round(microtime(true) * 1000)-28800000;

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

    $answersSql = "SELECT * FROM rank";
    $answersQuery = mysqli_query($conn, $answersSql);
    if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

    while ($answerRow = mysqli_fetch_array($answersQuery)) {
        if ($date0<=$answerRow['saveTime']) {
          $maxScore0+=$answerRow['score'];
          $count0+=1;
        }else if ($date1<=$answerRow['saveTime']) {
          $maxScore1+=$answerRow['score'];
          $count1+=1;
        }else if ($date2<=$answerRow['saveTime']) {
          $maxScore2+=$answerRow['score'];
          $count2+=1;
        }else if ($date3<=$answerRow['saveTime']) {
          $maxScore3+=$answerRow['score'];
          $count3+=1;
        }else if ($date4<=$answerRow['saveTime']) {
          $maxScore4+=$answerRow['score'];
          $count4+=1;
        } else if ($date5<=$answerRow['saveTime']) {
          $maxScore5+=$answerRow['score'];
          $count5+=1;
        } else if ($date6<=$answerRow['saveTime']) {
          $maxScore6+=$answerRow['score'];
          $count6+=1;
        } else if ($date7<=$answerRow['saveTime']) {
          $maxScore7+=$answerRow['score'];
          $count7+=1;
        }  
      }
    mysqli_close($conn);

    return  getAvg($maxScore7,$count7).",".
            getAvg($maxScore6,$count6).",".
            getAvg($maxScore5,$count5).",".
            getAvg($maxScore4,$count4).",".
            getAvg($maxScore3,$count3).",".
            getAvg($maxScore2,$count2).",".
            getAvg($maxScore1,$count1).",".
            getAvg($maxScore0,$count0);
    //return getAvg($maxScore0,$count0).",".getAvg($maxScore1,$count1).",".getAvg($maxScore2,$count2).",".getAvg($maxScore3,$count3).",".getAvg($maxScore4,$count4).",".getAvg($maxScore5,$count5).",".getAvg($maxScore6,$count6).",".getAvg($maxScore7,$count7);
  }

  function getAvg($maxScore,$count){
    if ($count==0) {
      return 0;
    }else{
      return $maxScore/$count;
    }
  }
  ?>
  <script src="/results/Chart.js"></script>
  <!--<canvas id="graph"></canvas>-->
  <canvas id="graph" style="height: 100%; min-height: 390px; width: 100%; min-width: 100%%; "></canvas>
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
        <?php echo "'".date("H:i:s",(round(microtime(true) * 1000)- 3600000)/ 1000)."'";?>,
        "now",],
      "datasets":[{
        "label":"Success over Time",
        "data":[<?php echo getData();?>],
        "fill":false,
        "borderColor":"rgba(173,255,47, 1)",
        //"borderWidth": 1,
        "backgroundColor":"rgba(173,255,47, 0.6)",
        "lineTension":0.1,
      },{
        label:"**Delay of voting**",
        /*data:[3500, 6000, 3000, 4000, 5000, 8000],*/
        data:[<?php echo getDataTime();?>],
        fill:false,
        borderColor:"rgba(255,  80,  80, 1)",
        //"borderWidth": 1,
        backgroundColor:"rgba(255,  80,  80, 0.6)",
        lineTension:0.1},
        ]},
      options:{
        responsive: true,
        title: {
            display: true,
            text: 'Success over Time',
            fontColor: 'rgba(173,255,47, 0.8)',
            fontFamily: "Trebuchet MS",
            fontSize: 30,
        },
        legend: {
            display: true,
            position: "bottom",
            labels: {
                fontColor: 'rgba(173,255,47, 0.8)',
                fontFamily: "Trebuchet MS",
                fontSize: 14,
              },
            },
        scales: {
          xAxes: [{
                ticks: {
                    fontColor: 'rgba(173,255,47, 1)'
                },
            }],
      /*xAxes: [{
        type: 'linear',
        position: 'bottom',
        /*ticks: {
          min: -1,
          max: 8,
          stepSize: 1,
          fixedStepSize: 1,
        },/
        gridLines: {
          color: 'rgba(171,171,171,1)',
          lineWidth: 1
        }
      }],*/
          yAxes: [{
            /*afterUpdate: function(scaleInstance) {
              console.dir(scaleInstance);
            },*/
            ticks: {
              fontColor: 'rgba(173,255,47, 1)',
              /*min: -2,
              max: 4,
              stepSize: 1,
              fixedStepSize: 1,*/
            },
            gridLines: {
              //color: 'rgba(171,171,171,1)',
              color: 'rgba(0,255,0,1)',
              lineWidth: 0.5
            }
          }]
    },
    annotation: {
      annotations: [{
        type: 'box',
        yScaleID: 'y-axis-0',
        //yMin:  1,
        //yMax: 4,
        borderColor: 'rgba(0, 255, 0, 0.25)',
        //borderWidth: 2,
        //backgroundColor: 'rgba(255, 51, 51, 0.25)',
        backgroundColor: 'rgba(0, 255, 0, 1.25)',
      }],
    }
  }
});
  </script>
</body>
</html>