<?php
 date_default_timezone_set("Asia/Seoul");
 $date = date('Y-m-d H:i:s' , strtotime("- 90day"));
	session_start();

	$host ="127.0.0.1";
	$id = "root";
	$password = "1234";
	$db = "umin";

	$conn = mysqli_connect ($host, $id, $password, $db);


	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$password = mysqli_real_escape_string($conn, $_POST['pass']);

	$sql = "select * from user where id = '{$id}' and pass = sha2('{$password}' , 0)";
	$result = mysqli_query($conn, $sql);

	
	if(!$result)
	{
		echo "<script>
				alert('데이터를 가져오는데 실패했습니다.');
				location.href='javascript:history.back()';
				</script>";
		exit;
	}
	else
	{
		$row = mysqli_num_rows($result);
		$arr = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		if($id == '' or $password =='')
		{
			echo "<script>
					alert('ID 혹은 PASSWORD를 입력하지 않았습니다.');
					location.href='javascript:history.back()';
					</script>";


			mysqli_close($conn);
			exit;
		}
		//print_r($row);

		if($row>0)
		{
			if($arr['active'] == 1)
			{
				$_SESSION['id'] = $arr['id'];
				$_SESSION['host'] = 'menu';

				date_default_timezone_set("Asia/Seoul");
				$login_time = date('Y-m-d H:i:s' , time());
				$sql_login = "update user set last_login = '{$login_time}' where id = '{$id}'";
				$result_login = mysqli_query($conn, $sql_login);

				echo "<script>
						alert('로그인 되었습니다.');
						location.href='/board/team-/free_menu.php?page=1';
						</script>";

				mysqli_close($conn);
				exit;
			}
			else
			{
				echo "<script>
					alert('휴면 계정입니다 계정 활성화를 하세요');
					location.href='/board/team-/umin_active.php?id={$id}';
					</script>"; // 데이터 GET방식으로 id값 전달

				mysqli_close($conn);
			}
		}
		else
		{
			echo "<script>
					alert('ID나 PASSWORD가 틀렸습니다.');
					location.href='javascript:history.back()';
					</script>";

			mysqli_close($conn);
			exit;
		}
	}

?>
