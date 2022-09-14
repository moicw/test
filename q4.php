<?php
$item_rarity = [1,2,3,4,5]; // 1 = common, 5 = legendary 
$vip_ranks = ["vip1","vip2","vip3"]; // vip1 = lowest rank
$possibility = 70;
$total_chance = 100;
$diff_every_vip = 3;

function set_chances()
{
  global $item_rarity;
  global $vip_ranks;
  global $possibility;
  global $total_chance;
  global $diff_every_vip;
 
  for($i=0;$i<count($vip_ranks);$i++)
  {
    //echo $vip_ranks[$i]."<br>";
    $changes = $total_chance;
    $arr[$vip_ranks[$i]]=[];
    for($j=0;$j<count($item_rarity);$j++)
    {
        
        $changes = $changes - ($changes*$possibility)/100;
        if($j == 4)
          $changes=0; //Set last array chance as 0, as initial value.
        array_push($arr[$vip_ranks[$i]],$changes);
        
      
    } 
    $possibility=$possibility-$diff_every_vip;//Increase rarity chance
  
  }
  return $arr;
}
function roll_item($vip)
{
  global $calculated_chances;
  global $item_rarity;
  $selected_vip = $calculated_chances[$vip];
  //roll 100times
  $generated_arr[$selected_vip]=[];
  $rare_arr = [];
  for($rare=0;$rare<count($selected_vip);$rare++)
  {
    $rare_arr[$item_rarity[$rare]] = 0;
  }
  for($roll=0;$roll<100;$roll++)
  {
    $random = (rand(1,100));
   
    for($rare=0;$rare<count($selected_vip);$rare++)
    {
     
      if($random>$selected_vip[$rare])
      {
        
        $rare_arr[$item_rarity[$rare]] = $rare_arr[$item_rarity[$rare]]+1;
        break;
      }
        

    }
  }
  ksort($rare_arr);
  return $rare_arr;
  
}
$calculated_chances = set_chances();

for($vip=0;$vip<count($vip_ranks);$vip++)
{
  //echo json_encode($calculated_chances[$vip_ranks[$vip]])."<br>";
  echo $vip_ranks[$vip]." ";
  echo json_encode(roll_item($vip_ranks[$vip]))."<br>";
}

?>