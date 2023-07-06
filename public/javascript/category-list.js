
const categoryContainer = document.getElementById('categoryContainer');
const addCategoryInput = document.getElementById('addCategoryInput');
const addCategoryBtn = document.getElementById('addCategoryBtn');
const cancelAddBtn = document.getElementById('cancelAddBtn');
let helpInfo = document.getElementById('helpInfo');


/* addCategoryBtn.addEventListener('click', (e) => {
    e.preventDefault();
    // console.log('add');

    let newCategory = addCategoryInput.value;
    // console.log(newCategory);

    if (newCategory == '') {
        // console.log('不可以是空值');

        addCategoryInput.classList.add('input-warning');
        helpInfo.textContent = '不可以是空值';

    } else {

        // clear
        clearInput();

        // create UI display
        createCategory(newCategory);
    }

    // TODO 加入判斷是否重複


}); */

cancelAddBtn.addEventListener('click', () => {
    // console.log('cancel');
    clearInput();
});


// create category element
/* function createCategory(newCategory) {

    // clear input
    clearInput();

    let tr = document.createElement('tr');
    let category = `
        <td>
            <a href="{{ route('category.edit', '1') }}" target="_blank">
                ${newCategory}
            </a>
        </td>
        <td>
            0
        </td>

        <td class="h-full flex gap-2 items-center">
            <button class="button danger-btn del-btn" type="button">
                <span class="mr-0 5">
                    <i class="fa-solid fa-trash"></i>
                </span>
                刪除
            </button>
        </td>`;

    tr.innerHTML = category;

    categoryContainer.appendChild(tr);

    // delete btn
    let delBtn = tr.querySelector('.del-btn');

    delBtn.addEventListener('click', (e) => {
        // console.log(e.target);

        let delItem = e.target.parentElement;
        delItem.parentElement.remove();

    });

} */


// clear Input and help info
function clearInput() {

    addCategoryInput.value = '';
    addCategoryInput.classList.remove('input-warning');

    helpInfo.textContent = '';

}



// delBtn 行為
/* const delBtns = document.querySelectorAll('.del-btn');

// delete btn
delBtns.forEach(btn => btn.addEventListener('click', (e) => {
    // console.log(e.target);

    let delItem = e.target.parentElement;
    delItem.parentElement.remove();

})); */
