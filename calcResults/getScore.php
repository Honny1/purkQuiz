<?php 
    //  return score generated from time
    function calcScore($startTime,$endTime){
        $score=1000+(($startTime-$endTime)/100);
        if ($score<50){
            return 50;
        }
        return $score;   
    }

    //  return score
    function getScore($name){
        include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php';
        $userScore = 0;

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
            // This condition says to show question page or save page
            if ($indexOfQuestion != ($settingsRow["countOfActiveQuestions"]+(1-$settingsRow["autoSave"]))) {
                $userResultSql = "SELECT * FROM answers WHERE name='".$name."'; ";
                $userResultQuery = mysqli_query($conn, $userResultSql);
                if (!$userResultQuery) {die ('SQL Error: ' . mysqli_error($conn));}

                $questionSql = "SELECT * FROM question WHERE `id_question` = '".$indexOfQuestion."'; ";
                $questionQuery = mysqli_query($conn, $questionSql);
                if (!$questionQuery) {die ('SQL Error: ' . mysqli_error($conn));}

                $questionRow = mysqli_fetch_array($questionQuery);
                $userResultRow = mysqli_fetch_array($userResultQuery);
                if($questionRow["correct"] == $userResultRow[sprintf('AQ%d', $indexOfQuestion)]){
                    $userScore += calcScore($userResultRow['startTime'], $userResultRow[sprintf('timeAQ%d', $questionRow["id_question"])]);
                }
            }
        }
        mysqli_close($conn);
        return $userScore;
    }

?>