<?php 
//save user ansvers to db and evaluate and return score and rank on web
  include 'dbconnect.php';
  include $_SERVER['DOCUMENT_ROOT'].'calcResults/getScore.php';
  include 'saveReult.php';
  include $_SERVER['DOCUMENT_ROOT'].'calcResults/getRank.php';

  $userAnswers = $_GET["userAnswers"];

  $userAnswersSplit = explode(",", $userAnswers);
  $name = mysqli_real_escape_string($conn, $userAnswersSplit[0]);
  //$name .="%"; right(name,4)
  $sql1 = "SELECT id FROM answers WHERE name LIKE '$name%'";
  $result1 = mysqli_query($conn,$sql1);
  $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
      
  $count = mysqli_num_rows($result1);
      
  // If result matched $name, table row count must be bigger then 0 
    
  if($count > 0) {
    $name.=$count;
  }
  $name = mysqli_real_escape_string($conn, $name);

  $sql = "INSERT INTO answers ( name, startTime";

  for ($i=1; $i <(sizeof($userAnswersSplit)/2)-1 ; $i++) { 
    $sql .= ", AQ".$i.", timeAQ".$i;
  }
  $sql .= ") VALUES ('$name'";
  for ($i=1; $i <sizeof($userAnswersSplit)-1 ; $i++){
    $nasrat=mysqli_real_escape_string($conn, $userAnswersSplit[$i]);
    $sql .= ",";
    $sql .= "'$nasrat'";
    
  }
  $sql .= ")";

  if ($conn->query($sql) === TRUE) {
	 $score2 =getScore($name);
	 saveToRank($name,$score2);
	 echo "	<div class='gamePin'>
    				<div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
   	  				<h2>Name:</h2>
   		 				<h1>".$name."</h1>
   		  			<h2>Score:</h2>
   						<h1 id='score'>".$score2."</h1>";
   	  getRank($name);
   	  echo "</div></div>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
?>