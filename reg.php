<?php 
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
	$secondName = filter_var(trim($_POST['secondName']), FILTER_SANITIZE_STRING);
	$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING); // Удаляет все лишнее и записываем значение в переменную //$login
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING); 
	$passwordRepeat = filter_var(trim($_POST['passwordRepeat']), FILTER_SANITIZE_STRING);

	$mysql = new mysqli('localhost', 'root', '', 'sqlean');
	$response;

	$result = $mysql->query("SELECT login FROM users WHERE login = '$login'");
	$user = $result->fetch_assoc(); // Конвертируем в массив

	if(!empty($user)){
	    $response = 0;
	}
	else if($password != $passwordRepeat) {
		$response = 2;
	}
	else if($name!=NULL && $surname!=NULL && $secondName!=NULL && $phone!=NULL && $login!=NULL && $password!=NULL) 
	{
	$mysql->query("INSERT INTO users (name, surname, second_name, phone, login, password, role)
	    VALUES('$name', '$surname', '$secondName', '$phone', '$login', '$password', 'user')");
	$response = 1;
	$mysql->close();
	}
	echo json_encode($response);
?>