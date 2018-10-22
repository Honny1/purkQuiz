<?php 
//return score per question
function calcScore($startTime,$endTime){
    $score=1000+(($startTime-$endTime)/100);
    if ($score<50){
        return 50;
    }
    return $score;   
}
//return score all questtion
function getScore($name){
	include $_SERVER['DOCUMENT_ROOT'].'controlDatabase/dbconnect.php';
    $userScore = 0;
   
    $questionSql = "SELECT * FROM question";
	$questionQuery = mysqli_query($conn, $questionSql);

	if (!$questionQuery) {die ('SQL Error: ' . mysqli_error($conn));}

	while ($questionRow = mysqli_fetch_array($questionQuery)) {
            $userResultSql = "SELECT * FROM answers WHERE name='".$name."'";
            $userResultQuery = mysqli_query($conn, $userResultSql);

            if (!$userResultQuery) {die ('SQL Error: ' . mysqli_error($conn));}

            while ($userResultRow = mysqli_fetch_array($userResultQuery)) {
                if($questionRow["correct"] == $userResultRow[sprintf('AQ%d', $questionRow["id_question"])]){
                    $userScore += calcScore($userResultRow['startTime'], $userResultRow[sprintf('timeAQ%d', $questionRow["id_question"])]);//
            }}
    }
mysqli_close($conn);
return $userScore;
}
?>