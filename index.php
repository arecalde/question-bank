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
      <input type='submit' value='Add' />

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
      while($count < 6) //show 5
      {
                echo "<input type='text' name='ianswer$count' placeholder='Incorrect Answer $count' /><br />";
        $count++;
      }
      ?>
      <input type='submit' value='Search' />
    </form>
  </div>
</div><br /><br /><br />
<center><h2>
All Questions and Answers
  </h2></center>