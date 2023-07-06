// Loader
const loader = document.getElementById('loader');
const mainContent = document.getElementsByClassName('main-content');

function onReady(callback) {
    var intervalId = window.setInterval(function () {
        if (mainContent[0] !== undefined) {
            window.clearInterval(intervalId);
            callback.call(this);
        }
    }, 1000);
}

function setVisible(selector, visible) {
    document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

function removeLoader() {
    loader.classList.add('hidden');
}
