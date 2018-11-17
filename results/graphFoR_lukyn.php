<!DOCTYPE html>
<html>
<head>
  <title>Frequency of Responses - Quiz graph</title>
  <style type="text/css">
    @font-face{font-family: Trebuchet MS; src: url('/fonts/TrebuchetMS.ttf');}
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

  //include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/header.php';
  //
  function getData($answer="A"){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
    $countToReturn = 0;

    for ($i=1; $i < mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]; $i++) { 
      # code...
      # print_r("/* i: $i*/");
      $answersSql = "SELECT COUNT(`AQ$i`) FROM answers WHERE `AQ$i` = '$answer'";
      $answersQuery = mysqli_query($conn, $answersSql);
      if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}
      print_r(mysqli_fetch_array($answersQuery)[0].", ");
      //$countToReturn += (string)mysqli_fetch_array($answersQuery["COUNT(`AQ".$i."`)"]);
      //$countToReturn = (int)mysqli_fetch_array($answersQuery[0]);
      #$countToReturn = (int)mysqli_fetch_row($answersQuery[0]);
      #
    }return $countToReturn;
    /*$date0 =round(microtime(true) * 1000)-3600000;
    $date1 =round(microtime(true) * 1000)-7200000;
    $date2 =round(microtime(true) * 1000)-10800000;
    $date3 =round(microtime(true) * 1000)-14400000;
    $date4 =round(microtime(true) * 1000)-18000000;
    $date5 =round(microtime(true) * 1000)-21600000;
    $date6 =round(microtime(true) * 1000)-25200000;
    $date7 =round(microtime(true) * 1000)-28800000;

    $answersSql = "SELECT * FROM rank";
    $answersQuery = mysqli_query($conn, $answersSql);

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

    return getAvg($maxScore7,$count7).",".getAvg($maxScore6,$count6).",".getAvg($maxScore5,$count5).",".getAvg($maxScore4,$count4).",".getAvg($maxScore3,$count3).",".getAvg($maxScore2,$count2).",".getAvg($maxScore1,$count1).",".getAvg($maxScore0,$count0);
    //return getAvg($maxScore0,$count0).",".getAvg($maxScore1,$count1).",".getAvg($maxScore2,$count2).",".getAvg($maxScore3,$count3).",".getAvg($maxScore4,$count4).",".getAvg($maxScore5,$count5).",".getAvg($maxScore6,$count6).",".getAvg($maxScore7,$count7);*/
  }

  function getAvg($maxScore,$count){
    if ($count==0) {
      return 0;
    }else{
      return $maxScore/$count;
    }
  }
  /*
    r,   g,  b
  114, 147, 203
  225, 151,  76
  132, 186,  91
  211,  94,  96
  204, 194,  16
   */

  function getColorA($opacity='0.4'){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
    return  str_repeat ("'rgba(255,  80,  80, ".$opacity.")',", mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]);//255,  99, 132
  }function getColorB($opacity='0.4'){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
    return  str_repeat ("'rgba(225, 151,  76, ".$opacity.")',", mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]);// 54, 162, 235
  }function getColorC($opacity='0.4'){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
    return  str_repeat ("'rgba(204, 194,  16, ".$opacity.")',", mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]);//255, 206,  86
  }function getColorD($opacity='0.4'){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
    return  str_repeat ("'rgba(132, 186,  91, ".$opacity.")',", mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]);// 75, 192, 192
  }

  ?>
  <script src="/results/Chart.js"></script>
  <!--<canvas id="graph"></canvas>-->
  <canvas id="graph" style="height: 100%; min-height: 390px; width: 100%; min-width: 100%%; "></canvas>
  <script>
    new Chart(document.getElementById("graph"),{
      "type":"bar",
      "data":{
        "labels":[<?php 
          include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
          for ($i=1; $i < mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]; $i++) { 
            print_r("\"Q".$i."\", ");
          }?>/*"Q1", "Q2", "Q3", "Q4", "Q5", "Q6", "Q7", "Q8",*/],
        "datasets":[
          {
            label:"A",
            /*data:[20, 10, 30, 15, 23, 33],*/
            data:[<?php print_r(getData("A")); ?>],
            backgroundColor: [
                <?php echo getColorA(); ?>
            ],
            borderColor: [
                <?php echo getColorA(1); ?>
            ],
            borderWidth: 2,
          },{
            label:"B",
            data:[<?php print_r(getData("B")); ?>],
            backgroundColor: [
                <?php echo getColorB(); ?>
            ],
            borderColor: [
                <?php echo getColorB(1); ?>
            ],
            borderWidth: 2,
          },{
            label:"C",
            data:[<?php print_r(getData("C")); ?>],
            backgroundColor: [
                <?php echo getColorC(); ?>
            ],
            borderColor: [
                <?php echo getColorC(1); ?>
            ],
            borderWidth: 2,
          },{
            label:"D",
            data:[<?php print_r(getData("D")); ?>],
            backgroundColor: [
                <?php echo getColorD(0.2); ?>
            ],
            borderColor: [
                <?php echo getColorD(1); ?>
            ],
            borderWidth: 2,
          }
        ]
      },
      "options":{
        responsive: true,
        title: {
            display: true,
            text: 'Frequency of Responses',
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
              }
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