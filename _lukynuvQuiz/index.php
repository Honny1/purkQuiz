
	<?php include "header.php" ?>
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
				<form class="mui-form" action="quizSelect.php">
					<h2>Quiz</h2>
					<div class="mui-textfield mui-textfield--float-label">
					    <input style="width: 200px; "  type="number" name="quizPin" id="quizPin" required >
					    <label >Game PIN</label>
			  		</div>
			  		<div class="mui-textfield mui-textfield--float-label">
					    <input style="width: 200px; "  type="text" name="nickname" id="nickname" required >
					    <label >Nick</label>
			  		</div>
					<button type="submit" class="mui-btn mui-btn--primary mui-btn--raised">Play</button>
				</form>
			</div>
		</center>
	</div>
<?php include 'footer.php';