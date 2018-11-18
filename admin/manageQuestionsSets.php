<?php
	include $_SERVER['DOCUMENT_ROOT'].'controlDatabase/dbconnect.php';
	include $_SERVER['DOCUMENT_ROOT'].'htmlParts/header.php';
?>

	<title>Editing quiz - Admin Quiz</title>
	<meta property='og:title' content='Editing quiz - Admin Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://quiz.buchticka.eu/images/background.jpg' />
	<meta property='og:description' content='You can edit quiz here!' />
  
</head>
<body style='background-color: transparent;'>
	<div class='dashboardContent' >
		<center>
			<div style='background-color: rgba(255, 255, 255, 0.75); min-width:400px;' class='mui-panel'>
				<?php
if (isset($_POST["username"]) and isset($_POST["password"])) {
	if (isset($_POST["newName"]) and isset($_POST["newQuestions"])) {
		$qsQuery = mysqli_query($conn, "INSERT INTO questionset(name, questions, admins) VALUES ('".$_POST["newName"]."', '".$_POST["newQuestions"]."', '1');");
		if (!$qsQuery) {
			die ("\n<br><b>SQL Error: </b>" . mysqli_error($conn));
		}else{
			echo " 	<h3>Successfully inserted!<h3>
					<p>Redirecting ...</p>
					<form action='dashboard.php' method='POST'>
						<input style='display: none; ' name='username' value='".$_POST["username"]."'>
						<input style='display: none; ' name='password' value='".$_POST["password"]."'>
						<input style='display: none; ' name='showMe' value='quenstionssets'>
						<input type='submit' value='OK' id='goToDashboard' class='mui-btn'>
					</form>
					<script type='text/javascript'>
						window.setTimeout(function() {
							document.getElementById('goToDashboard').click();
						}, 2000);
					</script>";
		}
	}elseif (!isset($_POST["name"]) and !isset($_POST["questions"])) {
		mysqli_query($conn, "SET NAMES 'UTF-8'");
		$sql = 'SELECT username, password, nick FROM user';
		$query = mysqli_query($conn, $sql);

		if (!$query) {
			die ('SQL Error: ' . mysqli_error($conn));
		}while ($row = mysqli_fetch_array($query)){
			if ($_POST["username"] == $row["username"] and $_POST["password"] == $row["password"]){
				if (isset($_POST["id"])) {
					$qsQuery = mysqli_query($conn, "SELECT * FROM questionset WHERE id_qs = '".$_POST["id"]."'");
					if (!$qsQuery) {die ("\n<br><b>SQL Error: </b>" . mysqli_error($conn));}
					$qsRow = mysqli_fetch_array($qsQuery);
					echo "<h1>Editing qeuestion set ".$qsRow["id_qs"]."</h1>
						<form action='manageQuestionsSets.php' method='POST'>
							<input name='username' value='".$_POST['username']."' style='display: none;'>
							<input name='password' value='".$_POST['password']."' style='display: none;'>
							<input name='id_qs' value='".$_POST['id']."' style='display: none;'>
							<div class='mui-textfield  mui-textfield--float-label'>
						    	<input type='text' name='name' id='name' required value='".$_POST["oldName"]."'>
						    	<label style='text-align: left; '>Name of question set <b style='color: red; '>*</b></label>
						  	</div>
						  	<div class='mui-textfield  mui-textfield--float-label'>
						    	<input type='text' name='questions' id='questions' required value='".$_POST["oldQuestions"]."'>
						    	<label style='text-align: left; '>Questions <b style='color: red; '>*</b></label>
						  	</div>
							<button  type='submit' class='mui-btn mui-btn--primary mui-btn--raised'>Update</button>
						</form>";
				}
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
	}elseif (isset($_POST["name"]) and isset($_POST["questions"]) and isset($_POST["id_qs"])) {
		$qsQuery = mysqli_query($conn, "UPDATE questionset SET `name` = '".$_POST["name"]."', `questions` = '".$_POST["questions"]."' WHERE id_qs = '".$_POST["id_qs"]."'");
		if (!$qsQuery) {
			die ("\n<br><b>SQL Error: </b>" . mysqli_error($conn));
		}else{
			echo " 	<h3>Successfully updated!<h3>
					<p>Redirecting ...</p>
					<form action='dashboard.php' method='POST'>
						<input style='display: none; ' name='username' value='".$_POST["username"]."'>
						<input style='display: none; ' name='password' value='".$_POST["password"]."'>
						<input style='display: none; ' name='showMe' value='quenstionssets'>
						<input type='submit' value='OK' id='goToDashboard' class='mui-btn'>
					</form>
					<script type='text/javascript'>
						window.setTimeout(function() {
							document.getElementById('goToDashboard').click();
						}, 2000);
					</script>";
		}
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
	include $_SERVER['DOCUMENT_ROOT'].'htmlParts/footer.php';
?>