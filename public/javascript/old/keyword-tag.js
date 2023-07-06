// frontend
let addBtn = document.getElementById("addBtn");
let tagContainer = document.getElementById("tagContainer");
let addInput = document.getElementById("addInput");
let delBtn = document.getElementById("delBtn");

// Help Info
let repeatInfo = document.getElementById("repeatInfo");
let emptyInfo = document.getElementById("emptyInfo");

// data
let dataSelect = document.getElementById("dataSelect");
// let dataInput = document.getElementById("dataInput");

// Create an array
let keywordList = [];

addBtn.addEventListener("click", (e) => {
    e.preventDefault();
    // console.log(e.target);

    // get value from input
    let keywordValue = addInput.value;
    // console.log(keywordValue);

    // avoid empty input
    if (keywordValue === "") {
        // empty warning
        addInput.classList.add("is-danger");
        emptyInfo.classList.remove("hide");
        repeatInfo.classList.add("hide");
        return;
    } else {
        // remove warning
        addInput.classList.remove("is-danger");
        emptyInfo.classList.add("hide");
        repeatInfo.classList.add("hide");

        // push keyword in array
        keywordList.push(keywordValue);
        // console.log("keywordList:", keywordList);

        let keywordData = new Set(keywordList);
        // console.log("keywordData:", keywordData);

        // check if repeat
        if (keywordData.size == keywordList.length) {
            // console.log("沒有重複值");

            // warning repeat
            addInput.classList.remove("is-danger");
            repeatInfo.classList.add("hide");

            // Create a Tag
            let keyword = document.createElement("span");
            keyword.classList.add("tag");
            keyword.classList.add("is-info");
            keyword.classList.add("is-rounded");
            keyword.innerText = keywordValue;

            // create deleteBtn
            let deleteBtn = document.createElement("button");
            deleteBtn.classList.add("delete");
            deleteBtn.classList.add("is-small");
            deleteBtn.type = "button";

            // append
            keyword.appendChild(deleteBtn);
            tagContainer.appendChild(keyword);

            // delete function
            deleteBtn.addEventListener("click", (e) => {
                let keywordItem = e.target.parentElement;
                let dataItem = e.target.parentElement.innerText;
                // console.log('dataItem:', dataItem);

                // check keywordData array
                keywordList.forEach((item, index) => {
                    if (item == dataItem) {
                        keywordList.splice(index, 1);
                        keywordData = new Set(keywordList);
                        // console.log("after delete, keywordList:", keywordList);
                        // console.log("after delete, keywordData:", keywordData);
                    }
                });

                // delete tag
                keywordItem.remove();
                createOption();
            });
        } else {
            // console.log("有重複值");
            addInput.classList.add("is-danger");
            repeatInfo.classList.remove("hide");
            keywordList.splice([keywordList.length - 1], 1);
        }
        // clear Input after adding
        addInput.value = "";
        createOption();
    }
});

// 送出文章 button
const saveBtn = document.getElementById('saveBtn');
saveBtn.addEventListener('click', () => {
    console.log(keywordList);
})

// create Option
function createOption() {
    dataSelect.innerHTML = "";
    for (var i = 0; i <= keywordList.length - 1; i++) {
        let dataOption = document.createElement("option");
        dataOption.innerText = keywordList[i];
        dataOption.value = keywordList[i];
        dataOption.selected = true;
        dataSelect.appendChild(dataOption);
    }
}

// Remove All
function removeAll() {
    tagContainer.innerHTML = "";
    localStorage.clear();
}

delBtn.addEventListener('click', removeAll());