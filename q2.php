<?php
function analyzeMsg($input,$output)
{
  $in_arr = str_split($input,1);
  $out_arr = str_split($output,1);
  if(count($in_arr) != count($out_arr)) //If length diff, invalid
  {
    return "Invalid";
  }
  $encrypt_type=0;
  $count_encrypt =0;
  $add_value = 0;
  $prev_add_value = 0;
  for($i=0;$i<count($in_arr);$i++)
  {
    if(($in_arr[$i]+$out_arr[$i])==10)
    {
      if($encrypt_type == 0 || $encrypt_type == 1 )
        $encrypt_type = 1;
      else  
        return "invalid"; //If next value diff, invalid
      $count_encrypt++;
    }
    else 
    {
      if($encrypt_type == 0 || $encrypt_type == 2 )
        $encrypt_type = 2;
      else  
        return "invalid"; //If next value diff, invalid
      $count_encrypt++;
      $add_value = $out_arr[$i] - $in_arr[$i];
      if($prev_add_value == 0)
        $prev_add_value = $add_value;
      
      if($prev_add_value!=$add_value) 
       return "invalid"; //If next value diff, invalid
    }
    
    
    if($count_encrypt == count($in_arr))
    {
      if($encrypt_type == 1)
        return "Mike encrypts his message by summing up to 10 to each original character.<br>"; 
      if($encrypt_type == 2)
        return "Mike encrypts his message by adding ".$add_value." to each original character.<br>"; 
    
    }
 
  }
  
}

echo analyzeMsg("123456","987654");
echo analyzeMsg("98642","87531");

?>