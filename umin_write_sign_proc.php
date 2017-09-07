<?php
session_start();
$conn = @mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
if(!$conn)
{
	echo "<script>
		alert('데이터 베이스에 접속하지 못했습니다.');
		location.href='/board/team-/free_menu.php';
	</script>";
exit;
}

if(!isset($_SESSION['host']))
{
	echo "<script>
			alert('접근 권한이 없습니다.');
			location.href='/board/team-/free_menu.php';
		</script>";
	exit;
}


if($_POST['sign'] == '' or $_POST['subject'] == '')
{
  echo "<script>
        alert('신고사유를 작성하지 않았습니다.');
        location.href='/board/team-/umin_write_sign.php?no={$_POST['no']}';
        </script>";
        exit;
}

$sign = mysqli_real_escape_string($conn, $_POST['sign']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$no = $_POST['no'];
$sql = "INSERT INTO sign(writer, subject, content, board_name, board_no) values('{$_SESSION['id']}', '{$subject}', '{$sign}', 'board', {$no})";
$result = mysqli_query($conn, $sql);
//print_r($sql);


$sql = "UPDATE boar SET sign = 1 where no = {$no}";
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
