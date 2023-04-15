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
        <?php require_once __DIR__.'/components/header.php'?>
    </div>
    <div class="container">
        <div class="flex-box">    
            <?php require_once __DIR__.'/components/posts.php'?>
        </div>
        <?php require_once __DIR__.'/components/pagination.php'?>
    </div>
    <script src="/script/script.js"></script>
</body>
</html>