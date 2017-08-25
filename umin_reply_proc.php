<?php
$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
  if($_POST['no'] == '' OR $_POST['writer'] == '' OR $_POST['content'] == '')
  {
    echo "<script>alert('입력 값 이 없습니다.');
          location.href='javascript:history.back()';
          </script>";
    exit;
  }
  $alert = array("강아지", "고양이");
  $count = count($alert);
$no = $_POST['no'];
$writer = mysqli_real_escape_string($conn,$_POST['writer']);
$content = mysqli_real_escape_string($conn,$_POST['content']);

for($i=0;$i<$count;$i++)
{

  $content = str_replace($alert[$i], "OO", $content);
}

$sql = "INSERT INTO reply(writer,content,board_no,board_name) VALUES ('{$writer}','{$content}',{$no},'board')";
$result = mysqli_query($conn,$sql);

  if($result)
  {
    //mysqli_free_result($result);
    //에러 떠서 리절트 구문을 주석처리
    $sql = "UPDATE board SET reply = reply + 1 WHERE no = {$no}";
    mysqli_query($conn,$sql);

    echo "<script>alert('댓글 등록에 성공 하였습니다.');
          location.href='javascript:history.back()';
          </script>";
          mysqli_close($conn);

  }
  else
  {

    echo "<script>alert('댓글 등록에 실패 하였습니다.');
          location.href='javascript:history.back()';
          </script>";
          mysqli_close($conn);
  }
