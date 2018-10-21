<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
include 'dbconnect.php';
include 'getScore.php';
include 'rank.php';
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

$sql = "INSERT INTO answers (name,startTime,AQ1,timeAQ1,AQ2,timeAQ2,AQ3,timeAQ3) VALUES ('$name','$startTime','$_AQ1','$timeAQ1','$_AQ2','$timeAQ2','$_AQ3','$timeAQ3')";

if ($conn->query($sql) === TRUE) {
	echo "	<div class='gamePin'>
   				<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
   					<h2>Name:</h2>
   						<h1>".$name."</h1>
   					<h2>Score:</h2>
   						<h1>".getScore($name)."</h1>
   					<h2>umisteniAnglicky:</h2>
   						<h1>".$pozice." z ".$celkemUzivatelu."</h1>
				</div>
			</div>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
?>
</body>
</html>