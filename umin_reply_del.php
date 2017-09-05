<?php
  session_start();
  if(!$_SESSION['host'])
  {
    echo "<script>alert('권한이 없습니다.');
          location.href='free_menu.php';
          </script>";
          exit;
  }
  $conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
  if(!$conn)
  {
    echo "DB접속에 실패 하였습니다.";
    exit;
  }
  $no = $_POST['no'];
  $board_no = $_POST['board_no'];
  $sql = "DELETE FROM reply WHERE no = {$no} AND board_no = {$board_no} AND board_name = 'board'";
  $result = mysqli_query($conn,$sql);

  if($result)
  {

    $sql = "UPDATE board set reply = reply - 1 where no = {$_POST['board_no']}";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
      echo "<script>alert('댓글 삭제에 성공 하였습니다.');
            location.href='javascript:history.back()';
            </script>";
              mysqli_close($conn);
    }
    else
    {
      echo "<script>alert('댓글 개수 수정이 안되었습니다.');
            location.href='javascript:history.back()';
            </script>";
              mysqli_close($conn);
    }

  }
  else
  {
    echo "<script>alert('데이터가 없습니다.');
          location.href='javascript:history.back()';
          </script>";
            mysqli_close($conn);

  }
 ?>
