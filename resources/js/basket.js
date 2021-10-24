document.addEventListener('DOMContentLoaded', function (){
    let products = document.getElementById('products');
    let basketLink = document.getElementById('basket-link');
    let addSingleProduct = document.getElementById('add-product-to-basket');
    let addToBasket = '.btn';

    // localStorage.removeItem('basket');
    let basket = getItem('basket');
    if (basket) {
        let basketItems = JSON.parse(basket);

        if (addSingleProduct && basketItems.hasOwnProperty(addSingleProduct.dataset.id)) {
            addSingleProduct.classList.remove('btn-primary');
            addSingleProduct.classList.add('btn-success');
            addSingleProduct.innerHTML = '<i class="bi bi-cart-check"></i> В корзине';
        }

        if (products) {
            let productsBtns = products.querySelectorAll('.btn');
            for (let i = 0; i < productsBtns.length; i++) {
                if (productsBtns[i].dataset.id && basketItems.hasOwnProperty(productsBtns[i].dataset.id)) {
                    productsBtns[i].classList.remove('btn-primary');
                    productsBtns[i].classList.add('btn-success');
                    productsBtns[i].innerHTML = '<i class="bi bi-cart-check"></i> В корзине';
                }
            }
        }

    }

    if (addSingleProduct) {
        addSingleProduct.addEventListener('click', function (){
            let btn = this;
            let productId = btn.dataset.id ? btn.dataset.id : false;

            if (btn.classList.contains('btn-success')) {
                window.location = btn.dataset.action;
                return false;
            }

            if (productId) {
                if (!basket) {
                    basket = {};
                    basket[productId] = 1;
                } else {
                    basket = JSON.parse(getItem('basket'));
                    // basket[productId] = basket.hasOwnProperty(productId) ? (parseInt(basket[productId]) + 1) : 1;
                    if (!basket.hasOwnProperty(productId)) {
                        basket[productId] = 1;
                    }
                }
                setItem('basket', JSON.stringify(basket));

                let basketItems = JSON.parse(getItem('basket'));
                let basketCount = Object.keys(basketItems).reduce((sum, key) => sum + parseInt(basketItems[key]), 0);
                if (basketLink) basketLink.innerHTML = '<i class="bi bi-cart-fill"></i> Корзина <span class="badge badge-secondary">' + basketCount + '</span>';

                btn.classList.remove('btn-primary');
                btn.classList.add('btn-success');
                btn.innerHTML = '<i class="bi bi-cart-check"></i> В корзине';
            }
        });
    }

    if (products) {
        products.addEventListener('click', function(event){
            let btn = event.target.closest(addToBasket);
            if (btn && btn.classList.contains('btn-success')) {
                window.location = products.dataset.action;
                return false;
            }
            if (btn && products.contains(btn)) {
                let productId = btn.dataset.id ? btn.dataset.id : false;
                if (productId) {
                    if (!basket) {
                        basket = {};
                        basket[productId] = 1;
                    } else {
                        basket = JSON.parse(getItem('basket'));
                        // basket[productId] = basket.hasOwnProperty(productId) ? (parseInt(basket[productId]) + 1) : 1;
                        if (!basket.hasOwnProperty(productId)) {
                            basket[productId] = 1;
                        }
                    }
                    setItem('basket', JSON.stringify(basket));

                    let basketItems = JSON.parse(getItem('basket'));
                    let basketCount = Object.keys(basketItems).reduce((sum, key) => sum + parseInt(basketItems[key]), 0);
                    if (basketLink) basketLink.innerHTML = '<i class="bi bi-cart-fill"></i> Корзина <span class="badge badge-secondary">' + basketCount + '</span>';

                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-success');
                    btn.innerHTML = '<i class="bi bi-cart-check"></i> В корзине';
                }
            }
        });
    }

    function setItem(key, value){
        localStorage.setItem(key, value);
    }
    function getItem(key){
        return localStorage.getItem(key);
    }
});
