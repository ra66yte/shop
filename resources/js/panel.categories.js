document.addEventListener('DOMContentLoaded', function () {

    let btn = document.getElementById('edit');
    let save = document.getElementById('save');
    let del = document.getElementById('delete');
    let p = document.querySelectorAll('.text');
    let inp = document.querySelectorAll('.inp');
    let labels = document.querySelectorAll('label');
    let header = document.querySelector('.card-header');
    let id = document.getElementById('category-id').value;

    let title = document.getElementById('title');
    let alias = document.getElementById('alias');

    let fields = document.querySelectorAll('input.form-control, textarea.form-control');

    title.addEventListener('input', function () {
        if (title.value === '') alias.value = '';

        axios
            .post(alias.dataset.action, {str: {'alias': title.value}})
            .then(response => {
                if (response.data.alias) alias.value = response.data.alias;
            });
    });


    btn.addEventListener('click', function () {

        for (let i = 0; i < p.length; i++) {
            p[i].classList.add('d-none');
        }

        for (let i = 0; i < inp.length; i++) {
            inp[i].classList.remove('d-none');
            labels[i].classList.remove('d-none');
        }

        save.classList.remove('d-none');
        del.classList.remove('d-none');
        this.classList.add('d-none');

    });

    save.addEventListener('click', function () {
        let errors = checkErrors();
        if (Object.keys(errors).length) {
            showErrors(errors);
            return false;
        }

        let data = {};

        data['id'] = id;
        for (let i = 0; i < inp.length; i++) {
            data[inp[i].name] = inp[i].value;
        }
        axios
            .post(this.dataset.action, data)
            .then(response => {
                if (response.data.errors) {
                    showErrors(response.data.errors);
                } else {
                    p[0].innerText = 'Подчиняется: ' + response.data.parent;
                    p[1].innerText = 'Название: ' + response.data.title;
                    p[2].innerText = 'Алиас: ' + response.data.alias;
                    p[3].innerText = 'Описание: ' + response.data.description;
                    for (let i = 0; i < p.length; i++) {
                        p[i].classList.remove('d-none');
                    }
                    for (let i = 0; i < inp.length; i++) {
                        inp[i].classList.add('d-none');
                        labels[i].classList.add('d-none');
                    }

                    btn.classList.remove('d-none');
                    del.classList.add('d-none');
                    this.classList.add('d-none');

                    header.innerText = 'Редактирование категории "' + response.data.title + '"';

                    showRequestMessage('Изменения сохранены.');
                }
            });
    });

    del.addEventListener('click', function () {
        axios
            .post(this.dataset.action, {id: id})
            .then(response => {
                if (response.data.success) setCookie('success', response.data.success);
                window.location = response.data.route;
            });
    });

    function checkErrors() {
        clearErrors(fields);

        let errors = {};
        let title = document.getElementById('title');
        let desc = document.getElementById('desc');

        for (let i = 0; i < inp.length; i++) {
            errors[inp[i].name] = [];
            if (i > 0 && !inp[i].value) {
                errors[inp[i].name].push('Необходимо указать ' + inp[i].dataset.name.toLowerCase() + '.');
            }
        }

        if (title.value.length < 2) {
            errors['title'].push('Название должно содержать не менее 2 символов.');
        } else if (title.value.length > 60) {
            errors['title'].push('Название может содержать не более 60 символов.');
        } /*else {

            const exists = () => {
                return axios
                    .post(title.dataset.action, {id: id, title: title.value})
                    .then(response => {
                        return response.data;
                    });
            }

            exists().then(data => {
                if (data !== '') {
                    let titleNextSpan = title.nextElementSibling;
                    title.classList.add('is-invalid');
                    titleNextSpan.querySelector('strong').innerText = 'Категория с таким названием уже есть.';
                    // errors['title'].push('Категория с таким названием уже есть.'); // I can't und

                }
            })
        }*/

        if (desc.value.length < 10) {
            errors['desc'].push('Описание должно содержать не менее 10 символов.');
        } else if (desc.value.length > 255) {
            errors['desc'].push('Описание может содержать не более 255 символов.');
        }

        errors = Object.keys(errors)
            .filter(key => Array.isArray(errors[key]) && errors[key].length !== 0)
            .reduce((acc, key) => {acc[key] = errors[key]; return acc}, {});

        return errors;
    }

});


