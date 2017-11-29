<head>
      <link type="text/css" rel="stylesheet" href="http://gigahornet.com/css/bootstrap.min.css">
      <style>
        input{
          width: 100%;
        }    
  </style>
</head>

<?php 
  include '../databases/questionBankConnect.php';
  include 'includes/functions.php';
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
      <input type='submit' value='Search' />
    </form>
  </div>
</div><br /><br />

<?php 
  $addBtn = $_POST['add'];

  $question = $_POST['question'];
  $answer = $_POST['answer'];
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
All Questions and Answers
  </h2></center>
