<?php 
//save user ansvers to db and evaluate and return score and rank on web
  include '../controlDatabase/dbConnect.php';
  include '../controlDatabase/saveResult.php';
  include '../calcResults/getScore.php';
  include '../calcResults/getRank.php';

  $userAnswers = $_GET["userAnswers"];

  $userAnswersSplit = explode(",", $userAnswers);
  $name = mysqli_real_escape_string($conn, $userAnswersSplit[0]);

  $sqlForCountOfTries = "SELECT id FROM answers WHERE name LIKE '$name%'";
  $resultForCountOfTries = mysqli_query($conn,$sqlForCountOfTries);
  $countOfTries = mysqli_num_rows($resultForCountOfTries);
    
  $sql = "INSERT INTO answers ( name, try, startTime";
  $userScore = 0;

  // Get active settings
  $settingsQuery = mysqli_query($conn, "SELECT * FROM settings WHERE `id` = 1; ");
  if (!$settingsQuery) {
      die ('SQL Error: ' . mysqli_error($conn));
  }
  $settingsRow = mysqli_fetch_array($settingsQuery);

  // Get active question set
  $questionSetQuery = mysqli_query($conn, "SELECT * FROM questionset WHERE `id_qs` = ".$settingsRow["idOfActiveQuestionSet"]."; ");
  if (!$questionSetQuery) {
      die ('SQL Error: ' . mysqli_error($conn));
  }
  $questionSetRow = mysqli_fetch_array($questionSetQuery);
  $questionsArray = explode(", ", implode((array)$questionSetRow["questions"]));

  foreach ($questionsArray as &$indexOfQuestion) {
    $sql .= ", AQ".$indexOfQuestion.", timeAQ".$indexOfQuestion;
  }
  $sql .= ") VALUES ('$name', '$countOfTries'";

  for ($i=1; $i < sizeof($userAnswersSplit)-1 ; $i++){
    $sql .= ", '".mysqli_real_escape_string($conn, $userAnswersSplit[$i])."'";
    
  }
  $sql .= ")";

  if ($conn->query($sql) === TRUE) {
    $score2 = getScore($name, $countOfTries);
    saveToRank($name, $countOfTries, $score2);
    echo " <div style='width: 280px; left: 28%; right: 28%;' class='gamePin'>
            <div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
              <h2>Name:</h2>
              <h1>".$name."</h1>
              <h2>Score:</h2>
              <h1 id='score'>".$score2."</h1>
              <h2>Try:</h2>
              <h1 id='try'>".$countOfTries."</h1>";
    getRank($name);
   	  echo "</div></div>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
?>
