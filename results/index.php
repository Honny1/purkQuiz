<?php
include '../calcResults/getScore.php';
include '../controlDatabase/dbConnect.php';

function getIdOfActiveQuestions(){
    // This function return array of IDs question in active questionSet
    // Get active settings
    global $conn;
    $settingsQuery = mysqli_query($conn, "SELECT * FROM settings WHERE `id` = 1; ");
    if (!$settingsQuery) {
       die ('SQL Error: ' . mysqli_error($conn));
    }
    $settingsRow = mysqli_fetch_array($settingsQuery);
    
    // Get active question set
    $questionSetQuery = mysqli_query($conn, "SELECT * FROM questionset WHERE `id_qs` = ".$settingsRow["idOfActiveQuestionSet"]."; ");
    if (!$questionSetQuery) {
        die ('SQL Error: ' . mysqli_error($conn));
    }
    $questionSetRow = mysqli_fetch_array($questionSetQuery);
    $questionsArray = explode(", ", implode((array)$questionSetRow["questions"]));
    return (array)($questionsArray);
}
$activeQuestionsArray = getIdOfActiveQuestions();

function getIdOfLastQuestion(){
    // This function return ID of last question in active questionSet
    // Get active settings
    global $conn;
    $settingsQuery = mysqli_query($conn, "SELECT * FROM settings WHERE `id` = 1; ");
    if (!$settingsQuery) {
        die ('SQL Error: ' . mysqli_error($conn));
    }
    $settingsRow = mysqli_fetch_array($settingsQuery);

    // Get active question set
    $questionSetQuery = mysqli_query($conn, "SELECT * FROM questionset WHERE `id_qs` = ".$settingsRow["idOfActiveQuestionSet"]."; ");
    if (!$questionSetQuery) {
        die ('SQL Error: ' . mysqli_error($conn));
    }
    $questionSetRow = mysqli_fetch_array($questionSetQuery);
    $questionsArray = explode(", ", implode((array)$questionSetRow["questions"]));
    return (int)end($questionsArray);
}

function isCorrectAnswer($userAnswer='A', $numberOfQuestion=1){
    global $correctAnswers;
    return (boolean)((string)$correctAnswers[(string)($numberOfQuestion-1)] == (string)$userAnswer);
}
                        
function styleTd($userAnswer='A', $numberOfQuestion=1){
    if (isCorrectAnswer($userAnswer, $numberOfQuestion)) {
        return "background-color: rgba(132, 186,  91, 0.6); ";
    }else{
        return "background-color: rgba(255,  80,  80, 0.6); ";
    }
}

?>

<!DOCTYPE html>
<html>
<head scrolling="no">
    <title>Results of Quiz</title>
    <meta http-equiv="refresh" content="15;url=">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#2e3136">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#2e3136">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#2e3136">
    <meta property="og:title" content="Results of Quiz" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://<?php echo $_SERVER['HTTP_HOST']; ?>/images/background.jpg" />
    <meta property="og:description" content="Results of Quiz about IT" />
    <link rel="stylesheet" type="text/css" href="/styles/style.css">

    <style type="text/css">
        html{
            overflow:hidden;
            background-color: #2e3136; /*#161719;/*black*/
            background-image: none;
            color: rgba(173,255,47, 0.8); /*greenyellow;*/
            text-align: center;
        }
        body{
            /*overflow:hidden;*/
            background: transparent;
            text-align: center;
            min-width: 500px;
            font-family: Trebuchet MS;
        }
        #graph{
            background-color: none; /*rgba(0, 255, 0, 0.63);*/
        }
        .footer{
            /*width: 100%; */
            background-color: rgba(255, 255, 255, 0.75); /* transparent;*/
            color: #2e3136;
            font-size: 90%;
            position: fixed;
            /*top: 20%;*/
            bottom: 0%;
            left:  45%;
            right: 45%;
            -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0px 2px 0 rgba(0, 0, 0, 0.12);
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0px 2px 0 rgba(0, 0, 0, 0.12);
        }

        table{
            text-align: center;
        }
        th{
            text-align: center;
        }
        td{
            text-align: center;
        }

        /**
         * MUI Table Component
         */
        .mui-table {
          width: 100%;
          max-width: 100%;
          margin-bottom: 15px;
          /*margin-bottom: 20px;*/
        }

        .mui-table > thead > tr > th,
        .mui-table > tbody > tr > th,
        .mui-table > tfoot > tr > th {
          text-align: left;
        }

        .mui-table > thead > tr > th,
        .mui-table > thead > tr > td,
        .mui-table > tbody > tr > th,
        .mui-table > tbody > tr > td,
        .mui-table > tfoot > tr > th,
        .mui-table > tfoot > tr > td {
            padding: 4px;
          /*padding: 10px;*/
          line-height: 1.429;
        }

        .mui-table > thead > tr > th {
          /*border-bottom: 2px solid rgba(0, 0, 0, 0.12);*/
          border-bottom: 4px solid rgba(0, 255, 0, 0.6);
          font-weight: 700;
        }

        .mui-table > tbody + tbody {
          /*border-top: 2px solid rgba(0, 0, 0, 0.12);*/
          border-top: 2px solid rgba(0, 255, 0, 0.4);
        }

        .mui-table.mui-table--bordered > tbody > tr > td {
          /*border-bottom: 1px solid rgba(0, 0, 0, 0.12);*/
          border-bottom: 1px solid rgba(0, 255, 0, 0.4);
        }


    </style>
  
