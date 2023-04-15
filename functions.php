<?php
function connectToDatabase() {
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
    return $dbh;
}
 
function getPosts($dbh, $offset, $limit){
    $sql = "SELECT posts.*, authors.name, authors.email FROM posts JOIN authors ON posts.author_id = authors.id ORDER BY posts.date DESC LIMIT  :offset, :limit;";

try {
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
    $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
    $sth->execute();
    
} catch (PDOException $e) {
    die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}".PHP_EOL);
    exit;
}
    return $sth;

}
function totalPages($dbh, $limit){
    $sql = "SELECT COUNT(*) AS total FROM posts";
    try{
        $sth = $dbh->query($sql, PDO::FETCH_ASSOC);
        $length = $sth->fetch()['total'];
        $total_page = ceil($length / $limit);
    }catch (PDOException $e) {
        die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}".PHP_EOL);
        exit;
    }

    return $total_page;
}
function getAuthorsList($dbh){
    $sql = "SELECT id, name FROM authors ;";
    $sth = $dbh->query($sql, PDO::FETCH_ASSOC);

    $allRows = $sth->fetchAll(PDO::FETCH_ASSOC);
    $authors = [];
        foreach ($allRows as $author) {
            array_push($authors, ['id' => $author['id'],
                                'name' => $author['name']]);
        }

    $dbh = null;
    $sth = null;
    return $authors;
}
function searchRezult($dbh, $words){
    $sql = "SELECT posts.*, authors.name, authors.email FROM posts JOIN authors ON posts.author_id = authors.id WHERE posts.body LIKE '%{$words}%' OR posts.body LIKE '%{$words}%' OR authors.name LIKE '%{$words}%' ORDER BY posts.date DESC ;";

    try {
        
        $sth = $dbh->query($sql);
        
    } catch (PDOException $e) {
        die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}".PHP_EOL);
        exit;
    }
    return $sth;
}