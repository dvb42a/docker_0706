
// database
const filterDatabaseInput = document.getElementById('filterDatabaseInput');
const databaseKeywordContainer = document.getElementById('databaseKeywordContainer');

// category
const filterCategoryInput = document.getElementById('filterCategoryInput');
const categoryKeywordContainer = document.getElementById('categoryKeywordContainer');
const clearAllBtn = document.getElementById('clearAllBtn');

// submit
const submitBtn = document.getElementById('submitBtn');
let categoryValueInput = document.getElementById('categoryValueInput');

//form
var form = document.getElementById('form');

// 關鍵字資料庫 API
const keywordDataUrl = link + "/api/tags";

// 獲取 keyword database
async function databaseApi(id) {

    // 群組資料庫 API
    const categoryDataUrl = `${link}/api/category/${id}`;
    console.log(id);

    // keyword response
    const keywordResponse = await fetch(keywordDataUrl);
    // Storing data in form of JSON
    let keywordDatabase = await keywordResponse.json();

    // category response
    const categoryResponse = await fetch(categoryDataUrl);
    let categoryKeywordList = await categoryResponse.json();

    console.log('categoryKeywordList:', categoryKeywordList);

    // 去除重複 keyword
    let showDatabase = getDifference(keywordDatabase, categoryKeywordList);
    // console.log('showDatabase:', showDatabase);

    // Display
    renderDatabase(showDatabase, categoryKeywordList);
    renderCategory(keywordDatabase, categoryKeywordList);

    // clear All Btn
    clearAllBtn.addEventListener('click', () => {
        categoryKeywordList = [];
        renderCategory(keywordDatabase, categoryKeywordList);
    })

    // filter DatabaseInput
    filterDatabaseInput.addEventListener('keyup', (e) => {

        // 取得現在的 array
        let nowDatabase = getDifference(showDatabase, categoryKeywordList);

        let filterResult = nowDatabase.filter(item => item.bp_hashtag.includes(e.target.value));
        // console.log('filterResult:', filterResult);

        if (filterResult.length == 0 && e.target.value !== '') {
            databaseKeywordContainer.textContent = '沒有符合條件的關鍵字';
        } else {
            renderDatabase(filterResult, categoryKeywordList);
        }

    })

    // filter categoryInput
    filterCategoryInput.addEventListener('keyup', (e) => {

        let filterResult = categoryKeywordList.filter(item => item.bp_hashtag.includes(e.target.value));
        // console.log('filterResult:', filterResult);

        if (filterResult.length == 0 && e.target.value !== '') {
            categoryKeywordContainer.textContent = '沒有符合條件的關鍵字';
        } else {
            renderCategory(keywordDatabase, filterResult);
        }

    })


    // submit action
    submitBtn.addEventListener('click', () => {

        categoryKeywordList.forEach(function(value){
            var inputElement = document.createElement('input');
            inputElement.type = "hidden";
            inputElement.name='bp_tag_id[]';
            inputElement.value=value.bp_tag_id;
            form.appendChild(inputElement);
        })

        categoryNameInput.value=categoryName.innerText;
        form.submit();

    })

};


// 顯示資料庫關鍵字
function renderDatabase(array, categoryKeywordList) {

    // clear
    databaseKeywordContainer.innerHTML = '';

    // create UI
    array.forEach(keyword => {
        // console.log(keyword.bp_tag_id, keyword.bp_hashtag);

        let keywordTag = document.createElement('span');
        keywordTag.classList.add('tag');
        keywordTag.classList.add('is-keyword');
        keywordTag.classList.add('m-1');
        keywordTag.classList.add('cursor-pointer');
        keywordTag.textContent = `${keyword.bp_hashtag}`;
        databaseKeywordContainer.appendChild(keywordTag);

        // 設定操作行為
        keywordTag.addEventListener('click', (e) => {
            // console.log(e.target);

            let keywordHashtag = array.map(item => Object.values(item)[1]);
            let index = keywordHashtag.indexOf(e.target.innerText);
            // console.log(index);
            categoryKeywordList.push(array[index]);
            // console.log('after add, categoryKeywordList:', categoryKeywordList);

            // display UI
            renderCategory(array, categoryKeywordList);

            // remove UI
            let clickItem = e.target;
            clickItem.remove();

        })
    });

}


