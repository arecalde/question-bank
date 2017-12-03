<?php
include 'includes/connect.php';
$fin = fopen("q1.html", "r") or die("Unable to open file!");
$print       = false;
$printAnswer = false;
$num         = 0;
$x           = fgets($fin);
echo "Starting<br />";
$count         = 0;
$posInArray    = 0;
$questionArray = array();
while ($count < 100) {
    $questionArray[$count] = "";
    $count++;
}
$count = 0;
while (!feof($fin)) {
    if (strContains($x, "<div id=\"question_")) {
        
        $print = true;
    }
    if (strContains($x, "correct_answer")) {
        
        $printAnswer = true;
    }
    if ($print) {
        $questionArray[$posInArray] = $questionArray[$posInArray] . $x;
    }
    if ($printAnswer && strContains($x, "title=")) {
        echo parseQuestion($questionArray[$posInArray]);

        echo "<b>" . parseAnswer($x);
				$question = parseQuestion($questionArray[$posInArray]);
				$answer =  parseAnswer($x);
			        $sql         = "SELECT * FROM `questions` WHERE (`question` = '" . $question . "' AND `answer` = '" . $answer . "')";
        $query       = mysqli_query($connect, $sql);
        $isDuplicate = !(mysqli_num_rows($query) == 0);
        if ($run == 0 && $isDuplicate) {
            echo "D";
        } else {
            $sql   = "INSERT INTO `qa`.`questions` (`id`, `question`, `answer`, `ianswer`) VALUES (NULL, '$question', '$answer', '');";
            $query = mysqli_query($connect, $sql);
            echo "I";
        }
			        $posInArray++;

			        echo "</b><br /><hr /><br/>";

        
    }
    if (strContains($x, "</span>")) {
        $printAnswer = false;
        
    }
    if (strContains($x, "</div>")) {
        
        $print = false;
        
    }
    $x = fgets($fin);
    $count++;
    
}
fclose($fin);
echo "<br />Ending $count";
function strContains($toSearchIn, $toSearchWith)
{
    if (strpos($toSearchIn, $toSearchWith) === false) {
        return false;
    } else {
        return true;
    }
}
function parseAnswer($x)
{
    $posInString = 0;
    $answer      = "";
    $innerPrint  = false;
    while ($posInString < strlen($x)) {
        if ($x[$posInString] == chr(34) && $x[$posInString + 1] == '>') {
            $innerPrint = false;
            break;
        }
        if ($innerPrint) {
            $answer = $answer . $x[$posInString];
            
        }
        if ($x[$posInString] == chr(34) && $x[$posInString + 1] != '>') {
            $innerPrint = true;
        }
        $posInString++;
    }
    $answer = str_replace("This was the correct answer", "", $answer);
    return $answer;
}

function parseQuestion($x)
{
    $posInString = 0;
    $answer      = "";
    $innerPrint  = false;
    while ($posInString < strlen($x)) {
        if ($x[$posInString] == '<' && $x[$posInString + 1] == '/') {
            $innerPrint = false;
            break;
        }
        if ($innerPrint) {
            $answer = $answer . $x[$posInString];
            
        }
        if ($x[$posInString] == '>') {
            $innerPrint = true;
        }
        $posInString++;
    }
    return $answer;
    
    
}



?>