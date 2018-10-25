<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
include 'dbconnect.php';
include $_SERVER['DOCUMENT_ROOT'].'calcResults/getScore.php';
include 'saveReult.php';
include $_SERVER['DOCUMENT_ROOT'].'calcResults/getRank.php';
$userAnswers = $_GET["userAnswers"];

$userAnswersSplit = explode(",", $userAnswers);
$name = mysqli_real_escape_string($conn, $userAnswersSplit[0]);
$startTime = mysqli_real_escape_string($conn, $userAnswersSplit[1]);
$_AQ1 = mysqli_real_escape_string($conn, $userAnswersSplit[2]);
$timeAQ1 = mysqli_real_escape_string($conn, $userAnswersSplit[3]);
$_AQ2 = mysqli_real_escape_string($conn, $userAnswersSplit[4]);
$timeAQ2 = mysqli_real_escape_string($conn, $userAnswersSplit[5]);
$_AQ3 = mysqli_real_escape_string($conn, $userAnswersSplit[6]);
$timeAQ3 = mysqli_real_escape_string($conn, $userAnswersSplit[7]);
$_AQ4 = mysqli_real_escape_string($conn, $userAnswersSplit[8]);
$timeAQ4 = mysqli_real_escape_string($conn, $userAnswersSplit[9]);
$_AQ5 = mysqli_real_escape_string($conn, $userAnswersSplit[10]);
$timeAQ5 = mysqli_real_escape_string($conn, $userAnswersSplit[11]);
$_AQ6 = mysqli_real_escape_string($conn, $userAnswersSplit[12]);
$timeAQ6 = mysqli_real_escape_string($conn, $userAnswersSplit[13]);

$sql = "INSERT INTO answers (name,startTime,AQ1,timeAQ1,AQ2,timeAQ2,AQ3,timeAQ3,AQ4,timeAQ4,AQ5,timeAQ5,AQ6,timeAQ6) VALUES ('$name','$startTime','$_AQ1','$timeAQ1','$_AQ2','$timeAQ2','$_AQ3','$timeAQ3','$_AQ4','$timeAQ4','$_AQ5','$timeAQ5','$_AQ6','$timeAQ6')";

if ($conn->query($sql) === TRUE) {
	$score2 =getScore($name);
	saveToRank($name,$score2);
	echo "	<div class='gamePin'>
   				<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
   					<h2>Name:</h2>
   						<h1>".$name."</h1>
   					<h2>Score:</h2>
   						<h1>".$score2."</h1>";
   	getRank($name);
   	echo "</div></div>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
?>
</body>
</html>