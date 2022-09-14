<?php
$round = 0;
$lastmemberstatus="";

function checkDownload($memberType, $fileType){

  global $starttime;
  global $round;
  global $lastmemberstatus;
  global $lastmemberfile;
 
  if($lastmemberstatus == "")
    $lastmemberstatus = $memberType;
  
  if($memberType != $lastmemberstatus) //If change member type, reset
  {
    $lastmemberstatus = $memberType;
    $round=0;
  }
  $endtime = microtime(true);
  $timediff = $endtime - $starttime;

  $diff_in_time = secondsToTime($timediff)." "; //For Time Display
  $diff_in_s = date("s", strtotime(secondsToTime($timediff))); //In Seconds
  if($diff_in_s >5) //Reset After 5seonds
  {
    $round = 0; 
  }
  if($memberType == "member"){
    

    $lastmemberfile = $fileType;
    if($round < 2 ){
      if($lastmemberfile != $fileType){
        echo $diff_in_time."Too many downloads<br>";
      } else {
        echo $diff_in_time."Your download is starting...<br>";
      }
    } else {
      echo $diff_in_time."Too many downloads<br>";
    }
   
  } else if($memberType == "nonmember"){
    $lastmemberfile = $fileType;
   
    if($round < 1){
      if($lastmemberfile != $fileType){
        echo $diff_in_time."Too many downloads<br>";
      } else {
        echo $diff_in_time."Your download is starting..<br>";
      }
    } else {
      echo $diff_in_time."Too many downloads<br>";
    }

   
  }
  $round++;
}

function secondsToTime($s)
{
    $h = floor($s / 3600);
    $s -= $h * 3600;
    $m = floor($s / 60);
    $s -= $m * 60;
    return $h.':'.sprintf('%02d', $m).':'.sprintf('%02d', $s);
}

$starttime = microtime(true);

echo "Non-Member<br>";
checkDownload("nonmember", "txt");
sleep(2);
checkDownload("nonmember", "jpeg");
sleep(3);
checkDownload("nonmember", "jpeg");

$starttime = microtime(true);
echo "Member<br>";
checkDownload("member", "jpeg");
sleep(3);
checkDownload("member", "jpeg");
sleep(2);
checkDownload("member", "jpeg");
?>
