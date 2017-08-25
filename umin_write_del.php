<?php
  $conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
  $no = $_GET['no'];
  $sql = "DELETE FROM board WHERE no = {$no}";
  //echo $sql;
  //exit;
  $result = mysqli_query($conn,$sql);

  if($result)
  {
    echo "<script>alert('글 삭제에 성공 하였습니다.');
          location.href='/20170822/free_menu.php?page=1';
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
