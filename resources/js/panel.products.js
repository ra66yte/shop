document.addEventListener('DOMContentLoaded', function () {

    let form = document.getElementById('add-product-form') ? document.getElementById('add-product-form') : document.getElementById('update-product-form');
    let title = document.getElementById('title');
    let alias = document.getElementById('alias');
    let images = document.getElementById('images');
    let show = document.getElementById('show');
    let fields = document.querySelectorAll('input.form-control, input.form-control-file, textarea.form-control, select.form-control');
    let clear = '.products__image-clear';
    let arrImages = [];

    form.addEventListener('submit', (event) => {
        event.stopPropagation();
        event.preventDefault();

        clearErrors(fields);

        let dataFields = document.querySelectorAll('.form-control');

        let data = new FormData();

        for (let i = 0; i < dataFields.length; i++) {
            data.append(dataFields[i].name, dataFields[i].value);
        }

        for (let i = 0; i < arrImages.length; i++) {
            data.append('images[' + i + ']', arrImages[i]);
        }

        if (document.getElementById('update-product-form')) {
            let oldImages = [];
            let allOldImages = show.querySelectorAll('.products__images-item');

            for (let i = 0; i < allOldImages.length; i++) {
                if (allOldImages[i].dataset.id) oldImages.push(allOldImages[i].dataset.id); // Получаем все старые изображения
            }

            data.append('old_images', oldImages);
            data.append('id', document.getElementById('product-id').value);


        }
        axios
            .post(form.action, data, { headers: { 'Content-Type': 'multipart/form-data' }})
            .then(response => {
                if (response.data.errors) {
                    showErrors(response.data.errors);
                } else {
                    if (response.data.success) setCookie('success', response.data.success);
                    window.location = response.data.route;
                }

            });

    });


    show.addEventListener('click', function(event) {
        let closest = event.target.closest(clear);

        if (closest && show.contains(closest)) {
            let imageItem = closest.parentElement.parentElement;
            let imageItemIndex = imageItem.dataset.index;

            arrImages.splice(imageItemIndex, 1);
            imageItem.remove();

            let elems = show.querySelectorAll('.products__images-item');
            let image_items = Array.from(elems).filter(el => !el.dataset.id);

            if (image_items.length) {
                for (let i = 0; i < image_items.length; i++) {
                    image_items[i].dataset.index = i;
                }
            } else {
                images.value = '';
            }

        }
    });

    title.addEventListener('input', function () {
        axios
            .post(alias.dataset.action, {str: title.value})
            .then(response => {
                if (response.data.alias) alias.value = response.data.alias;
            });
    });


    images.addEventListener('change', function () {
        clearImages();
        if (checkErrors(this)) showImages(this);
    });

    function checkErrors(inputFiles) {
        images.classList.remove('is-invalid');
        let errorMessage = document.getElementById('image-error');
        if (errorMessage) errorMessage.remove();

        let items = inputFiles.files;
        let maxSize = 1024 * 1024 * 2;
        let errors = [];

        if (items.length > 10) {
            errors.push('Максимальное количество изображений 10 шт.');
        }

        for (let i = 0; i < items.length; i++) {
            let size0 = items[i].size;
            if (size0 > maxSize) {
                errors.push('Максимальный размер загружаемого изображения 2 Mb.');
            }

            let type = items[i].type;
            if (type === 'image/png' || type === 'image/bmp' || type === 'image/jpeg') {

            } else {
                errors.push('Разрешены только изображения в формате png, bmp и jpeg.');
            }
        }
        if (errors.length > 0) {
            images.value = '';
            images.classList.add('is-invalid');
            images.insertAdjacentHTML('afterend', '<span id="image-error" class="invalid-feedback" role="alert">\n' +
                '<strong>' + errors[0] + '</strong>\n' +
                '</span>');
            return false;
        }
        return true;
    }

    function clearImages() {
        let items = show.querySelectorAll('.products__images-item')
        if (items.length) {
            for (let i = 0; i < items.length; i++) {
                if (!items[i].dataset.id) {
                    items[i].remove();
                }
            }
        }
    }

    function showImages(inputFiles) {

        let images = inputFiles.files;
        arrImages = Array.from(images);

        for (let i = 0; i < images.length; i++) {
            let reader = new FileReader(images[i]);

            reader.onload = function (e) {
                let card = document.createElement('div');

                card.classList.add('products__images-item');
                card.dataset.index = i;
                card.innerHTML = '<div class="products__image"><span class="products__image-clear" title="Удалить">×</span></div>';
                card.querySelector('.products__image').style.backgroundImage = 'url(' + e.target.result + ')';

                show.insertAdjacentElement('beforeend', card);

            };

            reader.readAsDataURL(images[i]);
        }

    }
});
