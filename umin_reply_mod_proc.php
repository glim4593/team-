<?php

$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
  $no = $_POST['no'];
  $board_no = $_POST['board_no'];
  //print_r($board_no);

  $writer = mysqli_real_escape_string($conn,$_POST['writer']);
  $content = mysqli_real_escape_string($conn,$_POST['content']);
  $date = mysqli_real_escape_string($conn,$_POST['date']);

  if($writer == '' OR $content == '')
  {//입력이 안되었으면
    //echo "입력 된 값이 없어요";
    echo "<script>alert('내용이 입력되지 않았습니다.');
          location.href='/20170822/umin_read.php?no={$board_no}';
          </script>";
    mysqli_close($conn);
    exit;
  }
  $alert = array("강아지", "고양이");
  $count = count($alert);
  for($i=0;$i<$count;$i++)
  {

    $content = str_replace($alert[$i], "OO", $content);
  }
  $sql = "UPDATE reply SET writer = '{$writer}', content = '{$content}', date = now() WHERE no = {$no}";
  $result = mysqli_query($conn,$sql);

  if($result)//INSERT 성공 = 1
  {

    echo "<script>alert('댓글이 수정되었습니다.');
          location.href='/20170822/umin_read.php?no={$board_no}';
          </script>";
          mysqli_close($conn);

  }
  else
  {

    echo "<script>alert('댓글 수정에 실패 했습니다.');
          location.href='/20170822/umin_read.php?no={$board_no}';
          </script>";
      mysqli_close($conn);
    }
