document.addEventListener('DOMContentLoaded', function () {
    let title = document.getElementById('title');
    let alias = document.getElementById('alias');

    title.addEventListener('input', function () {
        if (title.value === '') alias.value = '';

        axios
            .post(alias.dataset.action, {str: title.value})
            .then(response => {
                if (response.data.alias) alias.value = response.data.alias;
            });
    });
});
