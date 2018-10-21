<?php
function rank($name,$score){
 	include 'getScore.php';
	include 'dbconnect.php';
	
	$results= array();
	$maxRank=0;
	$answersSql = "SELECT * FROM answers";
	$answersQuery = mysqli_query($conn, $answersSql);

	if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

	while ($answerRow = mysqli_fetch_array($answersQuery)) {
		
		echo $score;
		echo $answerRow['name'];
		array_push($results,$score,$answerRow['name']);
		$maxRank++;
    }
	mysqli_close($conn);
	

}
?>