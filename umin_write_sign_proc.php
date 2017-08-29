<?php
session_start();
if($_POST['sign'] == '' or $_POST['subject'] == '')
{
  echo "<script>
        alert('신고사유를 작성하지 않았습니다.');
        location.href='/board/team-/umin_write_sign.php?no={$_POST['no']}';
        </script>";
        exit;
}
$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
$sign = mysqli_real_escape_string($conn, $_POST['sign']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$no = $_POST['no'];
$sql = "INSERT INTO sign(writer, subject, content, board_name, board_no) values('{$_SESSION['id']}', '{$subject}', '{$sign}', 'board', {$no})";
$result = mysqli_query($conn, $sql);
//print_r($sql);


$sql = "UPDATE board SET sign = 1 where no = {$no}";
$result = mysqli_query($conn, $sql);

//print_r($sql);
//exit;
if($result)
{
  echo "<script>
        alert('신고를 완료했습니다.');
        location.href='/board/team-/umin_read.php?no={$_POST['no']}';
        </script>";
}
else
{
  echo "<script>
        alert('신고를 실패했습니다.');
        location.href='/board/team-/umin_write_sign.php?no={$_POST['no']}';
        </script>";

}

mysqli_close($conn);

?>
