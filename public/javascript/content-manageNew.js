
// tab Container
let tabContainer = document.querySelectorAll(".tab-container");
// console.log(tabContainer);

// add keyword btn & input
let chapter = document.getElementById("chapter");
let tabInputs = document.querySelectorAll('.tabInput');
let tabBtn = document.querySelectorAll('.tabBtn'); // tab add btn
// console.log(tabInputs, tabBtn);

// save & cancel btn
let saveBtn = document.getElementById("saveChangeBtn");
let cancelBtn = document.getElementById("cancelBtn");

// Help Info

let helpInfo = document.querySelectorAll('.helpInfo');
// console.log('helpInfo:', helpInfo);
let orderUpInfos = document.querySelectorAll('.orderUpInfo');
let orderDownInfos = document.querySelectorAll('.orderDownInfo');
// console.log(orderDownInfos, orderUpInfos);

// 關鍵字資料庫 API
const keywordDataUrl = link + "/api/tags";

// 章節 API
const chapterDataUrl = link + '/api/chapter';

// 獲取 keyword database
async function databaseApi(url) {
    // Storing response
    const response = await fetch(url);
    // Storing data in form of JSON
    let keywordDatabase = await response.json(); // 關鍵字資料庫

    // 取關鍵字名稱進行比對
    let checkDataArray = keywordDatabase.map(bp_hashtag => Object.values(bp_hashtag)[1])

    // console.log('關鍵字資料庫 keywordDatabase:', keywordDatabase);
    // console.log('關鍵字列表 checkDataArray:', checkDataArray);

    // input 下拉選單資料庫
    $(function () {
        $("#addKeywordInput").autocomplete({
            source: checkDataArray
        });
    });

    $(function () {
        $("#tabInput_1").autocomplete({
            source: checkDataArray
        });
    });
    $(function () {
        $("#tabInput_2").autocomplete({
            source: checkDataArray
        });
    });
    $(function () {
        $("#tabInput_3").autocomplete({
            source: checkDataArray
        });
    });

    // 載入章節資料
    chapterDatabaseApi(chapterDataUrl, checkDataArray, keywordDatabase);
};

// 獲取章節資料
async function chapterDatabaseApi(url, checkDataArray, keywordDatabase) {
    // Storing response
    const response = await fetch(url);
    // Storing data in form of JSON
    let chapterDatabase = await response.json(); // 章節資料
    // console.log('章節資料 chapterDatabase', chapterDatabase);

    //  從 database 獲得 array
    let chapter_1 = chapterDatabase.map(item => Object.values(item))[0];
    let chapterKeywordArray_1 = chapter_1[2];
    let chapter_2 = chapterDatabase.map(item => Object.values(item))[1];
    let chapterKeywordArray_2 = chapter_2[2];
    let chapter_3 = chapterDatabase.map(item => Object.values(item))[2];
    let chapterKeywordArray_3 = chapter_3[2];

    // console.log('chapter_1:', chapter_1);
    // console.log('chapterKeywordArray_1:', chapter_1[2]);
    // console.log('chapter_2:', chapter_2);
    // console.log('chapterKeywordArray_2:', chapter_2[2]);
    // console.log('chapter_3:', chapter_3);
    // console.log('chapterKeywordArray_3:', chapter_3[2]);

    // 顯示章節資料
    createKeywordFromDatabase(chapterKeywordArray_1, tabContainer[0]);
    createKeywordFromDatabase(chapterKeywordArray_2, tabContainer[1]);
    createKeywordFromDatabase(chapterKeywordArray_3, tabContainer[2]);


    // 套用變更 button
    saveBtn.addEventListener("click", () => {
        // console.log(e.target);

        console.log('Submit Data');

        const keywordArray_submit1 = chapterKeywordArray_1.map(item => Object.values(item)[0]);
        const keywordArray_submit2 = chapterKeywordArray_2.map(item => Object.values(item)[0]);
        const keywordArray_submit3 = chapterKeywordArray_3.map(item => Object.values(item)[0]);

        // console.log('chapter_1:', chapter_1);
        // console.log('chapterKeywordArray_1:', chapter_1[2]);

        var url = link + '/api/chapter';
        fetch(url, {
            method: 'POST', // or 'PUT'
            body: JSON.stringify({
                ky_array1: keywordArray_submit1,
                ky_array2: keywordArray_submit2,
                ky_array3: keywordArray_submit3,
            }), // data can be `string` or {object}!
            headers: new Headers({
                'Content-Type': 'application/json'
            })
        }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then(function (response) {
                if (response == "true") {
                    toastr.success('儲存成功');
                }
                //window.location.reload();
            });

    });

    // add keyword into single tab
    tabBtn.forEach((btn, index) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault;

            // 獲取 Input value
            let inputValue = tabInputs[index].value;
            // console.log(inputValue);

            // array => 章節 object
            let array = chapterDatabase.map(item => Object.values(item))[index];
            // console.log(array);

            // add Input value
            addInputValue(array, index, tabInputs, inputValue, checkDataArray, keywordDatabase);

            inputValue = '';
        })
    })

};

