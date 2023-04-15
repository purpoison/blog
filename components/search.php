<link href="/../css/style.css" rel="stylesheet">
<div class="container">
    <?php require_once __DIR__.'/header.php';?>
</div>
<div class="container">
        <?php require_once __DIR__.'/../searching.php' ?>
    </div>
</div>
</div>
<script>
       let word =  <?=json_encode($searchWords)?>;
        let elements = document.querySelectorAll('.search-item p, .search-item span, .search-item h5');
  
       let upper = word[0].toUpperCase() + word.slice(1);
       elements.forEach(e =>{
       let text = e.textContent;

        if(text.includes(word)){
           addSpan(e, word);
        }else if(text.includes(upper)){
            addSpan(e, upper);
        }

       })

       function addSpan(element, word){
           let eText = element.textContent;
            element.innerHTML = eText.replace(word, `<span class='searchingWord'>${word}</span>`);
       }
       
</script>