<?php

	session_start();

	$host = "127.0.0.1";
	$id = "root";
	$password = "1234";
	$db = "umin";

	$conn = mysqli_connect($host, $id, $password, $db);


	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sql = "select * from user where id = '{$id}' and pass = sha2('{$password}' , 0)";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_num_rows($result);
	$arr = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
	if($password == '')
	{
		echo "<script>
				alert('PASSWORD를 입력하세요');
				location.href='javascript:history.back()';
				</script>";
		mysqli_close($conn);
		exit;
	}

	if($row>0)
	{
		$_SESSION['id'] = $arr['id'];



		$login_time = date('Y-m-d H:i:s' , time());
		$sql_login = "update user set last_login = '{$login_time}' , active = 1 where id = '{$id}'";
		$result_login = mysqli_query($conn, $sql_login);

		echo "<script>
				alert('계정이 활성화 되었습니다');
				location.href='/board/team-/free_menu.php?page=1';
				</script>";

			  mysqli_close($conn);
		exit;
	}
	else
	{
		echo "<script>
				alert('계정 활성화 실패');
				location.href='javascript:history.back()';
				</script>";

			  mysqli_close($conn);

		exit;
	}

?>