// add keyword from input
function addInputValue(array, index, input, inputValue, checkDataArray, keywordDatabase) {

    // array => 當前 chapter object, index => tabContainer
    // console.log(array);

    //　取 object array 的 hashtag 出來做單獨 array
    let keywordArrayHashtag = array[2].map((item) => Object.values(item)[1]);
    // console.log('keywordArrayHashtag:', keywordArrayHashtag);

    // 檢查 input 值
    switch (true) {
        // 確認是否為空值
        case (inputValue === ""):
            hideInfo(); // 清除提示訊息
            input[index].classList.add("input-warning");
            helpInfo[index].innerText = '不可以空白';
            break;
        // 確認是否加入重複關鍵字
        case (keywordArrayHashtag.indexOf(inputValue) !== -1):
            hideInfo(); // 清除提示訊息
            input[index].classList.add("input-warning");
            helpInfo[index].innerText = '重複建立關鍵字';
            break;
        // 確認資料庫是否有這個關鍵字
        case (checkDataArray.indexOf(inputValue) == -1):
            hideInfo(); // 清除提示訊息
            input[index].classList.add("input-warning");
            helpInfo[index].innerText = '資料庫無此關鍵字';
            break;
        // 確認是否超過上限
        case (array.length > 9):
            hideInfo(); // 清除提示訊息
            input[index].classList.add("input-warning");
            helpInfo[index].innerText = '不可以超過十個';
            break;
        default:
            hideInfo(); // 清除提示訊息
            let keywordIndex = checkDataArray.indexOf(inputValue);
            console.log("加入關鍵字:", inputValue, 'Index:', keywordIndex);

            // 把關鍵字加入 array (資料處理)
            array[2].push(keywordDatabase[keywordIndex]);

            // console.log('keywordDatabase[keywordIndex]', keywordDatabase[keywordIndex]);
            console.log('新增後的 array:', array[2])

            // 頁面顯示關鍵字
            createKeywordElement(array, index, keywordIndex, keywordDatabase);
    }
    inputValue = ''; // clear input
}

