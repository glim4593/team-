<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8"/>
	<script src="http://code.jquery.com/jquery-3.2.1.js"></script>
</head>
<body>

<?php

	if(!isset($_POST['id']) or !isset($_POST['pass']))
	{
?>
	<center>
		<table border="1">
			<form method="POST" action="/board/team-/umin_index2.php">
				<tr>
				<td>ID</td>
				<td>
					<input type="hidden" name="id_confirm" value="0">
					<input type="text" name="id" placeholder="필수입력란입니다.">
					<input type="button" name="id_check" value="ID 중복체크">
				</td>
				</tr>
				<tr>
					<td>ID 중복확인</td>
					<td><div class="id_checking"></div></td>
				</tr>
				<tr>
					<td>PASSWORD</td>
				<td><input type="text" name="pass" placeholder="필수입력란입니다."></td>
				</tr>
				<tr>
					<td>이름</td>
					<td><input type="text" name="name" placeholder="필수입력란입니다."></td>
				</tr>
				<tr>
					<td>e-mail</td>
					<td><input type="text" name="email" placeholder="필수입력란입니다."></td>
				</tr>
				<tr>
					<td>
					<input type="submit" value="회원가입">
					</td>
				</tr>
			</form>
		</table>
	</center>
<?php
	}
	else
	{

		$host ="127.0.0.1";
		$id = "root";
		$password = "1234";
		$db = "umin";

		$conn = mysqli_connect ($host, $id, $password, $db);

		if($_POST['id_confirm'] == 0)
		{
			echo "<script>
					alert('ID 중복체크 확인을 하세요');
					location.href='/board/team-/umin_index2.php';
					</script>";
			exit;
		}

		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$password = mysqli_real_escape_string($conn, $_POST['pass']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);

		$sql = "SELECT id, email from user where id = '{$id}' or email = '{$email}'";


		$result = mysqli_query($conn, $sql);
		$arr = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		if($_POST['id'] == '' or $_POST['pass'] == '' or $_POST['name'] == '' or $_POST['email'] == '')
		{

		  mysqli_close($conn);
			echo "<script>
						alert('회원정보가 부족합니다..');
						location.href='/board/team-/umin_index2.php';
						</script>";
		}
		else
		{

			$sql = "insert into user (id, pass, name, email) values ('{$id}', sha2('{$password}', 0), '{$name}', '{$email}')";
			$result = mysqli_query($conn, $sql);

			if($result)
			{

			  mysqli_close($conn);
				echo "<script>
						alert('회원 가입이 되었습니다.');
						location.href='/board/team-/free_menu.php?page=1';
						</script>";
			}
			else
			{

			  mysqli_close($conn);
				echo "<script>
						alert('회원 가입에 실패했습니다.');
						location.href='/board/team-/umin_index2.php';
						</script>";

			}
		}
	}
?>

<script>


  function call_func(data)
  {
    if(data == -1)
    {
      data = "ID가 입력되지 않았습니다.";
      color = "black";
    }
    else if(data == 1)
    {
      data = "사용중인 ID 입니다.";
      color = "red";
    }
    else if(data == 0)
    {
			$("input[name='id_confirm']").val(1);

			data = "사용가능한 ID 입니다.";
			color = "blue";		

    }
	else
	{
		data = "id 중복 검사에 실패 하였습니다."
		color = "red";
	}
		$(".id_checking").text(data);
		$(".id_checking").css({"color":color});
  };

  function ajax_func()
  {
    id = $("input[name='id']").val();
    $.ajax({
      type: "POST",
      url: "/board/team-/umin_id_check.php",
      data: {id:id},
      success: call_func
    });
  };

  $("input[name='id_check']").click(ajax_func);

</script>

</body>
</html>
