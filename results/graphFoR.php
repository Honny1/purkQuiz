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
  function getData($answer="A"){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php';
    $countToReturn = 0;

    // Get active settings
    $settingsQuery = mysqli_query($conn, "SELECT * FROM settings WHERE `id` = 1; ");
    if (!$settingsQuery) {die ('SQL Error: ' . mysqli_error($conn));}
    $settingsRow = mysqli_fetch_array($settingsQuery);

    // Get active question set
    $questionSetQuery = mysqli_query($conn, "SELECT * FROM questionset WHERE `id_qs` = ".$settingsRow["idOfActiveQuestionSet"]."; ");
    if (!$questionSetQuery) {die ('SQL Error: ' . mysqli_error($conn));}
    $questionSetRow = mysqli_fetch_array($questionSetQuery);
    $questionsArray = explode(", ", implode((array)$questionSetRow["questions"]));

    foreach ($questionsArray as &$indexOfQuestion) {
      $answersSql = "SELECT COUNT(`AQ$indexOfQuestion`) FROM answers WHERE `AQ$indexOfQuestion` = '$answer'";
      $answersQuery = mysqli_query($conn, $answersSql);
      if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}
      print_r(mysqli_fetch_array($answersQuery)[0].", ");
    }return $countToReturn;
    
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
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php';
    return  str_repeat ("'rgba(255,  80,  80, ".$opacity.")',", mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]);//255,  99, 132
  }function getColorB($opacity='0.4'){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php';
    return  str_repeat ("'rgba(225, 151,  76, ".$opacity.")',", mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]);// 54, 162, 235
  }function getColorC($opacity='0.4'){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php';
    return  str_repeat ("'rgba(204, 194,  16, ".$opacity.")',", mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]);//255, 206,  86
  }function getColorD($opacity='0.4'){
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php';
    return  str_repeat ("'rgba(132, 186,  91, ".$opacity.")',", mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]);// 75, 192, 192
  }

  ?>
  <script src="/js/chart.js"></script>
  <!--<canvas id="graph"></canvas>-->
  <canvas id="graph" style="height: 100%; min-height: 390px; width: 100%; min-width: 100%%; "></canvas>
  <script>
    new Chart(document.getElementById("graph"),{
      "type":"bar",
      "data":{
        "labels":[<?php 
          include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php';
          // Get active settings
          $settingsQuery = mysqli_query($conn, "SELECT * FROM settings WHERE `id` = 1; ");
          if (!$settingsQuery) {die ('SQL Error: ' . mysqli_error($conn));}
          $settingsRow = mysqli_fetch_array($settingsQuery);

          // Get active question set
          $questionSetQuery = mysqli_query($conn, "SELECT * FROM questionset WHERE `id_qs` = ".$settingsRow["idOfActiveQuestionSet"]."; ");
          if (!$questionSetQuery) {die ('SQL Error: ' . mysqli_error($conn));}
          $questionSetRow = mysqli_fetch_array($questionSetQuery);
          $questionsArray = explode(", ", implode((array)$questionSetRow["questions"]));

          foreach ($questionsArray as &$indexOfQuestion) {
            print_r("\"Q".$indexOfQuestion."\", ");
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
