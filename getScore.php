<?php 
function calcScore($__AQ,$AQ,$startTime,$endTime){
        if($__AQ==$AQ){
            global $score,$scoreQ;
            $score=1000+(($startTime-$endTime)/100);
            if ($score<50) {
                return 50;
            }
            return $score;
        }
    }
function getScore($name){
	include 'dbconnect.php';
	$__AQ1="";
	$__AQ2="";
	$__AQ3="";
	
	
   
    $resultSql = "SELECT * FROM results WHERE ID='1'";
	$resultQuery = mysqli_query($conn, $resultSql);

	if (!$resultQuery) {die ('SQL Error: ' . mysqli_error($conn));}

	while ($resultRow = mysqli_fetch_array($resultQuery)) {
    	$__AQ1=$resultRow['RAQ1'];
    	$__AQ2=$resultRow['RAQ2'];
    	$__AQ3=$resultRow['RAQ3'];
    }
    
    

    $userResultSql = "SELECT * FROM answers WHERE name='".$name."'";
	$userResultQuery = mysqli_query($conn, $userResultSql);

	if (!$userResultQuery) {die ('SQL Error: ' . mysqli_error($conn));}

	while ($userResultRow = mysqli_fetch_array($userResultQuery)) {
    	$score=calcScore($__AQ1,$userResultRow['AQ1'],$userResultRow['startTime'],$userResultRow['timeAQ1'])+
    		calcScore($__AQ2,$userResultRow['AQ2'],$userResultRow['timeAQ1'],$userResultRow['timeAQ2'])+
    		calcScore($__AQ1,$userResultRow['AQ3'],$userResultRow['timeAQ2'],$userResultRow['timeAQ3']); 
            return $score;	
    }
mysqli_close($conn);

}

?>