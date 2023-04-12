<?php

define('LIMIT', 9);

$offset = isset($_GET['page']) ? intval($_GET['page']) : 0; 

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

$sql = "SELECT posts.*, authors.name, authors.email FROM posts JOIN authors ON posts.author_id = authors.id ORDER BY posts.date DESC LIMIT  :offset, :limit;";

try {
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':limit', LIMIT, PDO::PARAM_INT);
    $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
    $sth->execute();
} catch (PDOException $e) {
    die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}".PHP_EOL);
    exit;
}

if ($sth->rowCount()) {
    $allRows = $sth->fetchAll(PDO::FETCH_OBJ);
    foreach ($allRows as $post) {
        $date = explode(' ', $post->date);
        echo "
        <div class='card'>
      <img src='{$post->img_url}' class='card-img' alt='{$post->name}' style='height: 250px; object-fit: cover '>
      <div class='card-title'>
      <h5>{$post->title}</h5>
      </div>
      <div class='card-body'>
        <div class='sub-title'>
        <span>{$post->name}</span> <span style='color: grey'>{$date[0]}</span>
         </div>
        <p class='card-text'>{$post->body}</p>
        </div>
        </div>";
    }
} else {
    die('Empty set.');
}

$dbh = null;
$sth = null;
