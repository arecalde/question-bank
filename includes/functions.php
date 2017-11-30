<?php
  function displayArray($array, $size){
    $index = 0;
    while($index < $size){
      echo $array[$index]."<br />";
      $index++;
    }
  }

  function arrayToStr($array, $size){
    $index = 0;
    $returnStr = "";
    while($index < $size){
      if($index == ($size-1)){
        $returnStr = $returnStr.$array[$index];
        
      }else{
        $returnStr = $returnStr.$array[$index]."|";

        
      }
      $index++;
    }
    return $returnStr."";
  }

  function parseStr($str){
    $index = 0;
    $count = 0;
    $answer = array();
    while($count < strlen($str)){
      if(!isset($answer[$index])){
        $answer[$index] = "";
      }
      $answer[$index] = $answer[$index].$str[$count];
      if($str[$count+1] == '|'){
        $index++;
        $count++; 
      }
      $count++;
    }
    displayArray($answer, count($answer));
    
  }
?>