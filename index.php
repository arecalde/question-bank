<head>
      <link type="text/css" rel="stylesheet" href="http://gigahornet.com/css/bootstrap.min.css">
      <style>
        input{
          width: 60%;
          height: 50px;
          font-size: 40px;
          margin: 3px;
        }
    button{
          width: 60%;
          height: 50px;
          font-size: 40px;
          margin: 3px;
        }
::-webkit-input-placeholder {
   text-align: center;
    font-size: 40px;
}

:-moz-placeholder { /* Firefox 18- */
   text-align: center;  
      font-size: 40px;

}

::-moz-placeholder {  /* Firefox 19+ */
   text-align: center;  
    font-size: 40px;

        }

:-ms-input-placeholder {  
   text-align: center; 
    font-size: 40px;

        }
  </style>
  
  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>  
</head>

<?php 
  include 'includes/functions.php';
  include 'includes/connect.php';


$NUMOFIANSWERS = 0; //minus 1 
?>
<center> <h1>
      Question Bank Search
    </h1>

    <br />
  <input type='text' id='question' placeholder='Question' /><br /><br />
  <input type='text' id='answer' placeholder='Answer' /><br />
  <h3>
    
  </h3><br />
<?php 
  $count = 1;
  while($count < $NUMOFIANSWERS) {
    echo "<input type='text' id='ianswer$count' placeholder='Incorrect Answer $count' /><br />";
    $count++;
  }
?>
<div class='col-md-12' style='border-style: solid; border-width: 1px; border-color: black'>
  <div class='col-md-6'>
            <button onclick="jqStuff('A')">Add</button>

  </div>
  <div class='col-md-6'>
            <button onclick="jqStuff('S')">Search</button>
  </div>
</div>
<br /><br />
</center>
<script type='text/javascript'>
    var run = 0;
    function jqStuff(job){
      $.ajax({
        type: 'post',
        url: "handler.php",
        data: {
            'question': document.getElementById('question').value,
            'answer': document.getElementById('answer').value,
            'run': run,
            'job': job
        },
        cache: false,
        success: function(data) {
          if(data=='A'){
             alert('Added');
             run = 0;
             }

          else if(data == 'S'){
            alert('Search successful');        
          }
          else if(data == '1'){
            run = 1;     
                              alert('Duplicate, if you want to add it again, please press add again');

          }
        }
    });
      
    }
</script>
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
    //$sql = "SELECT * FROM `questions` WHERE `question`='$question' OR `answer`='$answer'";
          $sql = "SELECT * FROM `questions` WHERE (`question` LIKE '%%".$question."%%' AND `answer` LIKE '%%".$answer."%%')";

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
  <a href='allAnswers.php' target=_blank>View all answers</a>
  </h2></center>
