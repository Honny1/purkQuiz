<?php
	include realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php';
	include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/header.php';

	echo "
	<title>Change Settings - Admin Quiz</title>
	<meta property='og:title' content='Change settings - Admin Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://quiz.buchticka.eu/images/background.jpg' />
	<meta property='og:description' content='You can change main settings here!' />
  
</head>
<body style='background-color: transparent;'>
	<div class='dashboardContent' >
		<center>
			<div style='background-color: rgba(255, 255, 255, 0.75); min-width:400px;' class='mui-panel'>\n";
if (isset($_POST["username"]) and isset($_POST["password"])) {
	if (!isset($_POST["idOfActiveQuestionSet"])) {
		mysqli_query($conn, "SET NAMES 'UTF-8'");
		$sql = 'SELECT username, password, nick FROM user';
		$query = mysqli_query($conn, $sql);

		if (!$query) {
			die ('SQL Error: ' . mysqli_error($conn));
		}while ($row = mysqli_fetch_array($query)){
			if ($_POST["username"] == $row["username"] and $_POST["password"] == $row["password"]){
				echo "<h2>Redirecting...</h2>";
			}else{
				echo "<h2>Bad credentials, try it again better!</h2>
					<form action='dashboard.php' method='POST'>
						<input style='display: none; ' name='username' value='".$_POST["username"]."'>
						<input style='display: none; ' name='password' value='".$_POST["password"]."'>
						<input type='submit' value='OK' id='goToDashboard' class='mui-btn'>
					</form>
					<script type='text/javascript'>
						window.setTimeout(function() {
							document.getElementById('goToDashboard').click();
						}, 2000);
					</script>";
			}
		}
	}elseif (isset($_POST["idOfActiveQuestionSet"])) {
		$qsQuery = mysqli_query($conn, "UPDATE settings SET `idOfActiveQuestionSet` = '".$_POST["idOfActiveQuestionSet"]."' WHERE id = 1;");
		if (!$qsQuery) {
			die ("\n<br><b>SQL Error: </b>" . mysqli_error($conn));
		}
		try{
			// Get active question set
			$settingsQuery = mysqli_query($conn, "SELECT * FROM settings WHERE `id` = 1; ");
			if (!$settingsQuery) {die ('SQL Error: ' . mysqli_error($conn));}
			$settingsRow = mysqli_fetch_array($settingsQuery);

			$questionSetQuery = mysqli_query($conn, "SELECT * FROM questionset WHERE `id_qs` = ".$settingsRow["idOfActiveQuestionSet"]."; ");
			if (!$questionSetQuery) {die ('SQL Error: ' . mysqli_error($conn));}
			$questionSetRow = mysqli_fetch_array($questionSetQuery);
			$questionsArray = explode(", ", implode((array)$questionSetRow["questions"]));
			print_r($questionsArray);
			
		}catch (Exception $e){
			die("Problem: ".$e);
		}
		$qsSettingsQuery = mysqli_query($conn, "UPDATE settings SET `countOfActiveQuestions` = '".count($questionsArray)."' WHERE id = '1'");
		if (!$qsSettingsQuery) {
			die ("\n<br><b>SQL Error: </b>" . mysqli_error($conn));
		}
		echo " <h3>Successfully updated!<h3>
				<p>Redirecting ...</p>
				<form action='dashboard.php' method='POST'>
					<input style='display: none; ' name='username' value='".$_POST["username"]."'>
					<input style='display: none; ' name='password' value='".$_POST["password"]."'>
					<input style='display: none; ' name='showMe' value='settings'>
					<input type='submit' value='OK' id='goToDashboard' class='mui-btn'>
				</form>
				<script type='text/javascript'>
					window.setTimeout(function() {
						document.getElementById('goToDashboard').click();
					}, 2000);
				</script>";
		
	}	
}else{
	echo "<h2>Username and password weren't inserted!</h2>
				<form action='dashboard.php' method='POST'>
					<input style='display: none; ' name='username' value='".$_POST["username"]."'>
					<input style='display: none; ' name='password' value='".$_POST["password"]."'>
					<input type='submit' value='OK' id='goToDashboard' class='mui-btn'>
				</form>
				<script type='text/javascript'>
					window.setTimeout(function() {
						document.getElementById('goToDashboard').click();
					}, 2000);
				</script>";
}
echo "			
			</div>
		</center>
	</div>";
/*S1f0n */
	include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/footer.php';
?>