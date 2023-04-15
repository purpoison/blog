document.addEventListener('DOMContentLoaded', function(){ 

    let urlString = document.location.search;
    let pageId = urlString.split('=').pop();
    let current_btn = document.getElementById(pageId);
    current_btn.classList.add('active');
    
});