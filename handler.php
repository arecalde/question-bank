<?php 
  include 'includes/connect.php';
  $run = $_POST['run'];
  $question = $_POST['question'];
  $answer = $_POST['answer'];
  $job = $_POST['job'];
       $question = strtolower($question);
  $answer = strtolower($answer);
  $isDuplicate = true;
  if($job == "A"){
    $sql = "SELECT * FROM `questions` WHERE (`question` = '".$question."' AND `answer` = '".$answer."')";
    $query = mysqli_query($connect, $sql);
    $isDuplicate = !(mysqli_num_rows($query) == 0);
    if($run == 0 && $isDuplicate){
      echo 1;
    }else{
 
      $sql = "INSERT INTO `qa`.`questions` (`id`, `question`, `answer`, `ianswer`) VALUES (NULL, '$question', '$answer', '');";
      $query = mysqli_query($connect, $sql);
      echo "A";
    }
    
  }else if($job == "S"){
   $sql = "SELECT * FROM `questions` WHERE (`question` LIKE '%%".$question."%%' AND `answer` LIKE '%%".$answer."%%')";

    echo "S";
    
  }
?>