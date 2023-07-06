

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


// 管理員帳號管理
const adminAccountBtn = document.getElementById('adminAccountManage');
adminAccountBtn.addEventListener('click', (e) => {
    console.log(e.target);
    toggleMenu(e);
});


// 固定 subMenu
const adminAccountMenu = document.getElementById('adminAccountMenu');

function locationActive(locationName) {
    // console.log('I am here', locationName)
    switch (locationName) {

        // 管理員帳號列表
        case ('admins.index'):
            openMenu(adminAccountMenu);
            // console.log('I am here', locationName)
            break;


    }
}

