<head>
      <link type="text/css" rel="stylesheet" href="http://gigahornet.com/css/bootstrap.min.css">
      <style>
        input{
          width: 100%;
        }
        #qa div {
          margin: 10px;
          width: 90%;
          
        }

  </style>
</head>

<?php 
  include 'includes/functions.php';
  include 'includes/connect.php';


$NUMOFIANSWERS = 6; //minus 1 
?>

<div class='col-md-12' style='border-style: solid; border-width: 1px; border-color: black'>
  <div class='col-md-6'>
    <h1>
      Add
    </h1>
    <br />
    <form method='post'>
      <input type='text' name='question' placeholder='Question' /><br />
      <input type='text' name='answer' placeholder='Answer' /><br />
      <h3>
        Optional
      </h3><br />
        <?php 
      $count = 1;
      while($count < 6) //show 5
      {
                echo "<input type='text' name='ianswer$count' placeholder='Incorrect Answer $count' /><br />";
        $count++;
      }
      ?>
      <input type='submit' value='Add' name='add' />

    </form>
  </div>
  <div class='col-md-6'>
    <h1>
      Search
    </h1>
    <br />
     <form method='post'>
             <h3>
        Only one field required for search
      </h3><br />
      <input type='text' name='question' placeholder='Question' /><br />
      <input type='text' name='answer' placeholder='Answer' /><br />

        <?php 
      $count = 1;
      while($count < $NUMOFIANSWERS) //show 5
      {
                echo "<input type='text' name='ianswer$count' placeholder='Incorrect Answer $count' /><br />";
        $count++;
      }
      ?>
      <input type='submit' value='Search' name='search' />
    </form>
  </div>
</div><br /><br />

<?php 
  $addBtn = $_POST['add'];
  $search = $_POST['search'];

  $question = $_POST['question'];
  $answer = $_POST['answer'];
  $question = strtolower($question);
  $answer = strtolower($answer);

  $ianswer = array();
  $name = "";
  $count = 1;
    $name = "ianswer".$count;
$size = 0;
  while($count < $NUMOFIANSWERS && ($_POST[$name] != "")){
    $name = "ianswer".$count;
    $ianswer[$count-1] = $_POST[$name];
    $count++;
  }
$size = $count-2;
  

?>

<br />
<center><h2>
  <?php 
  
    if(isset($search)){
    //$str = arrayToStr($ianswer, $size);
    //$sql = "INSERT INTO `qa`.`questions` (`id`, `question`, `answer`, `ianswer`) VALUES (NULL, '$question', '$answer', '$str');";
    $sql = "SELECT * FROM `questions` WHERE `question`='$question' OR `answer`='$answer'";
      $query = mysqli_query($connect, $sql);
    if($query){
      while($results = mysqli_fetch_assoc($query)){
        $question1 = $results['question'];
        $answer1 = $results['answer'];
      echo "<h1>Question: <b>$question1</b></h1><br /><h1>Answer: <b>$answer1</b></h1>";

      }
    }else{
      echo "Search Failed";
    }//*/
  }
  
  
  
  if(isset($addBtn)){
    $str = arrayToStr($ianswer, $size);
    $sql = "INSERT INTO `qa`.`questions` (`id`, `question`, `answer`, `ianswer`) VALUES (NULL, '$question', '$answer', '$str');";
    $query = mysqli_query($connect, $sql);
    if($query){
      echo "Successfully added to the database";
    }else{
      echo "Insertion Failed";
    }
  }
  ?>
  <br />
<hr />
  <?php 
   
  ?>
  <a href='allAnswers.php'>View all answers</a>
  </h2></center>
