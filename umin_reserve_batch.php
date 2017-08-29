<?php
date_default_timezone_set("Asia/Seoul");
$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
for(;;)
{
  $data90 = date("Y-m-d H:i:s", time());
  $sql = "SELECT * from reserve where show_date <= '{$data90}'";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
  $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  echo "{$rows}개의 예약글을 확인했습니다.\n";
  

  for($i=0;$i<$rows;$i++)
  {
    $sql = "INSERT into board(writer, subject, content, upload)
    VALUES('{$arr[$i]['writer']}', '{$arr[$i]['subject']}',
    '{$arr[$i]['content']}', '{$arr[$i]['upload']}')";
    $result = mysqli_query($conn, $sql);
    echo "{$arr[$i]['no']}번 예약글이 등록됐습니다.\n";


    $sql = "DELETE FROM reserve where no = {$arr[$i]['no']}";
    $result = mysqli_query($conn, $sql);
    echo "예약글 {$arr[$i]['no']}번 삭제완료\n";


  }
 sleep(10);
}

?>
