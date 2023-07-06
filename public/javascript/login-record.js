const Username=document.getElementById('account');
window.onload=function(){
    var selectHistory = localStorage.getItem('loginHistory');
    var usernameHistory=localStorage.getItem('usernameHistory');

    const PlatformAdmin =document.getElementById('PlatformAdmin');
    const Beauty=document.getElementById('Beauty');
    const Sport=document.getElementById('Sport');

    switch(selectHistory)
    {
        case'PlatformAdmin':
            PlatformAdmin.setAttribute('selected', true);
            break;
        case 'Beauty':
            Beauty.setAttribute('selected', true);
            break;
        case 'Sport':
            Sport.setAttribute('selected', true);
            break;
    }

    Username.value=usernameHistory;
}

const platform=document.getElementById('platform');
const loginBtn=document.getElementById('login');
//console.log(platform.value);
platform.addEventListener("change",function(){
    localStorage.setItem('loginHistory', platform.value);
})

loginBtn.addEventListener('click',function(){
    loginBtn.disable = true;
    loginBtn.classList.add('loader-btn');
    loginBtn.innerText = '';
    loginBtn.innerHTML = '<div class="loader-in-btn"></div>';
    localStorage.setItem('usernameHistory',Username.value);
})

