<?php 
//save user ansvers to db and evaluate and return score and rank on web
include 'dbconnect.php';
include $_SERVER['DOCUMENT_ROOT'].'calcResults/getScore.php';
include 'saveReult.php';
include $_SERVER['DOCUMENT_ROOT'].'calcResults/getRank.php';

$userAnswers = $_GET["userAnswers"];

$userAnswersSplit = explode(",", $userAnswers);
$name = mysqli_real_escape_string($conn, $userAnswersSplit[0]);


$sql = "INSERT INTO answers ( name, startTime";

  for ($i=1; $i <(sizeof($userAnswersSplit)/2)-1 ; $i++) { 
    $sql .= ", AQ".$i.", timeAQ".$i;
  }
  $sql .= ") VALUES ('$name'";
  for ($i=1; $i <sizeof($userAnswersSplit)-1 ; $i++){
    $nasrat=mysqli_real_escape_string($conn, $userAnswersSplit[$i]);
    $sql .= ",";
    $sql .= "'$nasrat'";
    
  }
  $sql .= ")";

if ($conn->query($sql) === TRUE) {
	$score2 =getScore($name);
	saveToRank($name,$score2);
	echo "	<div class='gamePin'>
   				<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
   					<h2>Name:</h2>
   						<h1>".$name."</h1>
   					<h2>Score:</h2>
   						<h1 id='score'>".$score2."</h1>";
   	getRank($name);
   	echo "</div></div>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
?>