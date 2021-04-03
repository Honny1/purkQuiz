<?php
//return your solution time
function getSolutionTime($name){
	include '../controlDatabase/dbConnect.php';

 	$sql = "SELECT * FROM answers WHERE name = '$name'";
	$result = mysqli_query($conn,$sql);
	if (!$result) {die ('SQL Error: ' . mysqli_error($conn));}
	while ($row = mysqli_fetch_array($result)) {
    	if ($name == $row['name']) {
            foreach ($row as $value) {
                if(is_numeric($value)){
                    $time=$value-$row['startTime'];
                }
            }
    		
    	}
    }
    mysqli_close($conn);
    
    return $time;
}
?>
