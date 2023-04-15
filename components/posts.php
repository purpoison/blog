<?php 
    require_once __DIR__.'/../const.php';
    require_once __DIR__.'/../functions.php';
    $offset = isset($_GET['page']) ? (intval($_GET['page']) - 1) * LIMIT : 0; 
    $dbh = connectToDatabase();
    $sth = getPosts($dbh, $offset, LIMIT);

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