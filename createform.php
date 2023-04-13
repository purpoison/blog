<?php require_once __DIR__.'/create.php';?>
<link href="css/style.css" rel="stylesheet">
<div class="container create-container">
    <form action="/create.php" method="POST">
        <h2>Create a new article!</h2>
        <div class="flex-box dropbox-wrap">
            <div class="dropbox-item">
                <label for="status">Set a post status<sup>*</sup></label>
                <br>
                <select name="status">
                    <?php
                        $statuses = ['published', 'draft', 'deleted'];
                        foreach ($statuses as $status):?>
                    <option value='<?= $status?>'><?= $status?></option>";
                    <?php endforeach;?>
                </select>
                <p><i><small>Select a post status, which was assigned to the post</small></i></p>
            </div>
            <div class="dropbox-item">
                <label for="author">Select a author of the post<sup>*</sup></label>
                <br>
                <select name="author" id="author">
                    <?php
                        $authors = getAuthorsList();
                        foreach ($authors as $author):?>
                        <option value='<?= $author['id'] ?>'><?= $author['name'] ?> </option>;
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div>
            <label for="url">Article Image URL<sup>*</sup></label>
            <br>
            <input type="text" name="url">
            <p><i><small>For example: https://img.example.com/128</small></i></p>
            
            <label for="title">Article Title<sup>*</sup></label>
            <br>
            <input type="text" name="title">
            <p><i><small>Put a post title there. Max 255 characters.</small></i></p>
            
            <label for="body">Article Body<sup>*</sup></label>
            <br>
            <input type="text" name="body">
            <p><i><small>Put the post text there..</small></i></p>
        </div>
        <div class="center">
            <button type="submit" class="create-btn" name="create">Create Article</button>
        </div>
        <br>
    </form>
</div>