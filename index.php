<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <header class="header d-flex">
            <nav class="menu">
                <ul>
                    <li class="menu-item"><a href="#" class="menu-link active">Home</a></li>
                    <li class="menu-item"><a href="#" class="menu-link">About</a></li>
                    <li class="menu-item"><a href="#" class="menu-link">Contact Us</a></li>
                </ul>
            </nav>
            <div class="form-wrap d-flex">
                <form  role="search" action="search.php" method="POST">
                    <input type="search" name="search" placeholder="Search" >
                    <input class="search-btn" type="submit" value="">
                </form>
                <button class="create-btn">Create post</button>
            </div>
        </header>
        <div class="flex-box">    
            <?php require_once __DIR__.'/show.php' ?>
        </div>
    </div>
    <div class="pagination-wrap">
        <a href="index.php?page=-9" class="pagination-btn">prev</a>
        <a href="index.php?page=-9" class="pagination-btn">next</a>
    </div>
    </div>
</body>
</html>