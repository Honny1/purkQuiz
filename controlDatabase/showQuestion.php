<?php
// This file return questions and answers
    include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
    include realpath($_SERVER['DOCUMENT_ROOT']).'/globalVar/variables.php';
?>
</head>
<body>
<?php
    if (isset($_GET["indexOfQuestion"])) {
        $indexOfQuestion = (int)$_GET["indexOfQuestion"];
    }else{
        $indexOfQuestion = 0;
    }
    $indexOfNextQuestion = $indexOfQuestion + 1;
    

    // Get active question set
    $settingsQuery = mysqli_query($conn, "SELECT * FROM settings WHERE `id` = 1; ");
    if (!$settingsQuery) {die ('SQL Error: ' . mysqli_error($conn));}
    $settingsRow = mysqli_fetch_array($settingsQuery);

    $questionSetQuery = mysqli_query($conn, "SELECT * FROM questionset WHERE `id_qs` = ".$settingsRow["idOfActiveQuestionSet"]."; ");
    if (!$questionSetQuery) {die ('SQL Error: ' . mysqli_error($conn));}
    $questionSetRow = mysqli_fetch_array($questionSetQuery);
    $questionsArray = explode(", ", implode((array)$questionSetRow["questions"]));

    // This condition says to show question page or save page
    if ($indexOfNextQuestion != ($settingsRow["countOfActiveQuestions"]-$settingsRow["autoSave"])) {
        $questionSql = "SELECT * FROM question WHERE `id_question` = '".($questionsArray[$indexOfQuestion])."'";
        
        $questionQuery = mysqli_query($conn, $questionSql);
        if (!$questionQuery) {die ('SQL Error: ' . mysqli_error($conn));}

        while ($questionRow = mysqli_fetch_array($questionQuery)) {
            echo "
            <div class='inGameBox'>
                <table style='width: 90%; ' align='center' valign='top'>
                    <tr>
                        <td>
                            <h1 style='font-size: 300%; text-align: center; '>".$questionRow['wording']."</h1>
                        </td>
                    </tr>
                    <tr align='center'>
                        <td align='center'>
                            <table align='center'>
                                <tr align='center' valign='top'>
                                    <td valign='left'>
                                        <h2 style='text-align: center; font-size: 200%; '>Zbývá:</h2>
                                    </td>
                                    <td valign='right'>
                                        <center><span id='countdown' style='color: red;text-align: center; font-size: 300%;'>10</span></center>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>";
                    if ($questionRow["answer1"] != "") {
                        echo "
                    <tr>
                        <td><button name='buttonAnswer' style='font-size: 200%;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $indexOfNextQuestion . " id='A' onClick='getNewQuestionFromQuestionSet(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'>".$questionRow['answer1']."</button></td>
                    </tr>";
                    }if ($questionRow["answer2"] != "") {
                        echo "
                    <tr>
                        <td><button name='buttonAnswer' style='font-size: 200%; background-color: red; color: white;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $indexOfNextQuestion . " id='B' onClick='getNewQuestionFromQuestionSet(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'>".$questionRow['answer2']."</button></td>
                    </tr>";
                    }if ($questionRow["answer3"] != "") {
                        echo "
                    <tr>
                        <td><button name='buttonAnswer' style='font-size: 200%; background-color: yellow; color: black;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $indexOfNextQuestion . " id='C' onClick='getNewQuestionFromQuestionSet(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'>".$questionRow['answer3']."</button></td>
                    </tr>
                    ";
                    }if ($questionRow["answer4"] != "") {
                        echo "
                    <tr>
                        <td><button  name='buttonAnswer' style='font-size: 200%; background-color: black; color: white; ' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $indexOfNextQuestion . " id='D' onClick='getNewQuestionFromQuestionSet(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'>".$questionRow['answer4']."</button></td>
                    </tr>";
                    }echo "
                </table>
                <button value=" . $indexOfNextQuestion . " id='NaN'style='display: none;'onClick='getNewQuestionFromQuestionSet(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'> Honyho neviditelné lahodné báječné tlačítko</button>
            </div>
            ";
        }
       
    }else{
        $settingsQuery = mysqli_query($conn, "SELECT * FROM settings WHERE ID = '1'");
        if (!$settingsQuery) {die ('SQL Error: ' . mysqli_error($conn));}
        $settingsRow = mysqli_fetch_array($settingsQuery);
        
        if ($settingsRow["autoSave"] == 1) {
            if (isset($indexOfQuestion) and isset($questionsArray)) {
                $questionSql = "SELECT * FROM question WHERE `id_question` = '".($questionsArray[$indexOfQuestion])."'";
                //$questionSql = "SELECT * FROM question WHERE id_question='".$indexOfQuestion."'";
            }else{
                $questionSql = "SELECT * FROM question";
            }
        
            $questionQuery = mysqli_query($conn, $questionSql);

            if (!$questionQuery) {die ('SQL Error: ' . mysqli_error($conn));}

            while ($questionRow = mysqli_fetch_array($questionQuery)) {
                echo "
                <div class='inGameBox'>
                    <table style='width: 90%; ' align='center' valign='top'>
                        <tr>
                            <td>
                                <h1 style='font-size: 300%; text-align: center; '>".$questionRow['wording']."</h1>
                            </td>
                        </tr>
                        <tr align='center'>
                            <td align='center'>
                                <table align='center'>
                                    <tr align='center' valign='top'>
                                        <td valign='left'>
                                            <h2 style='text-align: center; font-size: 200%; '>Zbývá:</h2>
                                        </td>
                                        <td valign='right'>
                                            <center><span id='countdown' style='color: red;text-align: center; font-size: 300%;'>10</span></center>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><button name='buttonAnswer' id='A' style='font-size: 200%;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $indexOfNextQuestion . " onClick='saveUserAnswers(this.id);stopCountdown();saveAnswersToDatabase()'>".$questionRow['answer1']."</button></td>
                        </tr>
                        <tr>
                            <td><button name='buttonAnswer' id='B' style='font-size: 200%; background-color: red; color: white;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $indexOfNextQuestion . " onClick='saveUserAnswers(this.id);stopCountdown();saveAnswersToDatabase()'>".$questionRow['answer2']."</button></td>
                        </tr>
                        <tr>
                            <td><button name='buttonAnswer' id='C' style='font-size: 200%; background-color: yellow; color: black;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $indexOfNextQuestion . " onClick='saveUserAnswers(this.id);stopCountdown();saveAnswersToDatabase()'>".$questionRow['answer3']."</button></td>
                        </tr>
                        <tr>
                            <td><button name='buttonAnswer' id='D' style='font-size: 200%; background-color: black; color: white; ' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $indexOfNextQuestion . " onClick='saveUserAnswers(this.id);stopCountdown();saveAnswersToDatabase()'>".$questionRow['answer4']."</button></td>
                        </tr>
                    </table>
                    <button value=" . $indexOfNextQuestion . " id='NaN'style='display: none;'onClick='saveUserAnswers(this.id);stopCountdown();saveAnswersToDatabase()'>if countdown==0 auto press this button</button>
                </div>
                ";
            }
        }else{
            echo "
            <div class='gamePin'>
                <div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
                    <h1>Ulož si hru!</h1>
                    <h3>Stikni \"Save\" a ulož svoje výsledky!</h3>
                    <button style='font-size: 160%;' class='startStopButtton mui-btn mui-btn--primary mui-btn--raised' onClick='stopCountdown();saveAnswersToDatabase()' id='saveMyShit'>SAVE</button>
                 </div>
             </div>";
             }
        } 
    mysqli_close($conn);
?>