<html>
<head>
	<style>
	table tr{
		cursor: pointer;
	}






	</style>
</head>
<body>



<?php
session_start();
?>


<?php
	if(!isset($_SESSION['host']))
	{
?>
		<form method="POST" action="/board/team-/umin_index_login.php">
			<center>
				<table border="1">
					<tr>
						<td>ID</td>
						<td>
							<input type="text" name="id">
						</td>
					</tr>
					<tr>
						<td>PASSWORD</td>
						<td>
							<input type="text" name="pass">
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;">
							<input type="submit" value="로그인">
							<input type="button" onclick="location.href='/board/team-/umin_index2.php'" value="회원가입">
						</td>
					</tr>
				</table>
			</center>
		</form>
<?php

		exit;
	}
$and = "&";
$_SESSION['host'] = 'menu';

?>

 </form>
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

$page_per = 10;
if(isset($_GET['page']))
{
  $page = ($_GET['page'] - 1) * $page_per;
}
else
{
  $page =  0;
}
$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');


if(isset($_POST['search']) and isset($_POST['search_text']))
{
$search = mysqli_real_escape_string($conn, $_POST['search']);
$search_text = mysqli_real_escape_string($conn, $_POST['search_text']);
$sql = "SELECT * from board where {$search}
LIKE '%{$search_text}%' ORDER BY no desc limit {$page}, {$page_per}";
$result = mysqli_query($conn, $sql);
//print_r($result);

}
else
{
  $sql = "SELECT * from board ORDER BY no desc
   limit {$page}, {$page_per} ";
  $result = mysqli_query($conn, $sql);

}

$rows = @mysqli_num_rows($result);
$arr = @mysqli_fetch_all($result, MYSQLI_ASSOC);
@mysqli_free_result($result);

?>

<table border='1' width='100%' align='center'>
<th>번호</th>
<th>제목</th>
<th>작성자</th>
<th>작성일</th>
<th>조회수</th>

<?php
date_default_timezone_set("Asia/Seoul");
$date = date("Y-m-d H:i:s", strtotime("-1 day"));
//print_r($date);
if($rows)
{

  	for($i=0;$i<$rows;$i++)
  	{
				if($_SESSION['id'] == 'master' and $arr[$i]['sign'] == 1)
			{

				echo "<tr onclick=\"location.href='/board/team-/umin_read.php?no={$arr[$i]['no']}'\">";

    		echo "<td align='center' style='color:red'; width:'10%'>{$arr[$i]['no']}</td>";
				if($date<$arr[$i]['date'])
				{
    		echo "<td align='center' style='color:red'; width:'50%'>{$arr[$i]['subject']}&nbsp[{$arr[$i]['reply']}]
				&nbsp<a style='color:red'>New</a></td>";
				}
				else
				{
				echo "<td align='center' style='color:red'; width:'50%'>{$arr[$i]['subject']}
				&nbsp[{$arr[$i]['reply']}]</td>";
				}

    	echo "<td align='center' style='color:red'; width:'10%'>{$arr[$i]['writer']}</td>";
    	echo "<td align='center' style='color:red'; width:'20%'>{$arr[$i]['date']}</td>";
    	echo "<td align='center' style='color:red'; width:'10%'>{$arr[$i]['hit']}</td>";
    	echo "</tr>";

  		}
			else
			{
				echo "<tr onclick=\"location.href='/board/team-/umin_read.php?no={$arr[$i]['no']}'\">";

 			 	echo "<td align='center' width='10%'>{$arr[$i]['no']}</td>";
 			 	if($date<$arr[$i]['date'])
 			 	{
 			 	echo "<td align='center' width='50%'>{$arr[$i]['subject']}&nbsp[{$arr[$i]['reply']}]
 			 	&nbsp<a style='color:red'>New</a></td>";
 			 	}
 			 	else
 			 	{
 			 	echo "<td align='center' width='50%'>{$arr[$i]['subject']}
 			 	&nbsp[{$arr[$i]['reply']}]</td>";
 			 	}

 		 	echo "<td align='center' width='10%'>{$arr[$i]['writer']}</td>";
 		 	echo "<td align='center' width='20%'>{$arr[$i]['date']}</td>";
 		 	echo "<td align='center' width='10%'>{$arr[$i]['hit']}</td>";
 		 	echo "</tr>";


			}
		}
}
else
{
	echo "<tr align='center'>
				<td colspan='5'>데이터가 없거나, 데이터를 찾을 수 없습니다. </td>
				<tr>
				</table>";
?>
<div align="center">
<form method='POST' action='/board/team-/free_menu.php?page=1'>
	<br>
	  <!--나중에 button으로 바꿀 수도 있으니 참고 -->
	  <select name='search'>
	  <option value='subject'>제목</option>
	  <option value='writer'>작성자</option>
	  <option value='content'>내용</option>
	  </select>
	  <input type='text' name='search_text'>
	  <input type='submit' value='검색'>



	<input type='button' onclick="location.href='/board/team-/umin_write.php'" value='글쓰기'>
	</form>
	  </div>
	<?php
	mysqli_close($conn);
	?>
	</body>
	</html>
<?php

exit;
}


?>

</table>
<div align="center">
<form method='POST' action='/board/team-/free_menu.php?page=1'>

<?php

if(isset($_GET['page']))
{
	if(isset($search))
	{
  $sql = "SELECT no from board where {$search}
  LIKE '%{$search_text}%'";
	}
	else
	{
		$sql = "SELECT no from board";
	}
}
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);
mysqli_free_result($result);

$page_num = ceil($rows/$page_per);

for($i = 1; $i <= $page_num ; $i++)
{
  echo "<a href='/board/team-/free_menu.php?page={$i}'>{$i}</a>";
}
 ?>
<br>
  <!--나중에 button으로 바꿀 수도 있으니 참고 -->
  <select name='search'>
  <option value='subject'>제목</option>
  <option value='writer'>작성자</option>
  <option value='content'>내용</option>
  </select>
  <input type='text' name='search_text'>
  <input type='submit' value='검색'>



<input type='button' onclick="location.href='/board/team-/umin_write.php'" value='글쓰기'>
</form>
  </div>
<?php







mysqli_close($conn);


?>

</body>
</html>
