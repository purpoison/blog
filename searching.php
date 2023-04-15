<?php
require_once __DIR__.'/functions.php';  

if (isset($_POST['btn-sumit'])){
    $searchWords = $_POST['search'];

    $dbh = connectToDatabase();
    $sth = searchRezult($dbh, $searchWords);

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
                        <span class='author'>{$post->name}</span> <span style='color: grey'>{$date[0]}</span>
                    </div>
                    <p class='text'>
                    {$post->body}
                    </p>
                    <a href='#'>more</a>
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
