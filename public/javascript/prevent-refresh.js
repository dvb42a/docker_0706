
// 防止小笨蛋刷新頁面或離開頁面
window.onbeforeunload = function (e) {
    e = e || window.event
    if (e) {
        e.returnValue = '網站可能不會保存變更'
    }
    return '網站可能不會保存變更'
}
