<?php
function dobCheck($dob){
    
    $s=$dob;
    $arr=explode("-",$s);
    $Actual=$arr[2]."-".$arr[1]."-".$arr[0];
    // date_time_set('Asia/kolkata');
    date_default_timezone_set('asia/kolkata');
    $d= date('Y');
    // var_dump($d);
    $a=intval($arr[0]);
    $d=intval($d);
    if($a<=$d-18)
    {
        return true;
    }
    else{
      return false;
    }
    }

    function correctDOB($dob){
    
      $s=$dob;
      $arr=explode("-",$s);
      $Actual=$arr[2]."-".$arr[1]."-".$arr[0];
     echo $Actual;
      }
?>