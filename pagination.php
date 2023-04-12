<?php
    require_once __DIR__.'/const.php';

    $dsn = 'mysql:host=localhost;dbname=blog';
    $user = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {    
        die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}".PHP_EOL);
    }

    $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 0, 1";

    $sth = $dbh->query($sql, PDO::FETCH_ASSOC);
    $length = 0;
    if ($sth) {
        foreach ($sth as $row) {
            $length = $row['id'];
        }
    }
    $total_page = ceil($length / LIMIT);
    
    echo "<div class='pagination-wrap'>";
    for($btn = 1; $btn<=$total_page; $btn++){
        echo "<a href='index.php?page={$btn}' class='pagination-btn'>$btn</a>";
    }
    echo "</div>";

$dbh = null;
$sth = null;