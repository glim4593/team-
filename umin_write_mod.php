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

?>
<form method='POST' action='' align='right'>
	<!--
	<a href="/20170822/free_menu.php?cate=0page=1">잡담</a>
	<a href="/20170822/free_menu.php?cate=1page=1">유머</a>
	<a href="/20170822/free_menu.php?cate=2page=1">게임</a>
-->
<?php
if(!isset($_SESSION['host']))
{
	echo "<script>
			alert('접근 권한이 없습니다.');
			location.href='/board/team-/free_menu.php';
		</script>";
	exit;
}

$sql = "SELECT * from board where no = {$_GET['no']}";
$result = mysqli_query($conn, $sql);
$fetch = @mysqli_fetch_assoc($result);
if($_SESSION['id'] != $fetch['writer'] and  $_SESSION['id'] != 'master')
{
	echo "<script>
			alert('접근 권한이 없습니다.');
			location.href='/board/team-/free_menu.php';
		</script>";
	exit;
}

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
  <input type='button'  onclick="location.href='/board/team-/umin_write.php'" value='글쓰기'>
  <input type='button' onclick="location.href='/board/team-/free_logout.php'" value='로그아웃'>
	</div>
</form>
<?php

//print_r($_POST);
$no = $_GET['no'];
$sql = "SELECT * FROM board WHERE no = {$no}";
$result = mysqli_query($conn,$sql);
$arr = @mysqli_fetch_assoc($result);

if(!$result)
{
	echo "<script>
			alert('작성자의 정보를 불러오지 못했습니다.');
			location.href='/board/team-/free_menu.php';
			</script>";
	exit;
}
?>

<form method="POST" enctype="multipart/form-data" action="/board/team-/umin_write_mod_proc.php">
<input type="hidden" value="<?=$no?>" name="no">
<table border="1" width="100%" style="font-weight:bold">
  <tr><th width="9%"><font size="4">번호</font></th><td><?=$arr['no']?></td></tr>
  <tr><th width="9%"><font size="4">제목</font></th>
    <td><input type="text" value="<?=$arr['subject']?>" name="subject"></td>
  <tr><th width="9%"><font size="4">작성자</font></th><td><?=$arr['writer']?></td></tr>
  <tr><th width="9%"><font size="4">작성일</font></th><td><?=$arr['date']?></td></tr>
  <tr><th width="9%"><font size="4">조회수</font></th><td><?=$arr['hit']?></td></tr>
  <tr><th width="9%"><font size="4">첨부파일</font></th>
    <td><input type="file" value="<?=$arr['upload']?>" name="upload"></td>
  <tr><th colspan="2"><font size="5">본문 내용</font></th></tr>
  <tr><td colspan="2"><textarea style='width:100%' cols="100" rows="9" name="content"><?=$arr['content']?></textarea></td></tr>
 </table>
 <br>
<div align="center"><input type="submit" style= "font-size:1.5em; height:40px;" value="수정"></div>
</form>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
