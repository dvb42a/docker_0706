const selectAllBtn = document.getElementById("select-all");
let itemCheckbox = document.querySelectorAll('.select-item')
function selectAll() {
    if (selectAllBtn.checked) {
        for (var i = 0; i < itemCheckbox.length; i++) {
            itemCheckbox[i].checked = true;
        }
    } else {
        for (var i = 0; i < itemCheckbox.length; i++) {
            itemCheckbox[i].checked = false;
        }
    }
}
