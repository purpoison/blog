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

       const p = document.querySelectorAll('.search-item p');
       p.forEach(e => {
        let content = e.textContent;
        cutTheString(e, 103);
       })

       const moreBtn = document.querySelectorAll('.more-btn');
       if(moreBtn){
        moreBtn.forEach(more => {
            more.addEventListener('click', el =>{
                el.preventDefault();
                let currentLink = el.target;
                let currentP = currentLink.closest('p');
                let currentSpan = currentP.firstElementChild;
                currentSpan.className = '';
                currentLink.remove();
            })
        })
       }

       function addSpan(element, word){
           let eText = element.textContent;
            element.innerHTML = eText.replace(word, `<span class='searchingWord'>${word}</span>`);
       }

       function cutTheString(elem, num){
        let content = elem.textContent;
        if (content.length >= num){
            let newContent = addHiddenClass(content, num);
            elem.innerHTML = newContent + ` <a href='#' class='more-btn'>more</a>`;;
        }
       }

       function addHiddenClass(str, num){
            let hidden = `<span class='hidden'>${str.slice(num)}</span>`;
            let newContent = str.slice(0, num) + hidden;
            return newContent;
       }
       
</script>