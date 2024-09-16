<?php
session_start();

require_once __DIR__ . '/config.php';

/**
 * Перенаправление на указанный путь
 * @param string $path
 */
function redirect(string $path)
{
    header("Location: $path");
    die();
}

/**
 * Установка сообщения об ошибке валидации для указанного поля
 * @param string $fieldName
 * @param string $message
 */
function setValidationError(string $fieldName, string $message): void
{
    $_SESSION['validation'][$fieldName] = $message;
}

/**
 * Проверка наличия ошибки валидации для указанного поля
 * @param string $fieldName
 * @return bool
 */
function hasValidationError(string $fieldName): bool
{
    return isset($_SESSION['validation'][$fieldName]);
}

/**
 * Получение атрибута ошибки валидации для указанного поля
 * @param string $fieldName
 * @return string
 */
function validationErrorAttr(string $fieldName): string
{
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

/**
 * Получение сообщения об ошибке валидации для указанного поля
 * @param string $fieldName
 * @return string
 */
function validationErrorMessage(string $fieldName): string
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}

/**
 * Установка предыдущего значения для указанного ключа
 * @param string $key
 * @param mixed $value
 */
function setOldValue(string $key, $value): void
{
    $_SESSION['old'][$key] = $value;
}

/**
 * Получение предыдущего значения для указанного ключа
 * @param string $key
 * @return mixed
 */
function old(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

/**
 * Загрузка файла на сервер
 * @param array $file
 * @param string $prefix
 * @return string
 */
function uploadFile(array $file, string $prefix = ''): string
{
    $uploadPath = __DIR__ . '/../uploads/Users';

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = $prefix . '_' . time() . ".$ext";

    if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
        die('Ошибка при загрузке файла на сервер');
    }

    return "uploads/Users/$fileName";
}


/**
 * Установка сообщения
 * @param string $key
 * @param string $message
 */
function setMessage(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}

/**
 * Проверка наличия сообщения
 * @param string $key
 * @return bool
 */
function hasMessage(string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

/**
 * Получение сообщения
 * @param string $key
 * @return string
 */
function getMessage(string $key): string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

/**
 * Получение объекта PDO для подключения к базе данных
 * @return PDO
 */
function getPDO(): PDO
{
    try {
        return new \PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8;dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}

/**
 * Поиск пользователя по email
 * @param string $email
 * @return array|bool
 */
function findUser(string $email): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

/**
 * Получение текущего пользователя
 * @return array|false
 */
function currentUser(): array|false
{
    $pdo = getPDO();

    if (!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    // var_dump($stmt->fetch(\PDO::FETCH_ASSOC));
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

/**
 * Выход из системы
 */
function logout(): void
{
    unset($_SESSION['user']['id']);
    redirect('/');
}

/**
 * Проверка аутентификации пользователя
 */
function checkAuth(): void
{
    if (!isset($_SESSION['user']['id'])) {
        redirect('/');
    }
}

/**
 * Проверка гостевого доступа
 */
function checkGuest(): void
{
    if (isset($_SESSION['user']['id'])) {
        redirect('/home.php');
    }
}


 function countUserPosts(): int //Кол-во постов
{
    $user = currentUser();
    $pdo = getPDO();

    try {
        $userId = $user['id'];
        // Шаг 1: Подготовка запроса к базе данных
        $sql = "SELECT COUNT(*) as count FROM posts WHERE user_id = :userId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        // Шаг 2: Выполнение запроса к базе данных
        $stmt->execute();
        // Шаг 3: Получение результата
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Возвращаем количество постов
        return $result['count'];
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return 0;
}
function countFollowers(): int // Кол-во пользователей подписанных на авторизированного пользователя
{
    $user = currentUser();
    $pdo = getPDO();

    try {
        $userId = $user['id'];
        // Шаг 1: Подготовка запроса к базе данных
        $sql = "SELECT COUNT(*) as count FROM followers WHERE user_id = :userId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        // Шаг 2: Выполнение запроса к базе данных
        $stmt->execute();
        // Шаг 3: Получение результата
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Возвращаем количество подписчиков
        return $result['count'];
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return 0;
}
function countFollowing(): int//    Кол-во пользователей, на которых подписан авторизованный пользователь
{
    $user = currentUser();
    $pdo = getPDO();

    try {
        $userId = $user['id'];
        // Шаг 1: Подготовка запроса к базе данных
        $sql = "SELECT COUNT(*) as count FROM followers WHERE follower_id = :userId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        // Шаг 2: Выполнение запроса к базе данных
        $stmt->execute();
        // Шаг 3: Получение результата
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Возвращаем количество пользователей, на которых подписан авторизованный пользователь
        return $result['count'];
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return 0;
}