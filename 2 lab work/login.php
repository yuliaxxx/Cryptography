<!-- Форма авторизации -->
<?php 
$title="Форма авторизации"; // название формы
require __DIR__ . '/header.php'; // подключаем шапку проекта
require "db.php"; // подключаем файл для соединения с БД
?>

<div class="container mt-4">
		<div class="row">
			<div class="col">
		<!-- Форма авторизации -->
		<h2>Форма авторизации</h2>
		<form action="login.php" method="post">
			<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" required><br>
			<input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль" required><br>
			<button class="btn btn-success" name="do_login" type="submit">Авторизоваться</button>
		</form>
		<br>
		<p>Вернуться на <a href="index.php" >главную</a>.</p>
			</div>
		</div>
	</div>

<?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->

<?php
$data = $_POST; //переданные данные с формы

// Пользователь нажимает на кнопку "Авторизоваться" и код начинает выполняться
if(isset($data['do_login'])) { 

 // Создаем массив для сбора ошибок
 $errors = array();

 // Проводим поиск пользователей в таблице users
 $user = R::findOne('users', 'login = ?', array($data['login']));

 if($user) {

 	// Если логин существует, тогда проверяем пароль
 	if(md5($data['password']) == $user->password) { //если пароль введен верно, то проверяем срок действия пароля 
 		if (strtotime((date("Y-m-d"))) < strtotime($user->period) || strtotime((date("Y-m-d"))) == strtotime($user->period)) {
 			// Все верно, пускаем пользователя
 			$_SESSION['logged_user'] = $user;
 		
 		// Редирект на главную страницу
            header('Location: index.php');
 		}
 		else {
 			$errors[] = 'Срок действия пароля истек!';
 		}
 	}

 		
 	 else {
    
    $errors[] = 'Пароль неверно введен!';

 	}

 } else {
 	$errors[] = 'Пользователь с таким логином не найден!';
 }

if(!empty($errors)) {

		echo '<div align = "center" style="color: red; ">' . array_shift($errors). '</div><hr>';

	}

}
?>