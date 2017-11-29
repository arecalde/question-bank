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
    $returnStr = "(";
    while($index < $size){
      if($index == ($size-1)){
        $returnStr = $returnStr.$array[$index];
        
      }else{
        $returnStr = $returnStr.$array[$index]."|";

        
      }
      $index++;
    }
    return $returnStr.")";
  }
?>