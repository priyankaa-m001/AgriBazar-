<?php
// This file handles both signup and login. The forms are in register.php and indexx.php,
// but they both send their data here, so I kept the checking and saving in one place.
// I used $pdoAuth here because login and signup use the accounts database ("farmer"),
// not the shop database. I used $errors as an array so I can send all the mistakes
// back to the form page together.
require_once 'config/auth_db.php'; // provides $pdoAuth (was dbConnect.php, accounts DB)

session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        $_SESSION['errors'] = ['csrf' => 'Your session expired, please try again.'];
        header('Location: register.php');
        exit();
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $name=$_POST['name'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    // I used $created_at here because I want to know when a user made their account.
    $created_at = date('Y-m-d H:i:s');


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
      
    }
    if(empty($name)){
        $errors['name']='Name is required';
    }
    if (strlen($password) < 8 ) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }

    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    $stmt = $pdoAuth->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        $errors['user_exist'] = 'Email is already registered';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: register.php');
        exit();
    }

    // I used $hashedPassword here because I never save the real password in the database.
    // password_hash makes a safe hash, and later I check it with password_verify.
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdoAuth->prepare("INSERT INTO users (email, password,name,created_at) VALUES (:email, :password, :name, :created_at)");
    $stmt->execute(['email' => $email, 'password' => $hashedPassword, 'name'=>$name,'created_at'=>$created_at]);

    header('Location: index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        $_SESSION['errors'] = ['csrf' => 'Your session expired, please try again.'];
        header('Location: indexx.php');
        exit();
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (empty($password)) {
        $errors['password'] = 'Password cannot be empty';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: indexx.php');
        exit();
    }

    $stmt = $pdoAuth->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // I used session_regenerate_id here so the session id changes after login.
        // I used $_SESSION['user'] here because home.php needs to know who is logged in.
        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => $user['ID'],
            'email' => $user['email'],
            'name'=>$user['name'],
            'created_at' => $user['created_at']
        ];

        header('Location: home.php');
        exit();
    } else {
        $errors['login'] = 'Invalid email or password';
        $_SESSION['errors'] = $errors;
        header('Location: indexx.php');
        exit();
    }
}