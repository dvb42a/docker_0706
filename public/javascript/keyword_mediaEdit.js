// frontend
const addBtn = document.getElementById("addBtn");
const tagContainer = document.getElementById("tagContainer");
const addInput = document.getElementById("addInput");
const saveBtn = document.getElementById('saveBtn');
const father = document.getElementById('tagContainer').parentElement;
//console.log(father);

// Help Info
let repeatInfo = document.getElementById("repeatInfo");
let emptyInfo = document.getElementById("emptyInfo");
let noDataInfo = document.getElementById("noDataInfo");

// 關鍵字資料庫API
const keywordDataUrl = link + "/api/tags";


// 要儲存的資料
let keywordList = [];

// 獲取 keyword database
async function databaseApi(url) {


    // Storing response
    const response = await fetch(keywordDataUrl);
    // Storing data in form of JSON
    let keywordDatabase = await response.json();
    let checkDataArray = keywordDatabase.map(bp_hashtag => Object.values(bp_hashtag)[1])

    // console.log('keywordDatabase:', keywordDatabase);
    console.log('checkDataArray:', checkDataArray);

    // input 下拉選單資料庫
    $(function () {
        $("#addInput").autocomplete({
            source: checkDataArray
        });
    });

    // 輸入關鍵字欄位
    addBtn.addEventListener("click", (e) => {
        e.preventDefault();

        // get value from input
        let keywordValue = addInput.value;
        // console.log(keywordValue);
        checkInputValue(keywordValue, keywordDatabase, checkDataArray);
    });

    // 新增文章不需要跑這個 function
    renderArticleDatabase(url, keywordDatabase, checkDataArray);
};

// 渲染文章資料
function renderArticleDatabase(url, keywordDatabase, checkDataArray) {
    // 抓取文章原本資料
    //console.log(keywordDatabase);
    async function articleData() {
        const response = await fetch(url);
        let articleDatabase = await response.json();

        for (var i = 0; i < articleDatabase.length; i++) {
            //console.log(articleDatabase[i].tag[0].bp_hashtag);
            createKeyword(articleDatabase[i].tag[0].bp_hashtag);

            // push keyword in array
            let keywordIndex = checkDataArray.indexOf(articleDatabase[i].tag[0].bp_hashtag);
            // console.log('keywordIndex:', keywordIndex);
            //console.log(keywordDatabase[keywordIndex]);
            keywordList.push(keywordDatabase[keywordIndex]);
            // console.log("keywordList:", keywordList);
        }
    }
    articleData();
}

// 檢查 input value
function checkInputValue(value, keywordDatabase, checkDataArray) {
    // avoid empty input
    if (value === "") {
        removeWarning();
        // empty warning
        addInput.classList.add("danger");
        emptyInfo.classList.remove("hide");
        return;
    } else {
        // remove warning
        removeWarning();

        // 確認資料庫是否有這個關鍵字
        if (checkDataArray.indexOf(value) == -1) {
            removeWarning();
            addInput.classList.add("danger");
            noDataInfo.classList.remove('hide');
        } else {
            removeWarning();

            // push keyword in array
            let keywordIndex = checkDataArray.indexOf(value);
            // console.log('keywordIndex:', keywordIndex);
            // console.log(keywordDatabase[keywordIndex]);
            keywordList.push(keywordDatabase[keywordIndex]);
            // console.log("keywordList:", keywordList);

            let keywordData = new Set(keywordList);
            // console.log("keywordData:", keywordData);

            // check if repeat
            if (keywordData.size == keywordList.length) {
                removeWarning();

                // warning repeat
                addInput.classList.remove("danger");
                repeatInfo.classList.add("hide");

                createKeyword(value);

            } else {
                removeWarning();
                addInput.classList.add("danger");
                repeatInfo.classList.remove("hide");
                keywordList.splice([keywordList.length - 1], 1);
            }
            // clear Input after adding
            addInput.value = "";
        }
    }
}

// create Keyword
function createKeyword(tagValue) {
    // Create a Tag
    let keyword = document.createElement("span");
    keyword.classList.add("tag");
    keyword.classList.add("is-keyword");
    keyword.innerText = tagValue;

    // create deleteBtn
    let deleteBtn = document.createElement("button");
    deleteBtn.classList.add("tag-btn");
    deleteBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    deleteBtn.type = "button";

    // append
    keyword.appendChild(deleteBtn);
    tagContainer.appendChild(keyword);

    // delete function
    deleteBtn.addEventListener("click", (e) => {
        let keywordItem = e.target.parentElement;
        let deleteItem = e.target.parentElement.innerText;
        // console.log('deleteItem:', deleteItem);

        // check keywordData array
        keywordList.forEach((item, index) => {
            if (item.bp_hashtag == deleteItem) {
                keywordList.splice(index, 1);
                keywordData = new Set(keywordList);
                console.log("after delete, keywordList:", keywordList);
            }
        });

        // delete keyword
        keywordItem.remove();
    });
}

// Remove all warning
function removeWarning() {
    addInput.classList.remove("is-danger");
    emptyInfo.classList.add("hide");
    repeatInfo.classList.add("hide");
    noDataInfo.classList.add('hide');
}


var Url = window.location.href;
let Url_s1 = Url.substring(Url.lastIndexOf('/'), - 1);
let content_id = Url_s1.substring(Url_s1.lastIndexOf('/') + 1);

console.log(content_id);

// 送出文章 button
saveBtn.addEventListener('click', () => {
    let keywordListID = keywordList.map(bp_tag_id => Object.values(bp_tag_id)[0]);

    console.log(keywordListID);

    for (i = 0; i < keywordListID.length; i++) {
        var keyword = document.createElement("input");
        father.appendChild(keyword);
        keyword.type = "hidden";
        keyword.name = "keywords[]";
        keyword.value = keywordListID[i];
    }

    document.getElementById("form").submit();

    /*     var url = 'http://127.0.0.1/api/contentHashtag';
        fetch(url, {
        method: 'POST', // or 'PUT'
        body: JSON.stringify({
            keywordListID:keywordListID,
            content_id:content_id,
        }), // data can be `string` or {object}!
        headers: new Headers({
            'Content-Type': 'application/json'
        })
        }).then(res => res.json())
        .catch(error => console.error('Error:', error))
        .then(function () {
            console.log('true');
            document.getElementById('submit_type').value = 'submit';
            document.getElementById('edit_content').submit();
        }); */
    //document.getElementById('edit_content').submit();

})






// Remove All keywords
delBtn.addEventListener('click', () => {
    tagContainer.innerHTML = "";
    keywordList = [];
});


// on Load
//databaseApi(objectDataUrl); // 獲取 關鍵字資料庫
