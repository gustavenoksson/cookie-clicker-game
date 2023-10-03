<?php

declare(strict_types=1);

session_start();

require __DIR__ . "/../connect.php";

$loginError = "";

if (isset($_POST["uname"], $_POST["password"])) {
    $userName = trim(htmlspecialchars($_POST["uname"]));
    $password = trim(htmlspecialchars($_POST["password"]));
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
}

$dbh = connect("users.db");

$query = ("SELECT * FROM users WHERE user_name = :user_name");

try {
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(":user_name", $userName);
    $stmt->execute();
    $user = $stmt->fetch();
} catch (PDOException $e) {
    echo "Something went wrong: " . $e->getMessage();
    exit();
}

if ($userName === $user["user_name"] && password_verify($password, $user["password"])) {
    $_SESSION["uname"] = $userName;
    header("Location:../../game.php");
    exit();
} else {
    $loginError = "Please input the right user name and password!";
}

if (!empty($loginError)) {
    $_SESSION["login_error"] = $loginError;
    header("Location:../../index.php");
    exit();
}
