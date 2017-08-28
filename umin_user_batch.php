<?php
session_start();
date_default_timezone_set("Asia/Seoul");
$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');

for(;;)
{
$date = date("Y-m-d H:i:s", strtotime("-90 day"));

$sql = "SELECT * from user where active = 1 and last_login <= '{$date}'";
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);
$arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
echo "{$rows}개의 계정이 검색됐습니다.\n";


  if($rows)
  {
    for($i=0;$i<$rows;$i++)
    {
      $sql = "UPDATE user set active = 0 where id = '{$arr[$i]['id']}'";
      $result = mysqli_query($conn, $sql);
      echo "{$arr[$i]['no']}번 계정이 휴면계정으로 전환됩니다.\n";


    }
  }
  sleep(10);
}








?>
