<?php 
include 'includes/connect.php';
$sql = "SELECT * FROM `questions`";
      $query = mysqli_query($connect, $sql);
  if($query){
    echo "<br /><div id='qa'>";
      while($results = mysqli_fetch_assoc($query)){
        $question1 = $results['question'];
        $answer1 = $results['answer'];
        echo "<div class'col-md-2'></div>";
        echo "<div class='col-md-8' style='border-style: solid; border-width: 1px; border-color: black'>";

      echo "<h1>Question: <b>$question1</b></h1><br /><h1>Answer: <b>$answer1</b></h1><br /><br />";
      echo "</div>";
              echo "<div class'col-md-2'></div>";

      }
    }else{
      echo "Search Failed";
    }
  echo "</div>";
  
?>