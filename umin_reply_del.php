<?php
  $conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
  $no = $_POST['no'];
  $sql = "DELETE FROM reply WHERE no = {$no} AND no = {$no} AND board_name = 'board'";
  $result = mysqli_query($conn,$sql);

  if($result)
  {

    $sql = "UPDATE board set reply = reply - 1 where no = {$_POST['board_no']}";
    mysqli_query($conn, $sql);
    echo "<script>alert('댓글 삭제에 성공 하였습니다.');
          location.href='javascript:history.back()';
          </script>";
            mysqli_close($conn);

  }
  else
  {



    echo "<script>alert('댓글 삭제에 실패 하였습니다.');
          location.href='javascript:history.back()';
          </script>";
            mysqli_close($conn);

  }
 ?>