// 顯示前端關鍵字元件
function createKeywordElement(array, index, keywordIndex, keywordDatabase) {

    // array => 當前 chapter object, index => tabContainer
    let chapterKeywordArray = array[2];

    // 確認 tab-container
    // console.log(tabContainer[index]);

    let orderUpInfo = tabContainer[index].parentElement.querySelector('.orderUpInfo');
    let orderDownInfo = tabContainer[index].parentElement.querySelector('.orderDownInfo');

    let tabEl = document.createElement("div");
    tabEl.classList.add("tab-element");

    let keyword = `
        <span>
            <span class="text-sm text-gray-500 mr-0.5"> ${array[2].length}. </span>
            <span class="tag is-keyword">
                <a target="_blank" href='${"section/" + keywordDatabase[keywordIndex].bp_tag_id}'>
                    ${keywordDatabase[keywordIndex].bp_hashtag}
                </a>
                <span class="tag is-unsave small-tag">
                    ${keywordDatabase[keywordIndex].content_count}
                </span>
            </span>
        </span>
    `;
    tabEl.innerHTML = keyword;

    let tabBtn = document.createElement("div");
    tabBtn.classList.add("tab-btns");
    let delBtn = document.createElement("button");
    let upBtn = document.createElement("button");
    let downBtn = document.createElement("button");
    createBtns(tabBtn, delBtn, upBtn, downBtn);
    tabEl.appendChild(tabBtn);

    // append into tab container
    tabContainer[index].appendChild(tabEl);

    // 刪除關鍵字 function
    delBtn.addEventListener("click", (e) => {
        hideInfo(); // 清除提示訊息

        // 取得要刪除的 element
        let keywordEl = e.target.parentElement;
        // console.log('keywordEl', keywordEl);
        let delEL = keywordEl.parentElement;
        // console.log('delEL', delEL);

        // 取得要刪除的關鍵字
        let deleteKeyword = delEL.querySelector(".is-keyword");
        // console.log('deleteKeyword:', deleteKeyword);
        let deleteKeywordValue = deleteKeyword.querySelector("a").innerText;
        // console.log('deleteKeywordValue:', deleteKeywordValue);
        let keywordIndex = keywordDatabase.indexOf(deleteKeywordValue);
        console.log('keywordIndex:', keywordIndex);

        delEL.remove(); // 刪除元件(前端顯示)

        // 從 array 刪除 (data)
        chapterKeywordArray.remove(array[keywordIndex]);
        console.log(chapter.value, "要刪除的關鍵字:", `[${keywordIndex}]`, deleteKeywordValue, "刪除後的 array", chapterKeywordArray);
    });

    // upBtn 行為設定
    upBtn.addEventListener("click", (e) => {
        hideInfo(); // 清除提示訊息

        //　取得當下的 chapterKeywordArray Hashtag
        let keywordArrayHashtag = chapterKeywordArray.map((item) => Object.values(item)[1]);

        // get parent Element
        let tabEl = e.target.parentElement.parentElement;
        let moveKeyword = tabEl.querySelector("a").innerText;
        let moveKeywordIndex = keywordArrayHashtag.indexOf(moveKeyword);
        console.log('moveKeyword', moveKeyword);
        console.log('moveKeywordIndex', moveKeywordIndex);

        // 排序
        if (moveKeywordIndex == 0) {
            // console.log("已經是第一個!!");
            orderUpInfo.classList.remove("hidden");
        } else {
            console.log(moveKeyword, "往上移");
            orderUp(chapterKeywordArray, moveKeywordIndex);

            tabContainer[index].innerHTML = ''; // clear tabContainer
            createKeywordFromDatabase(chapterKeywordArray, tabContainer[index]);
        }
    });

    // downBtn 行為設定
    downBtn.addEventListener("click", (e) => {
        hideInfo(); // 清除提示訊息;

        //　取得當下的 chapterKeywordArray Hashtag
        let keywordArrayHashtag = chapterKeywordArray.map((item) => Object.values(item)[1]);

        // get parent Element
        let tabEl = e.target.parentElement.parentElement;
        let moveKeyword = tabEl.querySelector("a").innerText;
        let moveKeywordIndex = keywordArrayHashtag.indexOf(moveKeyword);
        // console.log(moveKeyword);

        // 排序
        if (moveKeywordIndex >= keywordArrayHashtag.length - 1) {
            // console.log("已經是最後一個了!!");
            orderDownInfo.classList.remove("hidden");
        } else {
            console.log(moveKeyword, "往下移");
            orderDown(chapterKeywordArray, moveKeywordIndex);
            tabContainer[index].innerHTML = ''; // clear tabContainer
            createKeywordFromDatabase(chapterKeywordArray, tabContainer[index]);
        }
    });
}

