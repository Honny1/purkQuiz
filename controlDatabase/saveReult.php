<?php
//save name, score and time to table rank for calulate user global position 
function saveToRank($name,$score){
	include 'dbconnect.php';
	
	$name = mysqli_real_escape_string($conn,$name);
	$score = mysqli_real_escape_string($conn,$score);
	$time= mysqli_real_escape_string($conn,round(microtime(true) * 1000));


$sql = "INSERT INTO rank (user_name,saveTime,score) VALUES ('$name','$time','$score')";

if ($conn->query($sql) === TRUE) {
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
}
?>
