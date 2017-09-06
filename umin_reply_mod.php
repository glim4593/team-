
<?php
session_start();
if(!$_SESSION['host'])
{
	echo "<script>alert('권한이 없습니다.');
				location.href='free_menu.php';
				</script>";
				exit;
}
?>
<form method='POST' action='' align='right'>
	<!--
	<a href="/20170822/free_menu.php?cate=0page=1">잡담</a>
	<a href="/20170822/free_menu.php?cate=1page=1">유머</a>
	<a href="/20170822/free_menu.php?cate=2page=1">게임</a>
-->
<?php
if($_SESSION['id'] != 'master')
{
?>
	<div><?=$_SESSION['id']?>님 반갑습니다.
<?php
}
else
{
	echo "<div>관리자님 반갑습니다.";
}
?>
  <input type='button'  onclick="location.href='/20170822/umin_write.php'" value='글쓰기'>
  <input type='button' onclick="location.href='/20170822/free_logout.php'" value='로그아웃'>
	</div>
</form>
<?php
$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
if(!$conn)
{
	echo "DB접속에 실패 하였습니다.";
	exit;
}
  $board_no = $_POST['board_no'];
//  print_r($board_no);
  $no = $_POST['no'];
  $sql = "SELECT * FROM reply WHERE no = {$no} AND board_name = 'board'";
  $result = mysqli_query($conn, $sql);
	if(!$result)
	{
		echo "<script>alert('테이블에 데이터가 존재 하지 않습니다');
		      location.href='javascript:history.back()';
					</script>";
					exit;
	}
  $arr = mysqli_fetch_assoc($result);
?>
<form method="POST" action="/20170822/umin_reply_mod_proc.php">
<input type="hidden" value="<?=$no?>" name="no">
<input type='hidden' value='<?=$board_no?>' name='board_no'>
<table border="1" width="100%" style="font-weight:bold">
  <tr>
    <th width="10%">작성자</th><th width="60%">내용</th><th width="20%">작성일시</th>
    <th width="10%" rowspan="2"><div align="center"><input type="submit" value="댓글수정"></div></th>
  </tr>
  <td><input type="text" value="<?=$arr['writer']?>" name="writer" readonly></td>
  <td><textarea type="text" cols='75' rows='1'  name="content"><?=$arr['content']?></textarea></td>
  <td><input type="text" value="<?=$arr['date']?>" name="date" readonly></td>
</table>
</form>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
