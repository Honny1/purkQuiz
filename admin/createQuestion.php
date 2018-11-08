<?php
	include $_SERVER['DOCUMENT_ROOT'].'controlDatabase/dbconnect.php';
	include $_SERVER['DOCUMENT_ROOT'].'htmlParts/header.php';
	
	echo "
	<title>Create Question - Admin Quiz</title>
	<meta property='og:title' content='Create Question - Admin Quiz' />
 	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://buchticka.eu/quiz/background.jpg' />
	<meta property='og:description' content='Quiz about IT' />
  
</head>
<body style='background-color: transparent;'>
	<div class='login' >
		<center>
			<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>\n";
if (isset($_POST["username"]) and isset($_POST["password"])) {
	mysqli_query($conn, "SET NAMES 'UTF-8'");
	$sql = "SELECT * FROM user";
	$query = mysqli_query($conn, $sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($conn));
	}while ($row = mysqli_fetch_array($query)){
		if ($_POST["username"] == $row["username"] and $_POST["password"] == $row["password"]){
			try{
				$questionSql = "INSERT INTO question(`wording`, `correct`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES ('".$_POST["wording"]."', '".$_POST["correct"]."', '".$_POST["answerA"]."',  '".$_POST["answerB"]."', '".$_POST["answerC"]."', '".$_POST["answerD"]."');";
				$questionQuery = mysqli_query($conn, $questionSql);
				if (!$questionQuery) {echo "Something went wrong";}
				echo "<h2>Question inserted</h2>
					  <form action='dashboard.php' method='POST'>";
			}catch (Exception $e) {
				echo $e;
			}
		}else{
		echo "<h2>Bad credentials, try it again better!</h2>
			 <form action='/admin' method='POST'>
				";
		}
	}
}else{
	echo "<h2>Username and password weren't inserted!</h2>
		 <form action='/admin' method='POST'>";
}
	echo "		<form action='dashboard.php' method='POST'>
					<input style='display: none; ' name='username' value='".$_POST["username"]."'>
					<input style='display: none; ' name='password' value='".$_POST["password"]."'>
					<input type='submit' value='OK' id='goToDashboard' class='mui-btn'>
				</form>
				<script type='text/javascript'>
					window.setTimeout(function() {
						document.getElementById('goToDashboard').click();
					}, 2000);
				</script>
			</div>
		</center>
	</div>";

/*S1f0n */
include $_SERVER['DOCUMENT_ROOT'].'controlDatabase/dbconnect.php';
include $_SERVER['DOCUMENT_ROOT'].'htmlParts/footer.php';
?>