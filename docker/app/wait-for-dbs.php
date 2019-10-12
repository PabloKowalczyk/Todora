<?php

declare(strict_types=1);

$waitForDb = static function (
    string $host,
    string $dbName
): bool {
    $retries = 20;
    while ($retries > 0) {
        try {
            new \PDO(
                "pgsql:host={$host};dbname={$dbName}",
                $dbName,
                $dbName
            );

            echo "DB '{$dbName}' is up and running." . PHP_EOL;

            return true;
        } catch (\PDOException $e) {
            echo "Unable to connect to db '{$host}', error: {$e->getMessage()}, retrying..." . PHP_EOL;

            --$retries;

            \sleep(1);
        }
    }

    return false;
};

$isDevDbUp = $waitForDb('postgres', 'todora_dev');
$isTestDbUp = $waitForDb('postgres_test', 'todora_test');
$result = $isDevDbUp && $isTestDbUp
    ? 0
    : 1
;

exit($result);
