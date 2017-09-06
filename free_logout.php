<?php
session_start();
session_destroy();

echo "<script>
      alert('로그아웃 했습니다.');
      location.href='/board/team-/free_menu.php?no=1';
      </script>";

?>
