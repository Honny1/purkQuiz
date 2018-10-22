<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
include 'dbconnect.php';

$nextQuestion=$_GET["idQuestion"] + 1;
if ($nextQuestion!=8) {
if (isset($_GET["idQuestion"])) {
    $questionSql = "SELECT * FROM question WHERE id_question='".$_GET["idQuestion"]."'";
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
                                <center><span id='countdown' style='color: red;text-align: center; font-size: 300%;'></span></center>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
        		<td><button name='buttonAnswer' style='font-size: 200%;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $nextQuestion . " id='A' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'>".$questionRow['answer1']."</button></td>
            </tr>
            <tr>
        		<td><button name='buttonAnswer' style='font-size: 200%; background-color: red; color: white;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $nextQuestion . " id='B' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'>".$questionRow['answer2']."</button></td>
        	</tr>
        	<tr>
        		<td><button name='buttonAnswer' style='font-size: 200%; background-color: yellow; color: black;' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $nextQuestion . " id='C' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'>".$questionRow['answer3']."</button></td>
        	</tr>
            <tr>
            	<td><button  name='buttonAnswer' style='font-size: 200%; background-color: black; color: white; ' class='inGameButton mui-btn mui-btn--primary mui-btn--raised' value=" . $nextQuestion . " id='D' onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'>".$questionRow['answer4']."</button></td>
    		</tr>
    	</table>
        <button value=" . $nextQuestion . " id='NaN'style='display: none;'onClick='getNewQuestionFromDatabase(this.value);saveUserAnswers(this.id);stopCountdown();progressCountdown(10)'> Honyho neviditelné lahodné báječné tlačítko</button>
    </div>
    ";
}
mysqli_close($conn);
}else{
	 echo "	<div class='gamePin'>
            	<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
                    <h1>Ulož si hru!</h1>
		         	<h3>Stikni \"Save\" a ulož svoje výsledky!</h3>
		         	<button style='font-size: 160%;' class='startStopButtton mui-btn mui-btn--primary mui-btn--raised' onClick='saveAnswersToDatabase()'>SAVE</button>
	         	</div>
         	</div>";
}
?>
</body>
</html>