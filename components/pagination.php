<?php
    $dbh = connectToDatabase();
    $total_page = totalPages($dbh, LIMIT);
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