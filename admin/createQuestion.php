<?php
	include '../dbconnect.php';
	include '../header.php';

	echo "
	<title>Login - Admin Quiz</title>
	<meta property='og:title' content='Login - Admin Quiz' />
 	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://buchticka.eu/quiz/background.jpg' />
	<meta property='og:description' content='Quiz about IT' />
  
</head>
<body style='background-color: transparent;'>
	<div class='login' >
		<center>
			<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>\n";
if (isset($_GET["username"]) and isset($_GET["password"])) {
	mysqli_query($conn, "SET NAMES 'UTF-8'");
	$sql = "SELECT username, password, nick FROM user";
	$query = mysqli_query($conn, $sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($conn));
	}while ($row = mysqli_fetch_array($query)){
		if ($_GET["username"] == $row["username"] and $_GET["password"] == $row["password"]){
			try{
				$questionSql = "INSERT INTO question(wording, correct, answer1, answer2, answer3, answer4) VALUES (".$_GET["wording"]."', '".$_GET["correct"]."', '".$_GET["answerA"]."',  '".$_GET["answerB"]."', '".$_GET["answerC"]."', '".$_GET["answerD"]."');";
				$questionQuery = mysqli_query($conn, $questionSql);
				echo "<h2>Question inserted</h2>";
			}catch (Exception $e) {
				echo $e;
			}
		}else{
		echo "<h2>Bad credentials, try it again better!</h2>
				<a style='display: none;' href='./?username=".$_GET["username"]."'></a>
				<script type='text/javascript'>
					window.setTimeout(function() {
						location.href = \"/admin/?username=".$_GET["username"]."\";
					}, 2000);
				</script>
				";
		}
	}
}else{
	echo "<h2>Username and password weren't inserted!</h2>
			<script type='text/javascript'>
				window.setTimeout(function() {
					location.href = \"/admin/\";
				}, 2000);
			</script>";
}
echo "		</div>
		</center>
	</div>";
/*S1f0n */
include '../footer.php';
?>