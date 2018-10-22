<?php
include "header.php";
include 'dbconnect.php';
?>
	<title>Playing Quiz</title>
	<meta property='og:title' content='Playing - Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://buchticka.eu/quiz/background.jpg' />
	<meta property='og:description' content='Playing quiz about IT' />
</head>
<body>
	<div class="gamePin" >
		<center>
			<div style="background-color: rgba(255, 255, 255, 0.75);" class="mui-panel">
				<?php if (isset($_GET["idQuestion"]) and isset($_GET["answer"])) {
					//echo "<h1>".$_GET["idQuestion"]."</h1>";
					$questionSql = "SELECT * FROM question WHERE id_question='".$_GET["idQuestion"]."'";
					$questionQuery = mysqli_query($conn, $questionSql);

					if (!$questionQuery) {
						die ('SQL Error: ' . mysqli_error($conn));}
					while ($questionRow = mysqli_fetch_array($questionQuery)) {
						if ($questionRow["correct"] == $_GET["answer"]){
							echo "<h1>Výborně!</h1><h2>Zvolil jsi správnou odpověď. :)</h3>";
						}else{
							echo "<h1>Zvolil jsi špatnou odpověď. :(</h1><h2>Správná odpověď:</h2><h3>".$questionRow[("answer".$questionRow["correct"])]."</h3>";
						}}}?>
					<form action='play.php'>
						<input style='display: none; ' name='idQuestion' value="<?php echo ($_GET["idQuestion"]+1);?>">
						<button class='mui-btn mui-btn--primary mui-btn--raised' type='submit'>Next</button>
					</form>
			</div>
		</center>
	</div>
<?php
include 'footer.php';
?>