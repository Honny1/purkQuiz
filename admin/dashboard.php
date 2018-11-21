<?php
	include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
	include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/header.php';
	//include 'login.php';

	echo "
		<title>Dashboard - Admin Quiz</title>
		<meta property='og:title' content='Dashboard - Admin Quiz' />
		<meta property='og:type' content='website' />
		<meta property='og:image' content='https://quiz.buchticka.eu/images/backgroundSmaller.jpg' />
		<meta property='og:description' content='Quizs Dashboard' />
	  
	</head>
	<body style='background-color: transparent;'>
		<center>
			<div style='position: absolute; top: 20px; left: 25%; right: 25%; background-color: rgba(255, 255, 255, 0.75); padding: 0px;' class='mui-panel'>
				<h1 style='margin: none; padding-top: 0px; border: none;'>Dashboard</h1>
			</div>
			
			<div style='position: absolute; top: 105px; left: 20%; right: 20%; background-color: transparent; margin-bottom: 200px; '>
				<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
					<form action='dashboard.php' method='POST'>
						<input style='display: none; ' name='username' value='".$_POST["username"]."'>
						<input style='display: none; ' name='password' value='".$_POST["password"]."'>
						<button name='showMe' value='questions' type='submit' style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Questions</button>
						<button name='showMe' value='quenstionssets' type='submit' style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Question Sets</button>
						<button name='showMe' value='results' type='submit' style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Results</button>
						<button name='showMe' value='addQquestion' type='submit' style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Add Question</button>
						<button name='showMe' value='settings' type='submit' style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Settings</button>
					</form>
				</div>
			</div>
				<div style='background-color: rgba(255, 255, 255, 0.75); top: 200px; min-width: 920px; align: center;' class='dashboardContent mui-panel' align='center'>
	";
	if (isset($_POST["username"]) and isset($_POST["password"])) {
		//header("Content-Type: text/html;charset=UTF-8");
		mysqli_query($conn, "SET NAMES 'UTF-8'");
		$sql = 'SELECT username, password, nick FROM user';
		$query = mysqli_query($conn, $sql);

		if (!$query) {
			die ('SQL Error: ' . mysqli_error($conn));
		}while ($row = mysqli_fetch_array($query)){
			if ($_POST["username"] == $row["username"] and $_POST["password"] == $row["password"]){
				if (isset($_POST["showMe"])) {
					if ($_POST["showMe"] == "questions") {
						echo "
						<table class='mui-table mui-table--bordered'>
						<h2>Questions</h2>
							<thead>
								<tr>
									<th style='text-align: center; width: 40px; '>ID</th>
									<th>Wording</th>
									<th style='width: 40px; text-align: center;'>Correct</th>
									<th style='min-width: 150px; '>A</th>
									<th style='min-width: 150px; '>B</th>
									<th style='min-width: 150px; '>C</th>
									<th style='min-width: 150px; '>D</th>
								<!--<th>A - Answer1</th>
									<th>B - Answer2</th>
									<th>C - Answer3</th>
									<th>D - Answer4</th>-->
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
					}elseif ($_POST["showMe"] == "quenstionssets") {
						echo "<h2>Quenstions Sets</h2>

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
									<td><form action='manageQuestionsSets.php' method='POST'>
										<input style='display: none; ' name='username' value='".$_POST["username"]."'>
										<input style='display: none; ' name='password' value='".$_POST["password"]."'>
										<input style='display: none; ' name='oldName' value='".$row["name"]."'>
										<input style='display: none; ' name='oldQuestions' value='".$row["questions"]."'>
										<input style='display: none; ' name='id' value='".$row["id_qs"]."'>
										<button type='submit' class='mui-btn mui-btn--primary mui-btn--raised'>Edit</button>
									</form></td>
								</tr>";
								}echo "
								<tr>
									<form action='manageQuestionsSets.php' method='POST'>
										<td style='text-align: center;'>X</td>
										<td>
											<div class='mui-textfield  mui-textfield--float-label'>
												<input type='text' name='newName' required>
												<label style='text-align: left; '>Set name of new question set <b style='color: red; '>*</b></label>
											</div>
										</td>
										<td>
											<div class='mui-textfield  mui-textfield--float-label'>
												<input type='text' name='newQuestions' required>
												<label style='text-align: left; '>Input list of questions <b style='color: red; '>*</b> Separated by \", \"</label>
											</div>
										</td>
										<td>
											<input style='display: none; ' name='username' value='".$_POST["username"]."'>
											<input style='display: none; ' name='password' value='".$_POST["password"]."'>
											<button type='submit' class='mui-btn mui-btn--primary mui-btn--raised'>Add</button>
										</td>
									</form>
								</tr>";
								echo "
							</tbody
						</table>";
					}elseif ($_POST["showMe"] == "results") {
						echo "
						<h2>Redirecting...</h2>
							<script type='text/javascript'>
								window.setTimeout(function() {
									location.href = \"/results\";
								}, 1000);
							</script>";
					}elseif ($_POST["showMe"] == "settings") {
						echo "<h2>Settings</h2>";
						mysqli_query($conn, "SET NAMES 'UTF-8'");
						$sql = 'SELECT * FROM settings WHERE id = 1';
						$query = mysqli_query($conn, $sql);

						if (!$query) {
							die ('SQL Error: ' . mysqli_error($conn));
						}while ($row = mysqli_fetch_array($query)){
							echo "
							<form action='changeSettings.php' method='POST'>
								<table class='mui-table mui-table--bordered'>
									<thead>
										<tr>
											<th>Name</th>
											<th>Value</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Count of active questions</td>
											<td>".$row["countOfActiveQuestions"]." (automatic updating by PHP code or manualy in DB)</td>
										</tr>
										<tr>
											<td>ID of active question set</td>
											<!--<td>".$row["idOfActiveQuestionSet"]."</td>-->
											<td>
												<div class='mui-textfield  mui-textfield--float-label'>
											    	<input type='text' name='idOfActiveQuestionSet' required value='".$row["idOfActiveQuestionSet"]."'>
											    	<label style='text-align: left; '>Set new value <b style='color: red; '>*</b></label>
											  	</div>
										  	</td>
										</tr>
									</tbody>
								</table>
								<input style='display: none; ' name='username' value='".$_POST["username"]."'>
								<input style='display: none; ' name='password' value='".$_POST["password"]."'>
								<button type='submit' class='mui-btn mui-btn--primary mui-btn--raised'>Update</button>
							</form>";
							}
					}elseif ($_POST["showMe"] == "addQquestion") {
						echo "<h2>Add Question</h2>
						<form action='createQuestion.php' method='POST'>
							<input name='username' value='".$_POST['username']."' style='display: none;'>
							<input name='password' value='".$_POST['password']."' style='display: none;'>
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
					echo "
						<h2>Redirecting...</h2>
						<form action='dashboard.php' method='POST'>
					  		<input style='display: none;' type='text' name='showMe' value='questions'>
					  		<input style='display: none;' type='text' name='username' value='".$_POST["username"]."'>
					  		<input style='display: none;' type='password' name='password' value='".$_POST["password"]."'>
					  		<input style='display: none;' type='submit' id='submitForm'>
				  		</form>
						<script type='text/javascript'>
							window.setTimeout(function() {
								//location.href = \"dashboard.php\";
								document.getElementById('submitForm').click();
							}, 2000);
						</script>";
					//header("Location: dashboard.php?showMe=questions");
					//die(); //mozna povolit casem
					}
				}else{
				echo "<h2>Bad credentials, try it again better!</h2>";
			}
		}
	}else{
		echo "<h2>Username and password weren't inserted!</h2>";
	}


	echo "		</div>
			</div>
		</center>";

	include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/footer.php';
?>
</body>
</html>
