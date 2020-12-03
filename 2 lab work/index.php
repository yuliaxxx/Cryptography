<!-- Главная страница -->
<?php
$title="Главная страница";
require __DIR__ . '/header.php'; // 
require "db.php"; // подключаем файл для соединения с БД
?>

<div class="container mt-4">
<div class="row">
<div class="col">
<center>
<h1>Парольная аутентификация</h1>
</center><br>


<!-- Если пользователь авторизован выведет текст -->
<?php if(isset($_SESSION['logged_user'])) : ?>
	<p>Аутентификация прошла успешно!</p>
 <br>
<!-- кнопка для выхода из системы -->
<center><a href="logout.php" class="btn btn-outline-dark">Выйти</a></center>
<?php else : ?>
</div>
</div>
<!-- главная страница -->
<div class="container mt-4">
		<div class="row">
			<div class="col">
				<center>
				<a href="login.php" class="btn btn-outline-dark">Авторизация</a><br><br>
				<a href="signup.php" class="btn btn-outline-dark">Регистрация</a>
				</center>
			</div>
		</div>	
</div>
<?php endif; ?>
<?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->