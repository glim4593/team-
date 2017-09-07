<?php
session_start();
$conn = @mysqli_connect('127.0.0.1' , 'root', '1234', 'umin');
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

?>

<head>
  <style>
  </style>
</head>
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
  <input type='button'  onclick="location.href='/board/team-/umin_write.php'" value='글쓰기'>
  <input type='button' onclick="location.href='/board/team-/free_logout.php'" value='로그아웃'>
	</div>
</form>
<?php

$no = $_GET['no'];

$sql = "SELECT * FROM board where no = {$no}";
$result = @mysqli_query($conn, $sql);
//print_r($sql);
$rows = @mysqli_num_rows($result);
$arr = @mysqli_fetch_assoc($result);
  @mysqli_free_result($result);

if(!$result)
{
	echo "<script>
			alert('데이터를 가져오지 못했습니다.');
			location.href='/board/team-/free_menu.php';
		</script>";
	exit;
}


if($_SESSION['id'] == $arr['writer'])
{
	echo "<script>
			alert('작성자 본인의 글은 신고할 수 없습니다.');
			location.href='/board/team-/free_menu.php';
		</script>";
	exit;
}

if($rows)
{
 ?>
 <form method='POST' action='/board/team-/umin_write_sign_proc.php'>
 <table border='1' width="100%">
   <input type='hidden' name='no' value='<?=$arr['no']?>'>
 <tr>
   <th style="width:20%;">작성자</th><td style="width:80%;"><input type='text' name='writer' style="width:100%;" value='<?=$arr['writer']?>' readonly></td>
 </tr>
 <tr>
   <th style="width:20%;">제목</th><td style="width:80%;"><input type='text' name='subject' style="width:100%;" value='<?=$arr['subject']?>' readonly></td>
 </tr>
 <tr>
   <th style="width:20%;">작성일</th><td style="width:80%;"><input type='text' name='date' style="width:100%;" value='<?=$arr['date']?>' readonly></td>
 </tr>
 <tr>
   <th colspan="2">본문내용</th>
 </tr>
 <tr>
   <td colspan="2"><textarea name='content' style="width:100%; height:70px;" readonly><?=$arr['content']?></textarea></td>
 </tr>
 </table>
 <br>
 <br>
 <div align='center' style='font-size:20px'><strong>게시글 신고</strong></div>
 <table border='1' width="100%">
 <tr>
   <th style="width:20%">신고인</th><th align='left'><?=$_SESSION['id']?></th>
 </tr>
 <tr>
   <th colspan="2">신고사유</th>
 </tr>
 <tr>
   <th>제목</th><th><input type='text' style="width:100%" name='subject'></th>
 </tr>
 <tr>
   <td colspan="2"><textarea name='sign' style="width:100%; height:70px;"></textarea></td>
 </tr>
 </table>
 <br>
 <div style="text-align:center;">
 <input type='submit' style= "font-size:1em; height:29px;" value='신고하기'>
 </div>
</form>
  <?php
}
else
{
  echo "<script>
        alert('글이 존재하지 않습니다.');
        location.href='javascript:history.back()';
        </script>";

        mysqli_close($conn);
        exit;
}




mysqli_close($conn);








?>



</html>
