document.addEventListener('DOMContentLoaded', function(){

    let btn = document.getElementById('edit');
    let save = document.getElementById('save');
    let del = document.getElementById('delete');
    let p = document.querySelectorAll('.text');
    let inp = document.querySelectorAll('.inp');
    let header = document.querySelector('.card-header');

    btn.addEventListener('click', function(){

        for (let i = 0; i < p.length; i++) {
            p[i].classList.add('d-none');
        }

        for (let i = 0; i < inp.length; i++) {
            inp[i].classList.remove('d-none');
        }

        save.classList.remove('d-none');
        this.classList.add('d-none');

    });

    save.addEventListener('click', function() {
        let data = {};
        for (let i = 0; i < inp.length; i++) {
            data[inp[i].name] = inp[i].value;
        }
        axios
            .post(this.dataset.action, data)
            .then(response => {
                p[0].innerText = response.data.title;
                p[1].innerText = response.data.description;
                for (let i = 0; i < p.length; i++) {
                    // if (p[i].dataset.title) p[i].innerText = response.data.title;
                    // if (p[i].dataset.desc) p[i].innerText = response.data.description;
                    p[i].classList.remove('d-none');
                    console.log(p[i].dataset.title)
                }
                for (let i = 0; i < inp.length; i++) {
                    inp[i].classList.add('d-none');
                }
                save.classList.add('d-none');
                btn.classList.remove('d-none');

                header.innerText = response.data.title;

            });

    });

    del.addEventListener('click', function() {

        axios
            .post(this.dataset.action, {id: document.getElementById('category-id').value})
            .then(response => {
                window.location = response.data;
            });
    });

});

