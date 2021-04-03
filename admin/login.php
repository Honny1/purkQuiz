<?php
	include '../controlDatabase/dbConnect.php';
	include '../htmlParts/header.php';

	echo "
	<title>Login - Admin Quiz</title>
	<meta property='og:title' content='Login - Admin Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://buchticka.eu/quiz/background.jpg' />
	<meta property='og:description' content='Quiz about IT' />
  
</head>
<body style='background-color: transparent;'>
	<div style='max-width: 260px; ' class='login' >
		<center>
			<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>\n";
if (isset($_POST["username"]) and isset($_POST["password"])) {
	header("Content-Type: text/html;charset=UTF-8");
	mysqli_query($conn, "SET NAMES 'UTF-8'");
	$sql = 'SELECT * FROM user';
	$query = mysqli_query($conn, $sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($conn));
	}while ($row = mysqli_fetch_array($query)){
		if ($_POST["username"] == $row["username"] and $_POST["password"] == $row["password"]) {
			echo "	<h2>Login successful!</h2>
				  	<h3>Hi ".$row["nick"]."!</h3>
				  	<p>Redirecting to Dashboard!</p>
				  	<form action='".$row["afterLogonGoTo"]."' method='POST'>
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
		}else{
			echo "<h2>Bad credentials, try it again better!</h2>
					<a style='display: none;' href='./?username=".$_POST["username"]."'></a>
					<script type='text/javascript'>
						window.setTimeout(function() {
							location.href = \"./?username=".$_POST["username"]."\";
						}, 2000);
					</script>
					";
		}
	}
}else{
	echo "<h2>Username and password weren't inserted!</h2>
			<script type='text/javascript'>
				window.setTimeout(function() {
					location.href = \"./\";
				}, 2000);
			</script>";
}
echo "		</div>
		</center>
	</div>";
/*S1f0n */
include '../htmlParts/footer.php';
?>