<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
</head>
<body>

<?php

	$host = "127.0.0.1";
	$id = "root";
	$password = "1234";
	$db = "umin";


	$conn = mysqli_connect($host, $id, $password, $db);
	
	if(!isset($_SESSION['id']))
	{
		echo "<script>
			alert('접근 권한이 없습니다.');
			location.href='/board/team-/free_menu.php';
		</script>";
	exit;
		
	}
	else
	{
		$id = $_SESSION['id'];	
?>

	<center>
		<form method="POST" action="/board/team-/umin_active2.php">
			<table border="1">
				<tr>
					<td>ID</td>
					<td>
						<input type="text" name="id" value="<?=$id;?>" readonly>
					</td>
				</tr>
				<tr>
					<td>PASSWORD</td>
					<td>
						<input type="text" name="password">
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;">
						<input type="submit" value="계정활성화" style="width:30%">
					</td>
				</tr>
			</table>
		</form>
	</center>
	
<?php
	}
?>
</body>
</html>
