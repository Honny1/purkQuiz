<?php
include '../dbconnect.php';
include '../header.php';

echo "
	<title>Dashboard - Admin Quiz</title>
	<meta property='og:title' content='Dashboard - Admin Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://quiz.buchticka.eu/images/backgroundSmaller.jpg' />
	<meta property='og:description' content='Quizs Dashboard' />
  
</head>
<body style='background-color: transparent;'>
	<center>
		<div style='position: absolute; top: 20px; left: 30%; right: 30%; background-color: rgba(255, 255, 255, 0.75); padding: 0px;' class='mui-panel'>
			<h1 style='margin: none; padding-top: 0px; border: none;'>Dashboard</h1>
		</div>
		<div style='position: absolute; top: 105px; left: 30%; right: 30%; background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
			<a href='dashboard.php?username=".$_GET["username"]."&password=".$_GET["password"]."&showMe=questions'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Questions</button></a>
			<a href='dashboard.php?username=".$_GET["username"]."&password=".$_GET["password"]."&showMe=quizs'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Quizs</button></a>
			<a href='dashboard.php?username=".$_GET["username"]."&password=".$_GET["password"]."&showMe=results'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Results</button></a>
			<a href='dashboard.php?username=".$_GET["username"]."&password=".$_GET["password"]."&showMe=addQquestion'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Add Question</button></a>
		</div>
		<div style='background-color: rgba(255, 255, 255, 0.75);' class='dashboardContent mui-panel' >
";
if (isset($_GET["username"]) and isset($_GET["password"])) {
	//header("Content-Type: text/html;charset=UTF-8");
	mysqli_query($conn, "SET NAMES 'UTF-8'");
	$sql = 'SELECT username, password, nick FROM user';
	$query = mysqli_query($conn, $sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($conn));
	}while ($row = mysqli_fetch_array($query)){
		if ($_GET["username"] == $row["username"] and $_GET["password"] == $row["password"]){
			if (isset($_GET["showMe"])) {
				if ($_GET["showMe"] == "questions") {
					echo "
					<table class='mui-table mui-table--bordered'>
					<h2>Questions</h2>
						<thead>
							<tr>
								<th style='text-align: center; width: 40px; '>ID</th>
								<th>Wording</th>
								<th style='width: 40px; text-align: center;'>Correct</th>
								<th>A - Answer1</th>
								<th>B - Answer2</th>
								<th>C - Answer3</th>
								<th>D - Answer4</th>
							</tr>
						</thead>
						<tbody>";
						$questionSql = "SELECT * FROM question";
						$questionQuery = mysqli_query($conn, $questionSql);

						if (!$questionQuery) {
							die ('SQL Error: ' . mysqli_error($conn));}
						while ($questionRow = mysqli_fetch_array($questionQuery)) {
							echo "
							<tr>
								<td style='text-align: center;'>".$questionRow["id_question"]."</td>
								<td>".$questionRow["wording"]."</td>
								<td style='text-align: center;'>".$questionRow["correct"]."</td>
								<td>".$questionRow["answer1"]."</td>
								<td>".$questionRow["answer2"]."</td>
								<td>".$questionRow["answer3"]."</td>
								<td>".$questionRow["answer4"]."</td>
							</tr>";
							}echo "
						</tbody
					</table>";
				}elseif ($_GET["showMe"] == "quizs") {
					echo "<h2>Quizs</h2>

					<table class='mui-table mui-table--bordered'>
						<thead>
							<tr>
								<th style='width: 40px; text-align: center;'>ID</th>
								<th>Name</th>
								<th>Questions</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>";
						mysqli_query($conn, "SET NAMES 'UTF-8'");
						$sql = 'SELECT * FROM questionset';
						$query = mysqli_query($conn, $sql);

						if (!$query) {
							die ('SQL Error: ' . mysqli_error($conn));
						}while ($row = mysqli_fetch_array($query)){
							echo "
							<tr>
								<td style='text-align: center;'>".$row["id_qs"]."</td>
								<td>".$row["name"]."</td>
								<td>".$row["questions"]."</td>
								<td><form action='editQuiz.php'>
									<input style='display: none; ' name='username' value='".$_GET["username"]."'>
									<input style='display: none; ' name='password' value='".$_GET["password"]."'>
									<button type='submit' class='mui-btn mui-btn--primary mui-btn--raised'>Edit</button>
								</form></td>
							</tr>";
							}echo "
						</tbody
					</table>";
				}elseif ($_GET["showMe"] == "results") {
					echo "Results will be there!";
				}elseif ($_GET["showMe"] == "addQquestion") {
					echo "<h2>Add Question</h2>
					<form action='createQuestion.php'>
						<input name='username' value='".$_GET['username']."' style='display: none;'>
						<input name='password' value='".$_GET['password']."' style='display: none;'>
						<div class='mui-textfield  mui-textfield--float-label'>
					    	<input type='text' name='wording' id='wording' required >
					    	<label style='text-align: left; '>Wording of question <b style='color: red; '>*</b></label>
					  	</div>
					  	<div style='text-align: center;' class='mui-select'>
					    	<label style='text-align: left; '>Correct answer <b style='color: red; '>*</b></label>
		    				<select name='correct' style='text-align: center;' >
		      					<option value='A' style='text-align: center;' >A</option>
		      					<option value='B'>B</option>
		      					<option value='C'>C</option>
		      					<option value='D'>D</option>
		      				</select>
		      			</div>
						<div class='mui-textfield  mui-textfield--float-label'>
					    	<input type='text' name='answerA' id='answerA' required >
					    	<label style='text-align: left; '>Answer A <b style='color: red; '>*</b></label>
					  	</div>
						<div class='mui-textfield  mui-textfield--float-label'>
					    	<input type='text' name='answerB' id='answerB' required >
					    	<label style='text-align: left; '>Answer B <b style='color: red; '>*</b></label>
					  	</div>
						<div class='mui-textfield  mui-textfield--float-label'>
					    	<input type='text' name='answerC' id='answerC' required >
					    	<label style='text-align: left; '>Answer C <b style='color: red; '>*</b></label>
					  	</div>
						<div class='mui-textfield  mui-textfield--float-label'>
					    	<input type='text' name='answerD' id='answerD' required >
					    	<label style='text-align: left; '>Answer D <b style='color: red; '>*</b></label>
					  	</div>
						<button  type='submit' class='mui-btn mui-btn--primary mui-btn--raised'>Insert</button>
					</form>";
				}
			}else{
					header("Location: dashboard.php?username=".$_GET["username"]."&password=".$_GET["password"]."&showMe=questions");
					//die(); //mozna povolit case
				}
			}else{
			echo "<h2>Bad credentials, try it again better!</h2>";
		}
	}
}else{
	echo "<h2>Username and password weren't inserted!</h2>";
}


echo "
		</div>
	</center>";

include '../footer.php';
?>
</body>
</html>