</head>
<body>
    <h1 style="font-size: 290%; padding-top: 10px; border: none; margin: 0px; ">Results of Quiz</h1>
    <table style="width: 100%; ">
        <tr style="width: 100%;  ">
            <td style="width: 50%; height: 100%; " class="graph" valign="top">
                <a href="graphFoR.php">
                    <iframe src="graphFoR.php" href="graphFoR.php" style="width: 100%; height: 105%; min-height: 400px; " frameborder="0" valign="top" align="left" scrolling="no"></iframe>
                </a>
            </td>
            <td style="width: 50%; height: 100%; " class="graph" valign="top">
                <a href="graphSoT.php">
                    <iframe src="graphSoT.php" style="width: 100%; height: 105%; min-height: 400px; " frameborder="0" valign="top" align="left" scrolling="no"></iframe>
                </a>
            </td>
        </tr>
    </table>

    <!--<h2>Score statistics</h2>-->
    <table class="mui-table mui-table--bordered">
        <thead>
            <th style="text-align: center; width: 25%;">Maximal score</th>
            <th style="text-align: center; width: 25%;">Minimal score</th>
            <th style="text-align: center; width: 25%;">Average score</th>
            <th style="text-align: center; width: 25%;">Average time</th>
        </thead>
        <tbody>
            <td id="max"></td>
            <td id="min"></td>
            <td id="avg"></td>
            <td id="avgTime"></td>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tr style="width: 100%;">
            <td style="width: 50%;" valign="top">
                <table class="mui-table mui-table--bordered">
                    <tfoot><h2>NEWEST 10</h2></tfoot>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center; min-width:  30px;">Try</th>
                            <th style="text-align: center; min-width: 110px;">Score</th>
                            <th style="text-align: center; min-width:  60px;">Time</th>
                            <?php
                                foreach(getIdOfActiveQuestions() as $i){
                                        echo ("<th style='text-align: center; '>Q$i</th>");
                                }
                            ?> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $questionsSql = "SELECT * FROM question";
                        $questionsQuery = mysqli_query($conn, $questionsSql);
                        if (!$questionsQuery) {
                            die ('SQL Error: ' . mysqli_error($conn));
                        }
                        
                        $correctAnswers = array();
                        while ($questionRow = mysqli_fetch_array($questionsQuery)) {
                             array_push($correctAnswers, $questionRow["correct"]);
                        }
                        //print_r($correctAnswers);

                        $answersSql = "SELECT * FROM answers ORDER BY ID DESC LIMIT 10";
                        $answersQuery = mysqli_query($conn, $answersSql);
                        if (!$answersQuery) {
                            die ('SQL Error: ' . mysqli_error($conn));
                        }

                        while ($answerRow = mysqli_fetch_array($answersQuery)) {
                            echo "<tr>
                                    <td>".$answerRow['name']."</td>
                                    <td>".$answerRow['try']."</td>
                                    <td>".round(getScore($answerRow['name'], $answerRow['try']))."</td>
                                    <td>".bcdiv(bcsub($answerRow['timeAQ'.((string)getIdOfLastQuestion())],$answerRow['startTime']),'1000',2)." s</td>";
                            foreach($activeQuestionsArray as $i){
                                print_r("<td style='".styleTd($answerRow["AQ$i"], $i)."'>".$answerRow["AQ$i"]."</td>");
                            }
                            echo "</tr>";
                          }
                        mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%;" valign="top">
                <table class="mui-table mui-table--bordered">
                    <tfoot><h2>TOP 10</h2></tfoot>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center; min-width:  30px;">Try</th>
                            <th style="text-align: center; min-width: 110px;">Score</th>
                            <th style="text-align: center;">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        include '../controlDatabase/dbConnect.php';
                        
                        $answersSql = "SELECT * FROM rank ORDER BY score DESC LIMIT 10";
                        $answersQuery = mysqli_query($conn, $answersSql);
                        if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

                        //ini_set('max_execution_time', 300); //300 seconds = 5 minutes
                        while ($answerRow = mysqli_fetch_array($answersQuery)) {
                            echo "<tr>
                                    <td>".$answerRow['user_name']."</td>
                                    <td>".$answerRow['try']."</td>
                                    <td>".$answerRow['score']."</td>
                                    <td>".bcdiv($answerRow['solutionTime'],'1000',2)." s</td>
                                 </tr>";
                            }
                        mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <script>
        function sortTable(n) {
          var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
          table = document.getElementById("myTable");
          switching = true; 
          dir = "asc"; 
          
          while (switching) {
           
            switching = false;
            rows = table.rows;
           
            for (i = 1; i < (rows.length - 1); i++) {
              
              shouldSwitch = false;
              
              x = rows[i].getElementsByTagName("TD")[n];
              y = rows[i + 1].getElementsByTagName("TD")[n];
              
              if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                  
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (Number(x.innerHTML.toLowerCase()) < Number(y.innerHTML.toLowerCase())) {
                  shouldSwitch = true;
                  break;
                }
              }
            }
            if (shouldSwitch) {
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
              switchcount ++;      
            } else {
              if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
              }
            }
          }
        }

        function getStatisticTable() {
            <?php include '../controlDatabase/dbConnect.php'; ?>
            document.getElementById("max").innerHTML =  "<?php
                $maxScoreQuery = mysqli_query($conn, "SELECT MAX(`score`) FROM rank");
                if (!$maxScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                print_r(mysqli_fetch_array($maxScoreQuery)[0]);
            ?>";
            document.getElementById("min").innerHTML =  "<?php
                $minScoreQuery = mysqli_query($conn, "SELECT MIN(`score`) FROM rank");
                if (!$minScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                print_r(mysqli_fetch_array($minScoreQuery)[0]);
            ?>";
            document.getElementById("avg").innerHTML = "<?php
                $avgScoreQuery = mysqli_query($conn, "SELECT AVG(`score`) FROM rank");
                if (!$avgScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                print_r(mysqli_fetch_array($avgScoreQuery)[0]);
            ?>";
            document.getElementById("avgTime").innerHTML = "<?php
                $avgScoreQuery = mysqli_query($conn, "SELECT AVG(`solutionTime`) FROM rank");
                if (!$avgScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                //print_r(date("h:m:s", bcdiv(mysqli_fetch_array($avgScoreQuery)[0]),'1000',2));
                echo bcdiv(mysqli_fetch_array($avgScoreQuery)[0],'1000',2).' s';
            ?>";
            document.getElementById("totalTime").innerHTML  = "<?php
                $totalTimeScoreQuery = mysqli_query($conn, "SELECT SUM(`timeAQ".(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)."`) FROM answers");
                if (!$totalTimeScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                $startTimeScoreQuery = mysqli_query($conn, "SELECT SUM(`startTime`) FROM answers");
                if (!$startTimeScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                //echo bcdiv(bcsub(mysqli_fetch_array($totalTimeScoreQuery)[0],mysqli_fetch_array($startTimeScoreQuery)[0]),'1000',2);
                echo date("h:m:s", (int)bcdiv(bcsub(mysqli_fetch_array($totalTimeScoreQuery)[0],mysqli_fetch_array($startTimeScoreQuery)[0]),'1000',2))." s";
                //mysqli_close($conn);
            ?>";

        }
        window.onload = function () {
            getStatisticTable();
        }
        //todo cas jak dlouho a kdy přidat do tabulky a odpovedi... a udělat gaf https://jpgraph.net/features/src/show-example.php?target=new_bar1.php
        

    </script>
    <button style="display: none;" onload="sortTable(1);">MILUJU NEVIDITELNÝ TLAČÍTKA</button>
</body>
</html>