// 從 data 製作關鍵字, onload 及 排序 使用
function createKeywordFromDatabase(array, tabContainer) {

    //　取 object array 的 hashtag 出來做單獨 array
    let keywordArrayHashtag = array.map((item) => Object.values(item)[1]);

    let orderUpInfo = tabContainer.parentElement.querySelector('.orderUpInfo');
    let orderDownInfo = tabContainer.parentElement.querySelector('.orderDownInfo');

    array.forEach((item, index) => {
        let tabEl = document.createElement("div");
        tabEl.classList.add("tab-element");

        // create Keyword
        let keyword = `
            <span>
                <span class="text-sm text-gray-500 mr-0.5"> ${index + 1}. </span>
                    <span class="tag is-keyword">
                        <a target="_blank" href='${"section/" + item.bp_tag_id}'>
                            ${item.bp_hashtag}
                        </a>
                        <span class="tag is-unsave small-tag">
                            ${item.content_count}
                        </span>
                    </span>
                </span>
            `;
        tabEl.innerHTML = keyword;

        // tabBtn
        let tabBtn = document.createElement("div");
        tabBtn.classList.add("tab-btns");
        let delBtn = document.createElement("button");
        let upBtn = document.createElement("button");
        let downBtn = document.createElement("button");
        createBtns(tabBtn, delBtn, upBtn, downBtn);
        tabEl.appendChild(tabBtn);

        // append
        tabContainer.appendChild(tabEl);

        // 刪除關鍵字 function
        delBtn.addEventListener("click", (e) => {
            hideInfo(); // 清除提示訊息

            // 取得要刪除的 element
            let keywordEl = e.target.parentElement;
            // console.log('keywordEl', keywordEl);
            let delEL = keywordEl.parentElement;
            // console.log('delEL', delEL);

            // 取得要刪除的關鍵字
            let deleteKeyword = delEL.querySelector(".is-keyword");
            // console.log('deleteKeyword:', deleteKeyword);
            let deleteKeywordValue = deleteKeyword.querySelector("a").innerText;
            console.log('deleteKeywordValue:', deleteKeywordValue);
            let keywordIndex = keywordArrayHashtag.indexOf(deleteKeywordValue);

            delEL.remove(); // 刪除元件(前端顯示)

            // 從 array 刪除
            array.remove(array[keywordIndex]);
            console.log('chapter:', chapter.value, "要刪除的關鍵字:", `[${keywordIndex}]`, deleteKeywordValue, "刪除後的 array", array);
        });

        // upBtn 行為設定
        upBtn.addEventListener("click", (e) => {
            hideInfo(); // 清除提示訊息

            // get parent Element
            let tabEl = e.target.parentElement;
            let keywordEl = tabEl.parentElement;
            let moveKeyword = keywordEl.querySelector("a").innerText;
            let keywordIndex = keywordArrayHashtag.indexOf(moveKeyword);
            // console.log('要移動的關鍵字:', `[${keywordIndex}]`, moveKeyword);

            // 排序
            if (keywordIndex == 0) {
                // console.log("已經是第一個!!");
                orderUpInfo.classList.remove("hidden");
            } else {
                console.log(moveKeyword, "往上移");
                orderUp(array, keywordIndex);

                tabContainer.innerHTML = ''; // clear tabContainer
                createKeywordFromDatabase(array, tabContainer);
            }

        });

        // downBtn 行為設定
        downBtn.addEventListener("click", (e) => {
            hideInfo(); // 清除提示訊息

            // get parent Element
            let tabEl = e.target.parentElement;
            let keywordEl = tabEl.parentElement;
            let moveKeyword = keywordEl.querySelector("a").innerText;
            let keywordIndex = keywordArrayHashtag.indexOf(moveKeyword);
            // console.log('要移動的關鍵字:',`[${keywordIndex}]`, moveKeyword);

            // 排序
            if (keywordIndex >= (array.length - 1)) {
                // console.log("已經是最後一個了!!");
                orderDownInfo.classList.remove("hidden");
            } else {
                console.log(moveKeyword, "往下移");
                orderDown(array, keywordIndex);

                tabContainer.innerHTML = ''; // clear tabContainer
                createKeywordFromDatabase(array, tabContainer);
            }
        });
    })

}

// 刪除 array 元素
Array.prototype.remove = function (value) {
    this.splice(this.indexOf(value), 1);
};

// create delBtn, upBtn, downBtn
function createBtns(tabBtn, delBtn, upBtn, downBtn) {
    // delBtn
    delBtn.classList.add("button");
    delBtn.classList.add("small-btn");
    delBtn.classList.add("bg-danger");
    delBtn.classList.add("danger-btn");
    delBtn.type = "button";
    let xIcon = document.createElement("span");
    xIcon.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    delBtn.appendChild(xIcon);

    // upBtn
    upBtn.classList.add("button");
    upBtn.classList.add("secondary-btn");
    upBtn.classList.add("small-btn");
    upBtn.type = "button";
    let upICon = document.createElement("span");
    upICon.innerHTML = '<i class="fa-solid fa-arrow-up"></i>';
    upBtn.appendChild(upICon);

    // DownBtn
    downBtn.classList.add("button");
    downBtn.classList.add("secondary-btn");
    downBtn.classList.add("small-btn");
    downBtn.type = "button";
    let downIcon = document.createElement("span");
    downIcon.innerHTML = '<i class="fa-solid fa-arrow-down"></i>';
    downBtn.appendChild(downIcon);

    // append to tabBtn
    tabBtn.appendChild(upBtn);
    tabBtn.appendChild(downBtn);
    tabBtn.appendChild(delBtn);
}

// Set order Up
function orderUp(array, index) {
    [array[index], array[index - 1]] = [array[index - 1], array[index]];
    console.log('移動後的 array', array);
}

// Set order Down
function orderDown(array, index) {
    [array[index], array[index + 1]] = [array[index + 1], array[index]];
    console.log('移動後的 array', array);
}

// 隱藏提示訊息
function hideInfo() {

    tabInputs.forEach(input => {
        input.classList.remove('input-warning');
        input.value = '';
    })

    helpInfo.forEach(info => {
        // console.log(info);
        info.innerText = '';
    })

    orderUpInfos.forEach(item => {
        item.classList.add('hidden');
    });

    orderDownInfos.forEach(item => {
        item.classList.add('hidden')
    });

}

// add cancel button event listener
cancelBtn.addEventListener('click', () => {
    window.location.reload();
});

// on load
databaseApi(keywordDataUrl); // 載入關鍵字資料庫
hideInfo(); // 隱藏提示訊息
