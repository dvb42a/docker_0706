
let addkeywordForm = document.getElementById('addkeywordForm');
let formContent = document.getElementById('add-keyword');

const addKeywordBtn = document.getElementById('addKeywordBtn');
const closeBtn = document.getElementById('closeBtn');
const addInputBtn = document.getElementById('addInputBtn');
// console.log(addInputBtn);

const limitInfo = document.getElementById('limitInfo');

// 顯示 form
function showForm() {
    addkeywordForm.classList.remove('hide');
    addKeywordBtn.classList.add('hide');

}

// 隱藏 form
function hideForm() {
    addkeywordForm.classList.add('hide');
    addKeywordBtn.classList.remove('hide');

    limitInfo.classList.add('hidden');
}

// 數量限制
addInputBtn.addEventListener('click', () => {
    let keywordInputs = addkeywordForm.querySelectorAll('input');
    // console.log(keywordInputs);

    if (keywordInputs.length - 1 >=10 ) {
        console.log('已達上限');
        limitInfo.classList.remove('hidden');

    } else {
        // console.log('add');
        addInput();
    }
})

// 新增欄位
function addInput() {

    // Create Input
    let inputContainer = document.createElement('div');
    inputContainer.classList.add('flex');
    inputContainer.classList.add('gap-2');
    inputContainer.classList.add('w-full');

    let fieldHTML =
    `
        <div class="field w-full">
            <input class="input" type="text" placeholder="輸入關鍵字" name="bp_hashtag[]" maxlength="25">
            <p class="help">長度限制 25 中/英文字</p>
        </div>
        <button class="button secondary-btn h-9" type="button">
            <i class="fa-solid fa-xmark"></i>
        </button>
    `;
    inputContainer.innerHTML = fieldHTML;

    // delBtn
    let delInputBtn = inputContainer.querySelector('.button');

    // append
    formContent.appendChild(inputContainer);

    // Delete Input
    delInputBtn.addEventListener('click', (e) => {
        // var delItem = e.target.parentElement;
        // console.log(delItem);

        formContent.removeChild(inputContainer);
        limitInfo.classList.add('hidden');
    })

}


