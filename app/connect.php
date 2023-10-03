<?php

declare(strict_types=1);

function connect(string $dbName): object
{
    $dbPath = __DIR__ . '/db/' . $dbName;
    $db = "sqlite:$dbPath";

    try {
        $db = new PDO($db);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Failed to connect to the database";
        throw $e;
    }
    return $db;
}
