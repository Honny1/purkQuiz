<?php
//return your global position 
function getRank($name){
	include '../controlDatabase/dbConnect.php';
	
	$count=0;
 	$rankSql = "SELECT * FROM rank ORDER BY score DESC";
	$rankQuery = mysqli_query($conn, $rankSql);

	if (!$rankQuery) {die ('SQL Error: ' . mysqli_error($conn));}

	while ($rankRow = mysqli_fetch_array($rankQuery)) {
    	$count++;
    	if ($name == $rankRow['user_name']) {
    		$rank=$count;
    	}
    }
    echo "<h2>Rank</h2><h1>".$rank." z ".$count."</h1>";
mysqli_close($conn);
}
?>
