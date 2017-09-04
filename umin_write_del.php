<?php
 session_start();

  $conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
  $no = $_GET['no'];
  $sql = "SELECT * from board where no = {$no}";
  $result = mysqli_query($conn, $sql);
  $arr = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  if($arr['writer'] != $_SESSION['id'] and $_SESSION['id'] != 'master')
  {
    echo "<script>
          alert('게시글 삭제 권한이 없습니다.')
          location.href='javascript:history.back()';
          </script>";
          exit;
  }

  $sql = "DELETE FROM board WHERE no = {$no}";
  //print_r($sql);
  //exit;
  $result = mysqli_query($conn,$sql);

  if($result)
  {
    echo "<script>alert('글 삭제에 성공 하였습니다.');
          location.href='/board/team-/free_menu.php?page=1';
          </script>";

          mysqli_close($conn);
  }
  else
  {
    echo "<script>alert('글 삭제에 실패 하였습니다.');
          location.href='javascript:history.back()';
          </script>";

          mysqli_close($conn);
  }
  ?>
