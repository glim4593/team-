<!DOCTYPE html>
<script  src="http://code.jquery.com/jquery-3.2.1.js"></script>

<?php session_start();?>
<html>
<head>
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

  <input type='button' onclick="location.href='/20170822/free_logout.php'" value='로그아웃'>
	</div>
</form>



<form id='form' method="POST" enctype="multipart/form-data" action="/20170822/umin_write_proc.php">
<table border="0">
  <tr>
    <th>작성자</th><td><input type="text" name="writer" value='<?=$_SESSION['id']?>' readonly></td>
  </tr>
  <tr>
    <th>구분</th><td>잡담<input type="radio" name="cate" value='0' checked="checked">
                     유머<input type="radio" name="cate" value='1'>
                     게임<input type="radio" name="cate" value='2'></td>
  </tr>
  <tr>
    <th>제목</th><td><input type="text" name="subject" size="70"></td>
  </tr>
  <tr>
    <th>파일첨부</th><td><input type="file" name="ff" size="70"></td>
  </tr>
  <?php
  $conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
  $sql = 'SELECT * FROM user where admin = 1';
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
	if($_SESSION['id'] == 'master')
	{
  	if($rows)
  	{ echo "<th>등록일</th><td><input type='checkbox' name='check'>";
    	echo "<select name='year'></select>";
    	echo "<select name='month'></select>";
    	echo "<select name='day'></select>";
    	echo "<select name='hour'></select>";
    	echo "<select name='min'></select></td>";
  	}
	}
  mysqli_free_result($result);

  ?>
  <tr>
    <td colspan="2"><textarea cols="100" rows="7" name="content"></textarea></td>
  </tr>
    <tr>
    <td colspan="2" align='right'><input type="submit" value="등록"></td>
  </tr>
</table>
<!--
<input type='button' name='sum' value='등록'>
-->



</form>
</html>

<script>

function check()
{
 if($("input[name='check']").prop("checked"))
 {
   $("select").show();

 }
 else
 {
   $("select").hide();
 }

}

$("select").hide();
$("input[name='check']").click(check);


for(i = 2017; i <= 2030 ;i++)
{
  year = "<option value='"+ i +"'>"+ i +"년</option>";
  $("select[name='year']").append(year);

}

for(i = 1; i <= 12 ;i++)
{
  month = "<option value='"+ i +"'>"+ i +"월</option>";
  $("select[name='month']").append(month);
}

for(i = 1; i <= 31 ;i++)
{
  day = "<option value='"+ i +"'>"+ i +"일</option>";
  $("select[name='day']").append(day);
}

for(i = 0; i <= 23 ;i++)
{
  hour = "<option value='"+ i +"'>"+ i +"시</option>";
  $("select[name='hour']").append(hour);
}

for(i = 0; i <= 59 ;i++)
{
  min = "<option value='"+ i +"'>"+ i +"분</option>";
  $("select[name='min']").append(min);
}

/*
function complete(data)
{

  alert(data);

}


function button()
{
  writer = $("input[name='writer']").val();
  subject = $("input[name='subject']").val();
  ff = $("input[name='ff']").val();
  content = $("textarea[name='content']").val();
  year = $("select[name='yaer']").val();
  month = $("select[name='month']").val();
  day = $("select[name='day']").val();
  hour = $("select[name='hour']").val();
  min = $("select[name='min']").val();
  form = $("form")[0];
  formdata = new FormData(form);
  //new FormData(form); = form에 있는 데이터를 다 묶는 명령어
    if($("input[name='check']").prop("checked"))
  {
    //data:{writer:writer, subject:subject, ff:ff,
      // content:content, year:year, month:month, day:day, hour:hour, min:min}
    $.ajax({

      type:"POST",
      url:"/20170822/umin_reserve.php",
      data:formdata,
      contentType: false,
      processData: false,
      success: complete

    });


  }
  else
  {
    $.ajax({

      type:"POST",
      url:"/20170822/umin_write_proc.php",
      data: formdata,
      //위에서 묶은 form을 사용
      contentType: false,
      processData: false,
      //contentType, processData 를 false로 하면 file의 변수를 그대로 보낼 수 있음
      success: complete
      });
  }

}
$("input[name='sum']").click(button);
*/
</script>
<?php
mysqli_close($conn);
?>
