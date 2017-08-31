<?php

	$host = "127.0.0.1";
	$id = "root";
	$password = "1234";
	$db = "umin";

	$conn = mysqli_connect($host, $id, $password, $db);

	if($_POST['id'] == '')
	{
		echo -1;
		exit;
	}

	$id = mysqli_real_escape_string($conn, $_POST['id']);

	  $sql = "select id from use where id = '{$id}'";
	  $result = mysqli_query($conn, $sql);
	  $rows = mysqli_num_rows($result);

	  echo $rows;
		mysqli_free_result($result);
	  mysqli_close($conn);

?>
