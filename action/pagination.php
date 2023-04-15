<?php
    require_once __DIR__.'../../const.php';

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

    $sql = "SELECT COUNT(*) AS total FROM posts";
    $sth = $dbh->query($sql, PDO::FETCH_ASSOC);
    $length = $sth->fetch()['total'];
    $total_page = ceil($length / LIMIT);
    
    echo "<div class='pagination-wrap'>";
    if (isset($_GET['page']) && intval($_GET['page']) > 1){
        $page = intval($_GET['page']) - 1;
        echo "<a href='index.php?page={$page}' class='pagination-btn'>Prev</a>";
    }

    for($btn = 1; $btn<=$total_page; $btn++){
        echo "<a href='index.php?page={$btn}' class='pagination-btn' id='{$btn}'>$btn</a>";
    }

    if (isset($_GET['page']) && intval($_GET['page']) < $total_page){
        $page = intval($_GET['page']) + 1;
        echo "<a href='index.php?page={$page}' class='pagination-btn'>Next</a>";
    }
    echo "</div>";

$dbh = null;
$sth = null;
