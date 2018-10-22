<?php 
	include "header.php";
	include 'dbconnect.php';?>
	<title>Quiz</title>
	<meta property="og:title" content="Quiz" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="https://buchticka.eu/quiz/background.jpg" />
	<meta property="og:description" content="Quiz about IT" />
  
</head>
<body style="background-color: transparent;">
	<div class="gamePin" >
		<center>
			<div style="background-color: rgba(255, 255, 255, 0.75);" class="mui-panel">
				<h1>Vítej!</h1>
				<?php
				if (isset($_GET["quizPin"])) {
					$quizSql = mysqli_real_escape_string($conn, "SELECT * FROM quiz WHERE id_quiz=".$_GET["quizPin"]);
					//mysqli_real_escape_string($conn, $quizSql);
					$quizQuery = mysqli_query($conn, $quizSql);
					if (!$quizQuery) {
						die ('SQL Error: ' . mysqli_error($conn));}
					while ($quizRow = mysqli_fetch_array($quizQuery)) {
						echo "<h2>Quiz:</h2> <h3>". $quizRow["name"] . "</h3>";
						//echo "<h2>Otázky:</h2><h3>".$quizRow["questions"]."</h3>";
						$questionsStr = $quizRow["questions"];
					}
					$questions = explode(",", $questionsStr);
					//print_r($questions);
				}else{
					header("Location: index.php");
				}
				if (isset($_GET["nickname"])) {
					echo "<h2>Přezdívka:</h2> <h3>".$_GET["nickname"]."</h3>";
				}else{
					header("Location: index.php");
				}
				echo "<h3>Čekám na spuštění správcem!</h3>";
				?>
			</div>
		</center>
	</div>
<?php include 'footer.php'; ?>