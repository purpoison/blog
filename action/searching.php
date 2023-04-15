<?php

if (isset($_POST['btn-sumit'])){
    $searchWords = $_POST['search'];

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

    $sql = "SELECT posts.*, authors.name, authors.email FROM posts JOIN authors ON posts.author_id = authors.id WHERE posts.body LIKE '%{$searchWords}%' OR posts.body LIKE '%{$searchWords}%' OR authors.name LIKE '%{$searchWords}%' ORDER BY posts.date DESC ;";

    try {
        
        $sth = $dbh->query($sql);
        
    } catch (PDOException $e) {
        die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}".PHP_EOL);
        exit;
    }

    if ($sth->rowCount()) {
        $allRows = $sth->fetchAll(PDO::FETCH_OBJ);
        echo "<h2 class='search-title'>{$searchWords}</h2> <span class='amount'>({$sth->rowCount()})</span>
        <div class='search-container'>";
        
        foreach ($allRows as $post) {
            $date = explode(' ', $post->date);
            echo "
                <div class='search-item'>
                    <h5 class='title'>{$post->title}</h5>
                    <div class='search-sub-title'>
                        <span>{$post->name}</span> <span style='color: grey'>{$date[0]}</span>
                    </div>
                    <p class='text'>
                    {$post->body}
                        <a href='#'>more</a>
                    </p>
                    <hr>
                </div>";
        }
        echo "</div>";
    } else {
        die('Empty set.');
    }

    $dbh = null;
    $sth = null;
}
