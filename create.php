<?php 
    require_once __DIR__.'/functions.php';

    if (isset($_POST['create'])){
        $author_id = $_POST['author'];
        $status = $_POST['status'];
        $title = $_POST['title'];
        $body = $_POST['body'];
        $img_url = $_POST['url'];
        $date = date('Y-m-d H:i:s');
    
        $dbh = connectToDatabase();
        $sql = "INSERT INTO posts (author_id, status, title, body, img_url, date) VALUES (:author_id, :status, :title, :body, :img_url, :date);";
    
    try {
    
        $sth = $dbh->prepare($sql);
    
        $sth->bindParam('author_id', $author_id, PDO::PARAM_INT); 
        $sth->bindParam('status', $status, PDO::PARAM_STR);
        $sth->bindParam('title', $title, PDO::PARAM_STR);
        $sth->bindParam('body', $body, PDO::PARAM_STR);
        $sth->bindParam('img_url', $img_url, PDO::PARAM_STR);
        $sth->bindParam('date', $date, PDO::PARAM_STR);
    
        $created = $sth->execute();
    } catch (PDOException $e) {
        die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}".PHP_EOL);
        exit;
    }
    
    $dbh = null;
    $sth = null;
    
    header('Location: /index.php');
    }