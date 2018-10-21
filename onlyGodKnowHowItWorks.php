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
    echo "<h1>".$questionRow['wording']."</h1>
    <table style='width: 80%; ' align='center' valign='top'>
    	<tr style='min-width: 50%; min-height: 200px; width: 50%; height: 200px; max-width: 50%; '>
    		<td><button style='min-width: 300px; min-height: 150px; width: 100%; height: 100%; font-size: 200%; max-width: 600px; text-align: justify-all;' class='mui-btn mui-btn--primary mui-btn--raised' value=" . $nextQuestion . " id='A' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id)'>".$questionRow['answer1']."</button></td>
    		<td><button style='min-width: 300px; min-height: 150px; width: 100%; height: 100%; font-size: 200%; background-color: red; color: white; max-width: 600px;' class='mui-btn mui-btn--primary mui-btn--raised' value=" . $nextQuestion . " id='B' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id)'>".$questionRow['answer2']."</button></td>
    	</tr>
    	<tr style='min-width: 50%; min-height: 200px; width: 50%; height: 200px; max-width: 50%; '>
    		<td><button style='min-width: 300px; min-height: 150px; width: 600px; height: 100%; font-size: 200%; background-color: yellow; color: black; max-width: 600px;' class='mui-btn mui-btn--primary mui-btn--raised' value=" . $nextQuestion . " id='C' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id)'>".$questionRow['answer3']."</button></td>
    		<td><button style='min-width: 300px; min-height: 150px; width: 600px; height: 100%; font-size: 200%; background-color: black; max-width: 600px;' class='mui-btn mui-btn--primary mui-btn--raised' value=" . $nextQuestion . " id='D' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id)'>".$questionRow['answer4']."</button></td>
		</tr>
	</table>";
}
mysqli_close($conn);
}else{
	 echo "	<div class='gamePin'>
            	<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
                    <h1>Ulož si hru!</h1>
		         	<h3>Stikni \"Save\" a ulož svoje výsledky!</h3>
		         	<button class='mui-btn mui-btn--primary mui-btn--raised' onClick='saveAnswersToDatabase()'>SAVE</button>
	         	</div>
         	</div>";
}
?>
</body>
</html>