<?php
include '../dbconnect.php';
include '../header.php';

echo "
	<title>Dashboard - Admin Quiz</title>
	<meta property='og:title' content='Dashboard - Admin Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://buchticka.eu/quiz/background.jpg' />
	<meta property='og:description' content='Quizs Dashboard' />
  
</head>
<body style='background-color: transparent;'>
	<div class='dashboard' >
		<center>
			<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
				<h1>Dashboard</h1>
				<hr style='width: 200px;'>
				<h2>Quizs</h2>

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
				</table>

				
				<table class='mui-table mui-table--bordered'>
				<h2>Questions</h2>
					<thead>
						<tr>
							<th style='text-align: center; width: 40px; '>ID</th>
							<th>Wording</th>
							<th style='width: 40px; text-align: center;'>Correct</th>
							<th>Answer1</th>
							<th>Answer2</th>
							<th>Answer3</th>
							<th>Answer4</th>
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
				</table>
				";echo "
			</div>
		</center>
	</div>";

include '../footer.php';
?>