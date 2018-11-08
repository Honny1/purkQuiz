<!DOCTYPE html>
<html>
<head scrolling="no">
    <?php //include "../header.php" ?>
    <title>Results of Quiz</title>
    <meta http-equiv="refresh" content="15;url=./marek.php">
    <meta property="og:title" content="Results of Quiz" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://quiz.buchticka.eu/images/background.jpg" />
    <meta property="og:description" content="Results of Quiz about IT" />
    <link rel="stylesheet" type="text/css" href="/styles/style.css">

    <style type="text/css">
        html{
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
                <a href="graphFoR_lukyn.php">
                    <iframe src="graphFoR_lukyn.php" href="graphFoR_lukyn.php" style="width: 100%; height: 105%; min-height: 400px; " frameborder="0" valign="top" align="left" scrolling="no"></iframe>
                </a>
            </td>
            <td style="width: 50%; height: 100%; " class="graph" valign="top">
                <a href="graphSoT_lukyn.php">
                    <iframe src="graphSoT_lukyn.php" style="width: 100%; height: 105%; min-height: 400px; " frameborder="0" valign="top" align="left" scrolling="no"></iframe>
                </a>
            </td>
        </tr>
    </table>
    <table class="mui-table mui-table--bordered">
        <thead>
            <th style="text-align: center; width: 25%;">Max</th>
            <th style="text-align: center; width: 25%;">Min</th>
            <th style="text-align: center; width: 25%;">Avg</th>
            <th style="text-align: center; width: 25%;">Total time</th>
        </thead>
        <tbody>
            <td id="max"></td>
            <td id="min"></td>
            <td id="avg"></td>
            <td id="totalTime"></td>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tr style="width: 100%;">
            <td style="width: 50%;" valign="top">
                <table class="mui-table mui-table--bordered">
                    <tfoot><h2>LAST 10</h2></tfoot>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center; min-width: 110px;">Score</th>
                            <!--<th style="text-align: center; width: 60px;">AQ1</th> 
                            <th style="text-align: center; width: 60px;">AQ2</th>
                            <th style="text-align: center; width: 60px;">AQ3</th> 
                            <th style="text-align: center; width: 60px;">AQ4</th> 
                            <th style="text-align: center; width: 60px;">AQ5</th> 
                            <th style="text-align: center; width: 60px;">AQ6</th> 
                            <th style="text-align: center; width: 60px;">AQ7</th> 
                            <th style="text-align: center; width: 60px;">AQ8</th>-->
                            <th style="text-align: center;">Time</th> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        include $_SERVER['DOCUMENT_ROOT'].'/calcResults/getScore.php';
                                                            
                        include $_SERVER['DOCUMENT_ROOT'].'/controlDatabase/dbconnect.php';
                        $questionsSql = "SELECT * FROM question";
                        $questionsQuery = mysqli_query($conn, $questionsSql);
                        if (!$questionsQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                        $correctAnswers = array();
                        while ($questionRow = mysqli_fetch_array($questionsQuery)) {
                             array_push($correctAnswers, $questionRow["correct"]);
                        }
                        //print_r($correctAnswers);

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
                        /*
                        
                                    <td style='".styleTd($answerRow['AQ1'], 1)."'>".$answerRow['AQ1']."</td>
                                    <td style='".styleTd($answerRow['AQ2'], 2)."'>".$answerRow['AQ2']."</td>
                                    <td style='".styleTd($answerRow['AQ3'], 3)."'>".$answerRow['AQ3']."</td>
                                    <td style='".styleTd($answerRow['AQ4'], 4)."'>".$answerRow['AQ4']."</td>
                                    <td style='".styleTd($answerRow['AQ5'], 5)."'>".$answerRow['AQ5']."</td>
                                    <td style='".styleTd($answerRow['AQ6'], 6)."'>".$answerRow['AQ6']."</td>
                                    <td style='".styleTd($answerRow['AQ7'], 7)."'>".$answerRow['AQ7']."</td>
                                    <td style='".styleTd($answerRow['AQ8'], 8)."'>".$answerRow['AQ8']."</td>
                         */
                        $answersSql = "SELECT * FROM answers ORDER BY ID DESC LIMIT 10";
                        $answersQuery = mysqli_query($conn, $answersSql);
                        if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

                        while ($answerRow = mysqli_fetch_array($answersQuery)) {
                            echo "<tr>
                                    <td>".$answerRow['name']."</td>
                                    <td>". round(getScore($answerRow['name']))."</td>
                                    <!--<td>".$answerRow['AQ1']."</td>
                                    <td>".$answerRow['AQ2']."</td>
                                    <td>".$answerRow['AQ3']."</td>
                                    <td>".$answerRow['AQ4']."</td>
                                    <td>".$answerRow['AQ5']."</td>
                                    <td>".$answerRow['AQ6']."</td>
                                    <td>".$answerRow['AQ7']."</td>
                                    <td>".$answerRow['AQ8']."</td>-->
                                    <td>".bcdiv(bcsub($answerRow['timeAQ'.(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],$answerRow['startTime']),'1000',2)." s</td>
                                 </tr>";
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
                            <th style="text-align: center; min-width: 110px;">Score</th>
                            <!--<th style="text-align: center; width: 60px;">AQ1</th> 
                            <th style="text-align: center; width: 60px;">AQ2</th>
                            <th style="text-align: center; width: 60px;">AQ3</th> 
                            <th style="text-align: center; width: 60px;">AQ4</th> 
                            <th style="text-align: center; width: 60px;">AQ5</th> 
                            <th style="text-align: center; width: 60px;">AQ6</th> 
                            <th style="text-align: center; width: 60px;">AQ7</th> 
                            <th style="text-align: center; width: 60px;">AQ8</th>-->
                           <th style="text-align: center;">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        include $_SERVER['DOCUMENT_ROOT'].'/controlDatabase/dbconnect.php';
                        /*$questionsSql = "SELECT * FROM question ORDER BY score DESC LIMIT 10";
                        $questionsQuery = mysqli_query($conn, $questionsSql);
                        if (!$questionsQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                        $correctAnswers = array();
                        while ($questionRow = mysqli_fetch_array($questionsQuery)) {
                             array_push($correctAnswers, $questionRow["correct"]);
                        }*/
                        
                        $answersSql = "SELECT * FROM rank ORDER BY score DESC LIMIT 10";
                        $answersQuery = mysqli_query($conn, $answersSql);
                        if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

                        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
                        while ($answerRow = mysqli_fetch_array($answersQuery)) {
                            echo "<tr>
                                    <td>".$answerRow['user_name']."</td>
                                    <td>".$answerRow['score']."</td>
                                    <td>".floor(((float)$answerRow['solutionTime'] /1000)/60)." s</td>
                                    <!--<td>".bcdiv($answerRow['solutionTime'],'1000',2)." s</td>-->
                                 </tr>";
                            }
                        mysqli_close($conn);
                    /*
                        include $_SERVER['DOCUMENT_ROOT'].'/controlDatabase/dbconnect.php';
                        $questionsSql = "SELECT * FROM question";
                        $questionsQuery = mysqli_query($conn, $questionsSql);
                        if (!$questionsQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                        $correctAnswers = array();
                        while ($questionRow = mysqli_fetch_array($questionsQuery)) {
                             array_push($correctAnswers, $questionRow["correct"]);
                        }
                        
                        $answersSql = "SELECT * FROM rank ORDER BY score DESC LIMIT 10";
                        $answersQuery = mysqli_query($conn, $answersSql);
                        if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

                        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
                        while ($answerRow = mysqli_fetch_array($answersQuery)) {
                            echo "<tr>
                                    <td>".$answerRow['user_name']."</td>
                                    <td>".$answerRow['score']."</td>
                                    <td>".
                                        bcdiv(
                                            bcsub(
                                                mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM answers"))['timeAQ'.(
                                                mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)],
                                                mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM answers"))['startTime']
                                            ),'1000',2
                                        )."s</td>
                                 </tr>";
                            }
                        mysqli_close($conn);*/
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
            <?php include $_SERVER['DOCUMENT_ROOT'].'/controlDatabase/dbconnect.php'; ?>
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
            document.getElementById("totalTime").innerHTML  = "<?php
                $totalTimeScoreQuery = mysqli_query($conn, "SELECT SUM(`timeAQ".(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM settings"))["countOfActiveQuestions"]-1)."`) FROM answers");
                if (!$totalTimeScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                $startTimeScoreQuery = mysqli_query($conn, "SELECT SUM(`startTime`) FROM answers");
                if (!$startTimeScoreQuery) {die ('SQL Error: ' . mysqli_error($conn));}
                echo bcdiv(bcsub(mysqli_fetch_array($totalTimeScoreQuery)[0],mysqli_fetch_array($startTimeScoreQuery)[0]),'1000',2);
                mysqli_close($conn);
            ?>s";

        }
        window.onload = function () {
            getStatisticTable();
        }
        //todo cas jak dlouho a kdy přidat do tabulky a odpovedi... a udělat gaf https://jpgraph.net/features/src/show-example.php?target=new_bar1.php
        

    </script>
    <button style="display: none;" onload="sortTable(1);">MILUJU NEVIDITELNÝ TLAČÍTKA</button>
</body>
</html>