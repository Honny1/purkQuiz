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
    $__AQ4="";
    $__AQ5="";
    $__AQ6="";
	
	
   
    $resultSql = "SELECT * FROM results WHERE ID='1'";
	$resultQuery = mysqli_query($conn, $resultSql);

	if (!$resultQuery) {die ('SQL Error: ' . mysqli_error($conn));}

	while ($resultRow = mysqli_fetch_array($resultQuery)) {
    	$__AQ1=$resultRow['RAQ1'];
    	$__AQ2=$resultRow['RAQ2'];
    	$__AQ3=$resultRow['RAQ3'];
        $__AQ4=$resultRow['RAQ4'];
        $__AQ5=$resultRow['RAQ5'];
        $__AQ6=$resultRow['RAQ6'];
    }
    
    

    $userResultSql = "SELECT * FROM answers WHERE name='".$name."'";
	$userResultQuery = mysqli_query($conn, $userResultSql);

	if (!$userResultQuery) {die ('SQL Error: ' . mysqli_error($conn));}

	while ($userResultRow = mysqli_fetch_array($userResultQuery)) {
    	$score=calcScore($__AQ1,$userResultRow['AQ1'],$userResultRow['startTime'],$userResultRow['timeAQ1'])+
    		calcScore($__AQ2,$userResultRow['AQ2'],$userResultRow['timeAQ1'],$userResultRow['timeAQ2'])+
    		calcScore($__AQ3,$userResultRow['AQ3'],$userResultRow['timeAQ2'],$userResultRow['timeAQ3'])+
            calcScore($__AQ4,$userResultRow['AQ4'],$userResultRow['timeAQ3'],$userResultRow['timeAQ4'])+
            calcScore($__AQ5,$userResultRow['AQ5'],$userResultRow['timeAQ4'],$userResultRow['timeAQ5'])+
            calcScore($__AQ6,$userResultRow['AQ6'],$userResultRow['timeAQ5'],$userResultRow['timeAQ6']); 
            return $score;	
    }
mysqli_close($conn);

}

?>