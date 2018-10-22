<?php
include '../dbconnect.php';
include '../header.php';

echo "
	<title>Dashboard - Admin Quiz</title>
	<meta property='og:title' content='Dashboard - Admin Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://quiz.buchticka.eu/images/backgroundSmaller.jpg' />
	<meta property='og:description' content='Quizs Dashboard' />
  
</head>
<body style='background-color: transparent;'>
	<center>
		<div style='position: absolute; top: 20px; left: 30%; right: 30%; background-color: rgba(255, 255, 255, 0.75); padding: 0px;' class='mui-panel'>
			<h1 style='margin: none; padding-top: 0px; border: none;'>Dashboard</h1>
		</div>
		<div style='position: absolute; top: 105px; left: 30%; right: 30%; background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
			<a href='dashboard.php?showMe=questions'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Questions</button></a>
			<a href='dashboard.php?showMe=quizs'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Quizs</button></a>
			<a href='dashboard.php?showMe=results'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Results</button></a>
			<a href='dashboard.php?showMe=addQquestion'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Add Question</button></a>
		</div>
		<div style='background-color: rgba(255, 255, 255, 0.75);' class='dashboardContent mui-panel' >
";
			if (isset($_GET["showMe"])) {
				if ($_GET["showMe"] == "questions") {
					echo "
					<table class='mui-table mui-table--bordered'>
					<h2>Questions</h2>
						<thead>
							<tr>
								<th style='text-align: center; width: 40px; '>ID</th>
								<th>Wording</th>
								<th style='width: 40px; text-align: center;'>Correct</th>
								<th>A - Answer1</th>
								<th>B - Answer2</th>
								<th>C - Answer3</th>
								<th>D - Answer4</th>
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
				}elseif ($_GET["showMe"] == "quizs") {
					echo "<h2>Quizs</h2>

					<table class='mui-table mui-table--bordered'>
						<thead>
							<tr>
								<th style='width: 40px; text-align: center;'>ID</th>
								<th>Name</th>
								<th>Questions</th>
							</tr>
						</thead>
						<tbody>";
						mysqli_query($conn, "SET NAMES 'UTF-8'");
						$sql = 'SELECT * FROM quiz';
						$query = mysqli_query($conn, $sql);

						if (!$query) {
							die ('SQL Error: ' . mysqli_error($conn));
						}while ($row = mysqli_fetch_array($query)){
							echo "
							<tr>
								<td style='text-align: center;'>".$row["id_quiz"]."</td>
								<td>".$row["name"]."</td>
								<td>".$row["questions"]."</td>
							</tr>";
							}echo "
						</tbody
					</table>";
				}elseif ($_GET["showMe"] == "results") {
					echo "Results will be there!";
				}elseif ($_GET["showMe"] == "addQquestion") {
					echo "Add Question will be there!";
				}
			}else{
					header("Location: dashboard.php?showMe=questions");
					//die(); //mozna povolit case
				}echo "
		</div>
	</center>";

include '../footer.php';
?>
</body>
</html>
