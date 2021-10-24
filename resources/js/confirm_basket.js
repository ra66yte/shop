document.addEventListener('DOMContentLoaded', function () {
    let basketTable = document.getElementById('basket-table');
    let addOrder = document.getElementById('add-order');
    let formGuest = document.getElementById('guest-form');
    let tbody = basketTable.getElementsByTagName('tbody')[0];
    let tfoot = basketTable.getElementsByTagName('tfoot')[0];
    let btns = '.btn';
    let basket = localStorage.getItem('basket');

    if (basket) {
        axios
            .post(basketTable.dataset.action, {ids: basket})
            .then(response => {
                let products = response.data.products;
                if (products) {
                    let trProducts = '';
                    let totalAmount = 0;
                    for (key in products) {
                        trProducts += ('<tr data-id="' + products[key].id + '" data-available="' + products[key].available + '">' +
                            '<td><img src="' + products[key].image + '" width="75px" alt="img"></td>' +
                            '<td><a href="' + products[key].route + '" class="card-link">' + products[key].title + '</a></td>' +
                            '<td>' +
                            '<button type="button" class="btn btn-danger mr-2 p-1" data-action="minus"><i class="bi bi-dash"></i></button>' +
                            '<span data-name="count">' + products[key].count + '</span>' +
                            '<button type="button" class="btn btn-success ml-2 p-1" data-action="plus"><i class="bi bi-plus"></i></button>' +
                            ' <span class="text-secondary">/ <b data-name="price">' + products[key].amount + '</b></span>' +
                            '</td>' +
                            '<td data-name="amount">' + (products[key].count * products[key].amount).toFixed(2) + '</td>' +
                            '</tr>');
                        totalAmount += (products[key].count * products[key].amount);
                    }
                    tbody.innerHTML = trProducts;
                    tfoot.innerHTML = ('<tr>' +
                        '<td colspan="3" class="text-right">К оплате:</td>' +
                        '<td class="text-center"><h4 class="mb-0"><b class="text-success" data-name="total-amount">' + totalAmount.toFixed(2) + '</b></h4></td>' +
                        '</tr>');
                    addOrder.closest('div').classList.remove('d-none');
                    formGuest.classList.remove('d-none');
                }
            });
    }

    addOrder.addEventListener('click', function () {
        let basket = localStorage.getItem('basket');
        if (basket) {
            let name = document.getElementById('name') ? document.getElementById('name').value : null;
            let email = document.getElementById('email') ? document.getElementById('email').value : null;
            axios
                .post(addOrder.dataset.action, {ids: basket, name: name, email: email})
                .then(response => {
                    console.log(response)
                    if (response.data.success) {
                        setCookie('success', response.data.success);
                        localStorage.removeItem('basket'); // O da, nakonec-to
                    } else {
                        setCookie('error', response.data.error);
                    }
                    window.location = response.data.route ? response.data.route : '/?no_route';
                });
        }
    });

    tbody.addEventListener('click', function (event) {
        // Кнопки добавить/убрать товар
        let btn = event.target.closest(btns);
        if (btn && tbody.contains(btn) && btn.dataset.action) {
            let basket = localStorage.getItem('basket');
            let tr = btn.closest('tr');
            let countSpan = btn.closest('td').querySelector('span');
            let count = Number(countSpan.textContent);

            removeRequestMessages();

            if (btn.dataset.action === 'minus') {
                --count;
                if (count === 0) {
                    tr.remove();
                    let lastTr = tbody.querySelector('tr');
                    if (!lastTr) {
                        tbody.innerHTML = ('<tr>' +
                            '<td colspan="4" class="text-center p-5">В корзине нет товаров. Давайте это <a href="' + (tbody.dataset.action ? tbody.dataset.action : '/?') + '">исправим</a>!</td>' +
                            '</tr>');
                        tfoot.innerHTML = '';
                    }
                }
            } else {
                if (count < tr.dataset.available) {
                    ++count;
                } else {
                    showRequestMessage('Этого товара осталось ' + tr.dataset.available + ' ед.', 'danger');
                }
            }

            countSpan.innerText = count; // Меняем значение количества

            let basketItems = JSON.parse(basket);
            if (count === 0) {
                delete basketItems[tr.dataset.id];
            } else {
                basketItems[tr.dataset.id] = count;
            }

            if (!Object.keys(basketItems).length) {
                localStorage.removeItem('basket');
            } else {
                localStorage.setItem('basket', JSON.stringify(basketItems));
            }
            calculateTotalAmount();
        }
    });

    function calculateTotalAmount() {
        let trs = tbody.querySelectorAll('tr[data-id]');
        let basketLink = document.getElementById('basket-link');

        if (trs.length) {
            let newTotalAmount = 0;
            for (let i = 0; i < trs.length; i++) {
                let newAmount = Number(trs[i].querySelector('span[data-name="count"]').textContent) * Number(trs[i].querySelector('b[data-name="price"]').textContent);
                trs[i].querySelector('td[data-name="amount"]').innerText = newAmount.toFixed(2);
                newTotalAmount += newAmount;
            }

            tfoot.querySelector('b[data-name="total-amount"]').innerText = newTotalAmount.toFixed(2)
        }

        let basket = localStorage.getItem('basket');
        if (basket) {
            let basketItems = JSON.parse(basket);
            let basketCount = Object.keys(basketItems).reduce((sum, key) => sum + parseInt(basketItems[key]), 0);
            if (basketLink) basketLink.innerHTML = '<i class="bi bi-cart-fill"></i> Корзина <span class="badge badge-secondary">' + basketCount + '</span>';
        } else {
            if (basketLink) basketLink.innerHTML = '<i class="bi bi-cart"></i> Корзина';
            addOrder.closest('div').classList.add('d-none');
            if (formGuest) formGuest.classList.add('d-none');
        }


    }

});

