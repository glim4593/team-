<?php
$conn = mysqli_connect('127.0.0.1', 'root', '123', 'umin');
if(!$conn)
{
	echo "DB접속에 실패 하였습니다.";
	exit;
}
session_start();
$no = $_GET['no'];
$sql = "SELECT * FROM board WHERE no = {$no}";
$result = mysqli_query($conn,$sql);
$arr = mysqli_fetch_assoc($result);
mysqli_free_result($result);
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


  <input type='button'  onclick="location.href='/board/team-/umin_write.php'" value='글쓰기'>
  <input type='button' onclick="location.href='/board/team-/free_logout.php'" value='로그아웃'>
	</div>
</form>


<table border="1" width="100%" style="font-weight:bold">
  <tr><th width="9%"><font size="4">번호</font></th><td><?=$arr['no']?></td></tr>
  <tr><th width="9%"><font size="4">제목</font></th><td><?=$arr['subject']?></td></tr>
  <tr><th width="9%"><font size="4">작성자</font></th><td><?=$arr['writer']?></td></tr>
  <tr><th width="9%"><font size="4">작성일</font></th><td><?=$arr['date']?></td></tr>
  <tr><th width="9%"><font size="4">조회수</font></th><td><?=$arr['hit']?></td></tr>
  <tr><th width="9%"><font size="4">첨부파일</font></th><td><a href='/upload/<?=$arr['upload']?>'><?=$arr['upload']?></a></td></tr>
  <tr><th colspan="2"><font size="5">본문 내용</font></th></tr>
  <tr><td colspan="2"><textarea style="width:100%; height:70px;" readonly><?=$arr['content']?></textarea></td></tr>
</table>


<br>
<div style="text-align:center;">
  <input type="button" style= "font-size:1em; height:29px;" value="목록" onclick="location.href='/board/team-/free_menu.php?page=1'">
  <?php

  if($_SESSION['id'] == $arr['writer'] or $_SESSION['id'] == 'master')
  {
  ?>
  <input type="button" style= "font-size:1em; height:29px;" value="수정" onclick="location.href='/board/team-/umin_write_mod.php?no=<?=$no?>'">
  <input type="button" style= "font-size:1em; height:29px;" value="삭제" onclick="location.href='/board/team-/umin_write_del.php?no=<?=$no?>'">
</div>

<?php
}
else if($arr['writer'] != 'master')
{
  ?>
  <input type="button" style= "font-size:1em; height:29px;" value="신고" onclick="location.href='/board/team-/umin_write_sign.php?no=<?=$no?>'">
  <?php
}
echo "<br>";

if($_SESSION['id'] == 'master' and $arr['sign'] == 1 )
{
  $sql = "SELECT * FROM USER where id = 'master'";
  $result = MYSQLI_QUERY($conn, $sql);
  $arr = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  if($arr['admin'] == 1)
  {
    echo "<table border='1' width='100%'>";
    echo "<tr><th colspan='2'>신고글</th></tr>";
    $sql = "SELECT * FROM sign where board_name = 'board' and board_no = {$no}";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    $arr = mysqli_fetch_assoc($result);


    echo "<tr><th style='width:30%'>작성자</th><td>{$arr['writer']}</td></tr>";
    echo "<tr><th>작성일</th><td>{$arr['date']}</td></tr>";
    echo "<tr><th>신고사유</th><td>{$arr['subject']}</td></tr>";
    echo "<tr><th colspan='2'>신고내용</th></tr>";
    echo "<tr><td colspan='2'>{$arr['content']}</td></tr>";
    echo "</table>";

  }
}
 ?>




<br>
<table border="1" width="100%" style="font-weight:bold">
  <form method="POST" action="/20170822/umin_reply_proc.php">
  <tr>
    <input type="hidden" name="no" value="<?=$no?>">
    <td><font size="4">작성자</font><input type="text" name="writer" size="9" value="<?=$_SESSION['id']?>"></td>
    <td><textarea style='width:100%' cols="100" rows="5" name="content"></textarea></td>
    <td><input type="submit" value="댓글등록"></td>
  </tr>
</form>
</table>
<br>
<table border="1" width="100%" style="font-weight:bold">

  <?php
  $sql = "SELECT * FROM reply WHERE board_no = {$no} AND board_name = 'board'";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
  $arr = mysqli_fetch_all($result,MYSQLI_ASSOC);
  mysqli_free_result($result);
  ?>


  <div><font size="5">댓글 내용</font></div>

<?php
  for($i=0; $i<$rows; $i++)
  {
?>  <form method='POST' action=''>
    <input type='hidden' name='board_no' value='<?=$no?>'>
    <input type='hidden' name='no' value='<?=$arr[$i]['no']?>'>
    <th width="10%">작성자</th><th width="60%">내용</th><th width="20%">작성일시</th>

    <th width="10%" rowspan="2">

    <?php
    if($_SESSION['id'] == $arr[$i]['writer'] or $_SESSION['id'] == 'master')
    {

    ?>
    <input type='submit' formaction="/board/team-/umin_reply_mod.php"  value="댓글수정">
    <input type='submit' formaction="/board/team-/umin_reply_del.php"  value="댓글삭제">
    <?php
    }
    else
    {
      ?>
     <input type='submit' formaction="/board/team-/umin_reply_sign.php" value="신고">
     <?php
    }

    ?>
    <!--
      <input type="button" value="댓글수정" onclick="location.href='/20170822/umin_reply_mod.php?no=<$arr[$i]['no']?>'">
    <input type="button" value="댓글삭제" onclick="location.href='/20170822/umin_reply_del.php?no=<$arr[$i]['no']?>'"></th>
  -->
  <tr><td><?=$arr[$i]['writer']?></td><td><?=$arr[$i]['content']?></td><td><?=$arr[$i]['date']?></td></tr>

<?php
  }

?>
</table>
<?php

  $sql = "UPDATE board SET hit = hit + 1 WHERE no = {$no}";
  $result = mysqli_query($conn,$sql);


  mysqli_close($conn);
 ?>
