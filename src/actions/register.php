<?php

require_once __DIR__ . '/../core.php';



$avatarPath = null;
$nickname = $_POST['nickname'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$passwordConfirmation = $_POST['password_confirmation'] ?? null;
$avatar = $_FILES['avatar'] ?? null;
$fon = $_FILES['fon'] ?? null;

// Выполняем валидацию полученных данных с формы

if (empty($nickname)) {
    setValidationError('nickname', 'Неверное имя');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setValidationError('email', 'Указана неправильная почта');
}

if (empty($password)) {
    setValidationError('password', 'Пароль пустой');
}

if ($password !== $passwordConfirmation) {
    setValidationError('password', 'Пароли не совпадают');
}

if (!empty($avatar)) {
    $types = ['image/jpeg', 'image/png'];

    if (!in_array($avatar['type'], $types)) {
        setValidationError('avatar', 'Изображение профиля имеет неверный тип');
    }

    if (($avatar['size'] / 1000000) >= 1) {
        setValidationError('avatar', 'Изображение должно быть меньше 1 мб');
    }
}

if (!empty($fon)) {
    if (!in_array($fon['type'], $types)) {
        setValidationError('fon', 'Фоновое изображение имеет неверный тип');
    }
    if (($fon['size'] / 1000000) >= 1) {
        setValidationError('fon', 'Фоновое изображение должно быть меньше 1 мб');
    }
}



// Если список с ошибками валидации не пустой, то производим редирект обратно на форму
if (!empty($_SESSION['validation'])) {
    setOldValue('nickname', $nickname);
    setOldValue('email', $email);
    redirect('/register.php');
}

//  Загружаем аватарку, если она была отправлена в форме

if (!empty($avatar)) {
    $avatarPath = uploadFile($avatar, 'avatar');
}

if (!empty($fon)) {
    $fonPath = uploadFile($fon, 'fon');
}



$pdo = getPDO();

$query = "INSERT INTO users (nickname, email, avatar, fon, password) VALUES (:nickname, :email, :avatar, :fon, :password)";

$params = [
    'nickname' => $nickname,
    'email' => $email,
    'avatar' => $avatarPath,
    'fon' => $fonPath,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];

$stmt = $pdo->prepare($query);

try {
    $stmt->execute($params);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/');
