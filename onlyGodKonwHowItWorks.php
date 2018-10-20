<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
include 'dbconnect.php';

$nextQuestion=$_GET["idQuestion"] + 1;
if ($nextQuestion!=5) {
if (isset($_GET["idQuestion"])) {
    $questionSql = "SELECT * FROM question WHERE id_question='".$_GET["idQuestion"]."'";
}else{
    $questionSql = "SELECT * FROM question";
}
    
$questionQuery = mysqli_query($conn, $questionSql);

if (!$questionQuery) {die ('SQL Error: ' . mysqli_error($conn));}

while ($questionRow = mysqli_fetch_array($questionQuery)) {
    echo "<h1>".$questionRow['wording']."</h1>";
    echo "<button value=" . $nextQuestion . " id='A' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id)'>".$questionRow['answer1']."</button>";
    echo "<button value=" . $nextQuestion . " id='B' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id)'>".$questionRow['answer2']."</button>";
    echo "<button value=" . $nextQuestion . " id='C' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id)'>".$questionRow['answer3']."</button>";
    echo "<button value=" . $nextQuestion . " id='D' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id)'>".$questionRow['answer4']."</button>";
}
mysqli_close($conn);
}else{
	 echo "<button onClick='saveAnswersToDatabase()'>SAVE</button>";
}
?>
</body>
</html>