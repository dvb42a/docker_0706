
let loaderBtn = document.getElementById('loaderBtn');

loaderBtn.addEventListener('click', () => {
    loaderBtn.disable = true;
    loaderBtn.classList.add('loader-btn');
    loaderBtn.innerText = '';
    loaderBtn.innerHTML = '<div class="loader-in-btn"></div>';
})

