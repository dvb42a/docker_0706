
const clearBtn = document.querySelectorAll('.clearBtn');

clearBtn.forEach(btn => {
    btn.addEventListener('click', (e) => {
        // console.log(e.target);
        let iconContainer = e.target.parentElement;
        let field = iconContainer.parentElement;
        let input = field.querySelector('input');
        // console.log(input);

        input.value = '';

    });
})
