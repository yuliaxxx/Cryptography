<?php 
$title="Форма регистрации"; // название формы
require __DIR__ . '/header.php'; // подключаем шапку проекта
require "db.php"; // подключаем файл для соединения с БД
?>

<div class="container mt-4">
		<div class="row">
			<div class="col">
		<h2>Форма регистрации</h2>
		<form action="signup.php" method="post">
			<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
			<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
			<button class="btn btn-success" name="do_signup" type="submit">Зарегистрировать</button>
		</form>
		<br>
		<p>Вернуться на <a href="index.php" >главную</a>.</p>
			</div>
		</div>
	</div>
<?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->
<?php

$data = $_POST;

// нажата кнопка "Зарегистрировать"
if(isset($data['do_signup'])) {

        
    // Создание массив для сбора ошибок
	$errors = array();

	// Проверка
	if(trim($data['login']) == '') {

		$errors[] = "Введите логин!";
	}

	if($data['password'] == '') {

		$errors[] = "Введите пароль";
	}
    // Проверка длины вводимых данных
	if(mb_strlen($data['login']) < 5 || mb_strlen($data['login']) > 90) {

	    $errors[] = "Недопустимая длина логина";

    }

    if (mb_strlen($data['password']) < 2 || mb_strlen($data['password']) > 8){
	
	    $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";

    }
	// Проверка на уникальность логина
	if(R::count('users', "login = ?", array($data['login'])) > 0) {

		$errors[] = "Пользователь с таким логином существует!";
	}

	if(empty($errors)) {

		//Ошибок нет
		// Создаем таблицу users
		$user = R::dispense('users');

        // добавляем в таблицу записи
		$user->login = $data['login'];

		// Хешируем пароль
		$user->password = md5($data['password']);

		$user->period = date("Y-m-d", strtotime("+2 days"));

		// Сохраняем таблицу
		R::store($user);
        echo '<div align = "center" style="color: red;">Регистрация прошла успешно!</div><hr>';

	} else {
                // array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
		echo '<div align = "center" style="color: red; ">' . array_shift($errors). '</div><hr>';
	}
}
?>