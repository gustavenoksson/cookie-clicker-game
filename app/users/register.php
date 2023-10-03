<?php

declare(strict_types=1);

require __DIR__ . "/../connect.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$registerError = "";

if (isset($_POST["uname"], $_POST["password"], $_POST["confirm_password"])) {
    $userName = trim(htmlspecialchars($_POST["uname"]));
    $password = trim(htmlspecialchars($_POST["password"]));
    $confirmPassword = trim(htmlspecialchars($_POST["confirm_password"]));

    // Input validation
    if (strlen($userName) < 3) {
        $registerError = "Username must be at least 3 characters long.";
    } elseif (strlen($password) < 8) {
        $registerError = "Password must be at least 8 characters long.";
    } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $userName)) {
        $registerError = "Username can only contain letters and numbers.";
    } elseif ($password !== $confirmPassword) {
        $registerError = "Password confirmation does not match.";
    }

    if (!$registerError) {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $dbh = connect("users.db");

        // Queries
        $insertQuery = "INSERT INTO users (user_name, password) VALUES (:user_name, :password)";
        $selectQuery = "SELECT * FROM users WHERE user_name = :user_name";

        $stmt = $dbh->prepare($selectQuery);
        $stmt->bindParam(":user_name", $userName);
        $stmt->execute();
        $result = $stmt->fetchAll();

        // Check if username already exists
        if (count($result) > 0) {
            $registerError = "Sorry the user name already exists!";
        } else {
            try {
                $stmt = $dbh->prepare($insertQuery);

                $stmt->bindParam(":user_name", $userName);
                $stmt->bindParam(":password", $hashPassword);

                $stmt->execute();

                $_SESSION["uname"] = $userName;
                header("Location: ../../game.php");
                exit();
            } catch (PDOException $e) {
                $registerError = "Something went wrong: " . $e->getMessage();
            }
        }
    }
}

if (!empty($registerError)) {
    $_SESSION["register_error"] = $registerError;
    header("Location: ../../create.php");
    exit();
}
