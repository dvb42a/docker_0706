

let contentChapter = document.querySelectorAll('.content-chapter');
// console.log(contentChapter);

contentChapter.forEach(btn => {
    btn.addEventListener('click', (e) => {
        // console.log(e.target);
        let list = e.target.parentElement;
        let ul = list.parentElement;
        let keywordList = ul.querySelector('.chapter-list');
        // console.log(keywordList);

        // switch icon
        var fileIcon = e.target.querySelector('.file-icon');
        if (fileIcon.classList.contains('fa-folder-open')) {
            fileIcon.classList.replace('fa-folder-open', 'fa-folder');
            keywordList.classList.add('hidden');
        } else {
            fileIcon.classList.replace('fa-folder', 'fa-folder-open');
            keywordList.classList.remove('hidden');
        }
    })
})

