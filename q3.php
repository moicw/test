<?php
function testSummary($array)
{
  $pass_rate = 50;
  for($i=0;$i<count($array);$i++)
  {
    
    $student = $array[$i];

    $name = $student[0];
    $gender = ($student[1] == "Male" ? "he":"she");
    $math = $student[2];
    $math_txt = "Mathematics";
    $science = $student[3];
    $science_txt = "Science";
    //Part 1 Average
    $average = ($math +  $science)/2;
    $part1 = $name." has an average score of ".$average." from this test. ";
    
    //Part 2
    if($math >= $pass_rate && $science >= $pass_rate)
    {
      $part2 = "Overall, ". $gender ." is performing very well in this test.";
    }
    else if($math >= $pass_rate && $science < $pass_rate)
    {
      $part2 = "However, ". $gender ." is not doing well for ".$science_txt." subject.";
    }
    else if($math < $pass_rate && $science  >= $pass_rate)
    {
      $part2 = "However, ". $gender ." is not doing well for ".$math_txt." subject.";
    }
    else
    {
      $part2 = "However, ". $gender ." is not doing well for ".$math_txt." and ".$science_txt." subject.";
    }
    echo $part1.$part2."</br>";
  }
}

$arr = [['Annie', 'Female', 70, 50],['Max', 'Male', 20, 70],['Tom', 'Male', 40, 30]];
testSummary($arr)
?>