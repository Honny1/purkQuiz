<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
include 'dbconnect.php';

$userAnswers=$_GET["userAnswers"];
echo $userAnswers;
$userAnswersSplit = explode(",", $userAnswers);
$name = mysqli_real_escape_string($conn, $userAnswersSplit[0]);
$AQ1 = mysqli_real_escape_string($conn, $userAnswersSplit[1]);
$AQ2 = mysqli_real_escape_string($conn, $userAnswersSplit[2]);
$AQ3 = mysqli_real_escape_string($conn, $userAnswersSplit[3]);

$sql = "INSERT INTO answers (name,AQ1,AQ2,AQ3) VALUES ('$name', '$AQ1', '$AQ2', '$AQ3')";

if ($conn->query($sql) === TRUE) {
    echo "Page saved!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
?>
</body>
</html>