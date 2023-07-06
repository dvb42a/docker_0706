function keywordChanged()
{

    let editBtn = document.querySelectorAll('.edit-btn');

    // 編輯關鍵字
    editBtn.forEach(btn => {
        btn.addEventListener('click', (e) => {
            let keywordBtn = e.target.parentElement;
            let keywordDelBtn = keywordBtn.querySelector('.del-Btn');
            let keywordSaveBtn = keywordBtn.querySelector('.save-Btn');
            let keywordCancelBtn = keywordBtn.querySelector('.cancel-Btn');

            // save btn
            keywordDelBtn.classList.add('hide');
            keywordSaveBtn.classList.remove('hide');
            let keywordEl = keywordBtn.parentElement;
            let keywordInput = keywordEl.querySelector('input');
            let oldValue = keywordInput.value;

            // cancel btn
            keywordCancelBtn.classList.remove('hide');
            e.target.classList.add('hide');

            // change input status
            keywordInput.classList.remove('is-static');
            keywordInput.readOnly = false;

            // 保存修改
            keywordSaveBtn.addEventListener('click', () => {
                keywordInput.classList.add('is-static');
                keywordInput.readOnly = true;
                e.target.classList.remove('hide');
                keywordDelBtn.classList.remove('hide');
                keywordSaveBtn.classList.add('hide');
                keywordCancelBtn.classList.add('hide');
            });

            // 取消修改
            keywordCancelBtn.addEventListener('click', () => {
                keywordInput.classList.add('is-static');
                keywordInput.value = oldValue;
                keywordInput.readOnly = true;
                e.target.classList.remove('hide');
                keywordDelBtn.classList.remove('hide');
                keywordSaveBtn.classList.add('hide');
                keywordCancelBtn.classList.add('hide');
            });


        });
    });
}
