document.querySelectorAll('.button.leaf-outline').forEach(btn => {
    btn.addEventListener('click', (event) => {
        const self = event.currentTarget;
        const modal = document.querySelector(`${self.getAttribute('href')}`);
        modal.querySelector(`.book-title`).innerText = self.getAttribute('book-title');
        modal.querySelector(`input[name='book-name']`).value = self.getAttribute('book-title');
    });
})