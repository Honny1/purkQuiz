<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table>
  <tr>
    <th>ID</th>
    <th>NAME</th> 
    <th>AQ1</th>
    <th>AQ2</th>
    <th>AQ3</th>
  </tr>
<?php 
include 'dbconnect.php';
$answersSql = "SELECT * FROM answers";
$answersQuery = mysqli_query($conn, $answersSql);

if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

while ($answerRow = mysqli_fetch_array($answersQuery)) {
	echo "<tr>
    		<td>".$answerRow['ID']."</td>
    		<td>".$answerRow['name']."</td>
    		<td>".$answerRow['AQ1']."</td>
    		<td>".$answerRow['AQ2']."</td>
    		<td>".$answerRow['AQ3']."</td>
		 </tr>";
    }
mysqli_close($conn);

?>
</table>
</body>
</html>