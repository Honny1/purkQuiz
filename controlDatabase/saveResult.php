<?php
	//save name, score and time to table rank for calulate user global position 
	function saveToRank($name,$score){
		include 'dbConnect.php';
		include realpath($_SERVER['DOCUMENT_ROOT']).'/calcResults/getTime.php';

		$name = mysqli_real_escape_string($conn,$name);
		$score = mysqli_real_escape_string($conn,$score);
		$time = mysqli_real_escape_string($conn,round(microtime(true) * 1000));
		$solutionTime = mysqli_real_escape_string($conn,getSolutionTime($name));

		$sql = "INSERT INTO rank (user_name,saveTime,score,solutionTime) VALUES ('$name','$time','$score','$solutionTime')";

		if ($conn->query($sql) === TRUE) {
		
		} else {
	    	echo "Error: " . $sql . "<br>" . $conn->error;
		}
		mysqli_close($conn);
	}
?>
