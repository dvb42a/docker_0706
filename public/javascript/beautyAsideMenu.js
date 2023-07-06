

// Toggle Menu
function toggleMenu(e) {
    var arrowIcon = e.target.querySelector('.arrow-icon');
    // arrowIcon.classList.toggle('rotate-90');
    if (arrowIcon.classList.contains('fa-angle-right')) {
        arrowIcon.classList.replace('fa-angle-right', 'fa-angle-down')
    } else {
        arrowIcon.classList.replace('fa-angle-down', 'fa-angle-right')
    }
    var menuTitle = e.target.parentElement;
    var subMenu = menuTitle.querySelector('.sub-menu');
    subMenu.classList.toggle('hidden');
}

// fixed Active Menu
function openMenu(subMenu) {
    subMenu.classList.remove('hidden');
    var menuTItle = subMenu.parentElement;
    var arrowIcon = menuTItle.querySelector('.arrow-icon');
    // arrowIcon.classList.add('rotate-90');
    arrowIcon.classList.replace('fa-angle-right', 'fa-angle-down')
}


// Dashboard
const dashboardBtn = document.getElementById('dashboard');
dashboardBtn.addEventListener('click', (e) => {
    dashboardBtn.classList.add('is-active');
})


// 網站設定
const webBtn = document.getElementById('webSetting');
webBtn.addEventListener('click', (e) => {
    // console.log(e.target);
    toggleMenu(e);
});


// 會員管理
const memberBtn = document.getElementById('mamberSetting');
memberBtn.addEventListener('click', (e) => {
    // console.log(e.target);
    toggleMenu(e);
});

// 主題內容管理
const contentBtn = document.getElementById('contentManage');
contentBtn.addEventListener('click', (e) => {
    // console.log(e.target);
    toggleMenu(e);
});

// 課程管理
const courseBtn = document.getElementById('courseManage');
courseBtn.addEventListener('click', (e) => {
    // console.log(e.target);
    toggleMenu(e);
});


// 媒體庫
const mediaBtn = document.getElementById('mediaLibrary');
mediaBtn.addEventListener('click', (e) => {
    mediaBtn.classList.add('is-active');
})


// TODO 留言管理


// 關鍵字管理
const keywordBtn = document.getElementById('keywordManage');
keywordBtn.addEventListener('click', (e) => {
    // console.log(e.target);
    toggleMenu(e);
});


// TODO 廣告管理


// TODO 交易管理
const tradeBtn = document.getElementById('tradeManage');
tradeBtn.addEventListener('click', (e) => {
    // console.log(e.target);
    toggleMenu(e);
});


// 固定 subMenu
const webSettingMenu = document.getElementById('webSettingMenu');
const contentManageMenu = document.getElementById('contentManageMenu');
const keywordMenu = document.getElementById('keywordMenu');


function locationActive(locationName) {
    // console.log('I am here', locationName)
    switch (locationName) {

        // 網站設定
        case ('admin.beauty.pagesetting'):
            openMenu(webSettingMenu);
            // console.log('I am here', locationName)
            break;
        case ('bannersetting.index'):
            openMenu(webSettingMenu);
            // console.log('I am here', locationName)
            break;

        // 主題內容管理
        case ('content.index'):
            openMenu(contentManageMenu);
            // console.log('I am here', locationName)
            break;
        case ('content.edit'):
            openMenu(contentManageMenu);
            // console.log('I am here', locationName)
            break;
        case ('chapter.index'):
            openMenu(contentManageMenu);
            // console.log('I am here', locationName)
            break;
        case ('section.show'):
            openMenu(contentManageMenu);
            // console.log('I am here', locationName)
            break;
        case ('content.create'):
            openMenu(contentManageMenu);
            // console.log('I am here', locationName)
            break;

        // 關鍵字管理
        case ('category.index'):
            openMenu(keywordMenu);
            // console.log('I am here', locationName)
            break;
        case ('keyword.index'):
            openMenu(keywordMenu);
            // console.log('I am here', locationName)
            break;
    }
}

