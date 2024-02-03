<?php
	$host="localhost";
	$user="root";
	$pass="";
	$db="sqlean";

	$mysql = new mysqli('localhost', 'root', '', 'sqlean');
	$link = mysqli_connect($host, $user, $pass, $db) or die("Ошибка " . mysqli_error($link));
	$response;

	$login=$_POST['login'];
	$password=$_POST['password'];
	$query= mysqli_query($link,"SELECT * FROM users WHERE login ='$login' and password ='$password'");
		
		
	if (mysqli_num_rows($query)==1)
	{
		$query1="SELECT role FROM users WHERE login ='$login' and password ='$password'";
		$result = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
		$a=mysqli_fetch_array($result);
		$role=$a['role'];
		if($role == "user") {
			$response = 2;
		}
	}
	else {
		$response = 0;
	}

	echo json_encode($response);
?>