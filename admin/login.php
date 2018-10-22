<?php
include '../dbconnect.php';
include '../header.php';

echo "
	<title>Login - Admin Quiz</title>
	<meta property='og:title' content='Login - Admin Quiz' />
	<meta property='og:type' content='website' />
	<meta property='og:image' content='https://buchticka.eu/quiz/background.jpg' />
	<meta property='og:description' content='Quiz about IT' />
	<meta http-equiv='refresh' content='5;url=./dashboard.php'>
  
</head>
<body style='background-color: transparent;'>
	<div class='login' >
		<center>
			<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>\n";
if (isset($_GET["username"]) and isset($_GET["password"])) {
	header("Content-Type: text/html;charset=UTF-8");
	mysqli_query($conn, "SET NAMES 'UTF-8'");
	$sql = 'SELECT username, password, nick FROM user';
	$query = mysqli_query($conn, $sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($conn));
	}while ($row = mysqli_fetch_array($query)){
		if ($_GET["username"] == $row["username"] and $_GET["password"] == $row["password"]) {
			echo "<h2>Login successful!</h2>
				  <p>Hi ".$row["nick"]."!</p>
				  <a href='dashboard.php'><button style='font-size: 110%;' class='mui-btn mui-btn--primary mui-btn--raised'>Dashboard</button></a>";
		}else{
			echo "<h2>Bad credentials, try it again better!</h2>";
		}
	}
}else{
	echo "<h2>Username and password weren't inserted!</h2>";
}
echo "		</div>
		</center>
	</div>";
/*S1f0n */
include '../footer.php';
?>