// 顯示群組內關鍵字
function renderCategory(keywordDatabase, categoryKeywordList) {

    // clear
    categoryKeywordContainer.innerHTML = '';

    // create Ui
    categoryKeywordList.forEach(keyword => {
        // console.log(keyword.bp_tag_id, keyword.bp_hashtag);

        let keywordTag = document.createElement('span');
        keywordTag.classList.add('tag');
        keywordTag.classList.add('is-keyword');
        keywordTag.classList.add('m-1');
        keywordTag.innerHTML = `
            ${keyword.bp_hashtag}
            <button type="button" class="tag-btn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        `;
        categoryKeywordContainer.appendChild(keywordTag);

        // 設定 deleteBtn 行為
        let deleteBtn = keywordTag.querySelector('button');
        deleteBtn.addEventListener('click', (e) => {
            // console.log(e.target);

            let delItem = e.target.parentElement;
            // console.log(delItem);

            // 去除 categoryList 內的 keyword
            let keywordHashtag = categoryKeywordList.map(item => Object.values(item)[1]);
            let index = keywordHashtag.indexOf(delItem.innerText)
            categoryKeywordList.splice(index, 1);
            // console.log('after delete, categoryKeywordList:', categoryKeywordList);

            // 重新檢查重複 keyword
            let showDatabase = getDifference(keywordDatabase, categoryKeywordList);
            // console.log('after delete, showDatabase:', showDatabase);

            // display UI
            renderDatabase(showDatabase, categoryKeywordList);
            renderCategory(keywordDatabase, categoryKeywordList);

        })

    });

}


// 取新 array => 去除 array 1 內與 array 2 重複的部分
function getDifference(array1, array2) {
    let array1_id = array1.map(item => Object.values(item)[0]);
    let array2_id = array2.map(item => Object.values(item)[0]);

    let differenceArray = array1_id.filter(item => !array2_id.includes(item));
    // console.log(differenceArray);

    let finalArray = [];
    for (var i = 0; i < array1.length; i++) {
        // console.log(array1[i]);
        for (var j = 0; j < differenceArray.length; j++) {
            if (array1[i].bp_tag_id == differenceArray[j]) {
                finalArray.push(array1[i]);
            }
        }
    }

    return finalArray;
}





// ========== 編輯名稱 ==========

let categoryNameInput = document.getElementById('categoryNameInput');
let helpInfo = document.getElementById('helpInfo');

let categoryName = document.getElementById('categoryName');
const oldCategoryName = categoryName.innerText; // 暫存原本名稱
let editNameBtn = document.getElementById('editNameBtn');
let cancelEditBtn = document.getElementById('cancelEditBtn');
let saveCategoryNameBtn = document.getElementById('saveCategoryNameBtn');


// Edit category name
editNameBtn.addEventListener('click', () => {

    // 設定可編輯
    categoryName.contentEditable = true;
    categoryName.classList.add('underline');

    // btn 顯示狀態
    editNameBtn.classList.add('hidden');
    cancelEditBtn.classList.remove('hidden');
    saveCategoryNameBtn.classList.remove('hidden');

    // help info
    helpInfo.innerText = '';
})

// cancel edit btn
cancelEditBtn.addEventListener('click', () => {

    // 設定不可編輯
    categoryName.contentEditable = false;
    categoryName.classList.remove('underline');

    // 回復群組名稱
    categoryName.innerText = oldCategoryName;
    categoryNameInput.value = oldCategoryName;

    // btn 顯示狀態
    editNameBtn.classList.remove('hidden');
    cancelEditBtn.classList.add('hidden');
    saveCategoryNameBtn.classList.add('hidden');

    // help info
    helpInfo.innerText = '';

})

// save new category
saveCategoryNameBtn.addEventListener('click', () => {

    // 設定不可編輯
    categoryName.contentEditable = false;
    categoryName.classList.remove('underline');

    // TODO 加入重複判斷
    if (categoryName.innerText == '') {

        // console.log('不可為空白');
        // help info
        helpInfo.innerText = '不可為空白, 回復原本名稱';

        // 回復群組名稱
        categoryName.innerText = oldCategoryName;

    } else {

        // 傳到 input
        categoryNameInput.value = categoryName.innerText;

        // help info
        helpInfo.innerText = '';
    }

    // btn 顯示狀態
    editNameBtn.classList.remove('hidden');
    cancelEditBtn.classList.add('hidden');
    saveCategoryNameBtn.classList.add('hidden');

})
