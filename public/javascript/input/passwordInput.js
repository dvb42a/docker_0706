
const eyeBtn = document.querySelectorAll('.eyeBtn');
// console.log(eyeBtn);
eyeBtn.forEach(btn => {
    btn.addEventListener('click', (e) => {
        let iconContainer = e.target.parentElement;
        let field = iconContainer.parentElement;
        let passwordInput = field.querySelector('input');
        let icon = field.querySelector('.fa-solid');

        if (icon.classList.contains('fa-eye')) {
            // console.log('open');
            icon.classList.replace('fa-eye', 'fa-eye-slash');
            passwordInput.type = 'text';

        } else {
            // console.log('close');
            icon.classList.replace('fa-eye-slash', 'fa-eye');
            passwordInput.type = 'password';
        }
    })
})
