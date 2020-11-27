<?php

/*
    Parameters:
            string - $email
    Description: поиск пользователя по эл. адресу

    Return value: array
*/
function get_user_by_email($email)
{
    $pdo = new PDO("mysql:host=localhost; dbname=project_registration", "root", "root");
    $sql = "SELECT * FROM new_user WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}


/*
    Parameters:
            string - $email
            string - $password
    Description: Добавить пользователя в БД

    Return value: int (user_id)
*/
function add_user ($email, $password) {
    $pdo = new PDO("mysql:host=localhost; dbname=project_registration", "root", "root");
    $sql = "INSERT INTO new_user (email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'email' => $email,
        'password' => $password,
//        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    return $pdo->lastInsertId();

}


/*
    Parameters:
            string - $email
            string - $password
    Description: авторизировать пользователя

    Return value: boolean
*/
function login ($email, $password) {
    $pdo = new PDO("mysql:host=localhost; dbname=project_registration", "root", "root");
    $sql = "SELECT * FROM new_user WHERE email=:email AND password=:password";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $email,
        "password" => $password,
    ]);
    $login = $statement->fetch(PDO::FETCH_ASSOC);

    return $login;

}


/*
    Parameters:
            string - $name (ключ)
            string - $message (значение, текст сообщения)

    Description: подготовить флеш сообщение

    Return value: null
*/
function set_flash_message ($name, $message) {
    $_SESSION[$name] = $message;
}


/*
    Parameters:
            string - $name (ключ)

    Description: вывести флеш сообщение

    Return value: null
*/
function display_flash_message ($name) {
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}


/*
    Parameters:
            string - $patch (путь)

    Description: перенаправить пользователя

    Return value: null
*/
function redirect_to ($patch) {
    header("Location: {$patch}");
    exit;
}