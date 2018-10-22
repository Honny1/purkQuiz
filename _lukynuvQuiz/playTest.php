<?php
include 'header.php';
include 'dbconnect.php';
?>
	<title>Playing Quiz</title>
	<meta property='og:title' content='Playing - Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://buchticka.eu/quiz/background.jpg' />
	<meta property='og:description' content='Playing quiz about IT' />
</head>
<body style="background-color: transparent;">
	<script type="text/javascript">

	</script>
	<?php
	if (isset($_GET["idQuestion"])) {
		$questionSql = "SELECT * FROM question WHERE id_question='".$_GET["idQuestion"]."'";
	}else{
		$questionSql = "SELECT * FROM question";
	}
	
	$questionQuery = mysqli_query($conn, $questionSql);

	if (!$questionQuery) {
		die ('SQL Error: ' . mysqli_error($conn));}
	while ($questionRow = mysqli_fetch_array($questionQuery)) {
		echo "
	<div class='questionInGame'>
		<br><br><br><br>
		<h1 style='text-align: center; font-size: 600%; '>".$questionRow['wording']."</h1>
	</div>
	<div><br><br>
		<h2 style='text-align: center; font-size: 400%; '>Zbývá:</h2>
	</div>
	<div class='gameButtons' align='center'>
		<table style='width: 80%; '>
			<tr style='min-width: 50%; min-height: 200px; width: 50%; height: 200px; max-width: 50%; '>
				<td><button style='min-width: 300px; min-height: 150px; width: 100%; height: 100%; font-size: 200%; max-width: 600px; text-align: justify-all;' class='mui-btn mui-btn--primary mui-btn--raised'>".$questionRow['answer1']."</button></td>
				<td><button style='min-width: 300px; min-height: 150px; width: 100%; height: 100%; font-size: 200%; background-color: red; color: white; max-width: 600px;' class='mui-btn mui-btn--primary mui-btn--raised'>".$questionRow['answer2']."</button></td>
			</tr>
			<tr style='min-width: 50%; min-height: 200px; width: 50%; height: 200px; max-width: 50%; '>
				<td><button style='min-width: 300px; min-height: 150px; width: 600px; height: 100%; font-size: 200%; background-color: yellow; color: black; max-width: 600px;' class='mui-btn mui-btn--primary mui-btn--raised'>".$questionRow['answer3']."</button></td>
				<td><button style='min-width: 300px; min-height: 150px; width: 600px; height: 100%; font-size: 200%; background-color: black; max-width: 600px;' class='mui-btn mui-btn--primary mui-btn--raised'>". $questionRow['answer4']."</button></td>
			</tr>
		</table>";}?><!--
		<button class="mui-btn mui-btn--primary mui-btn--raised"><?php echo $questionRow["answer1"]; ?></button>
		<button align="right" style="background-color: red; width: 800px; height: 200px;" class="mui-btn mui-btn--primary mui-btn--raised"><?php echo $questionRow["answer2"]; ?></button>
		<button align="left"  style="background-color: yellow;  width: 800px; height: 200px;" class="mui-btn mui-btn--primary mui-btn--raised"><?php echo $questionRow["answer3"]; ?></button>
		<button align="right" style="background-color: black;  width: 800px; height: 200px;" class="mui-btn mui-btn--primary mui-btn--raised"><?php echo $questionRow["answer4"]; ?></button>-->
		<br><br><br><br>
	</div>
</body>
<?php
include 'footer.php';
?>