document.getElementById('filter-form').addEventListener('submit', function () {
    const inputs = this.querySelectorAll('input');
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            input.removeAttribute('name');
        }
    });
});
