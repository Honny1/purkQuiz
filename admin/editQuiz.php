<?php
	include '../dbconnect.php';
	include '../header.php';

	echo "
	<title>Editing quiz - Admin Quiz</title>
	<meta property='og:title' content='Editing quiz - Admin Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://quiz.buchticka.eu/images/background.jpg' />
	<meta property='og:description' content='You can edit quiz here!' />
  
</head>
<body style='background-color: transparent;'>
	<div class='login' >
		<center>
			<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>\n";
if (isset($_GET["username"]) and isset($_GET["password"])) {
	mysqli_query($conn, "SET NAMES 'UTF-8'");
	$sql = 'SELECT username, password, nick FROM user';
	$query = mysqli_query($conn, $sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($conn));
	}while ($row = mysqli_fetch_array($query)){
		if ($_GET["username"] == $row["username"] and $_GET["password"] == $row["password"]){
			echo "sem vlož obsah";
			if (isset($_GET["id"])) {
				$qsQuery = mysqli_query($conn, "SELECT * FROM quiz WHERE ID = '".$_GET["id"]."'");
				$qsRow = mysqli_fetch_array($qsQuery);

				echo "<h1>Editing qeuestion set ".$qsRow["id_qs"]."</h1>
				<form action='createQuestion.php'>
						<input name='username' value='".$_GET['username']."' style='display: none;'>
						<input name='password' value='".$_GET['password']."' style='display: none;'>
						<div class='mui-textfield  mui-textfield--float-label'>
					    	<input type='text' name='name' id='name' required >
					    	<label style='text-align: left; '>Name of question set<b style='color: red; '>*</b></label>
					  	</div>
					  	<div class='mui-textfield  mui-textfield--float-label'>
					    	<input type='text' name='questions' id='questions' required >
					    	<label style='text-align: left; '>Questions <b style='color: red; '>*</b></label>
					  	</div>
						<button  type='submit' class='mui-btn mui-btn--primary mui-btn--raised'>Insert</button>
					</form>";

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