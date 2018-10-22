
	<?php include "../header.php" ?>
	<title>Admin - Quiz</title>
	<meta property="og:title" content="Admin - Quiz" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="https://buchticka.eu/quiz/background.jpg" />
	<meta property="og:description" content="Admin - Quiz about IT" />
  
</head>
<body style="background-color: transparent;">
	<div class="login" >
		<center>
			<div style="background-color: rgba(255, 255, 255, 0.75);" class="mui-panel">
				<form class="mui-form" action="login.php">
					<h2>Admin - Quiz</h2>
					<div class="mui-textfield mui-textfield--float-label">
					    <input style="width: 200px; "  type="text" name="username" id="username" required >
					    <label>username</label>
			  		</div>
			  		<div class="mui-textfield mui-textfield--float-label">
			  			<input style="width: 200px; "  type="password" name="password" id="password" required >
					    <label>Password</label>
			  		</div>
					<button type="submit" class="mui-btn mui-btn--primary mui-btn--raised">Login</button>
				</form>
			</div>
		</center>
	</div>
<?php include '../footer.php';