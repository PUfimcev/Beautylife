import CheckboxVisible from './checkboxVisible';

class RadioPageVisible extends CheckboxVisible {

    #pages;
    #page;

    constructor(){
        super();

        this.#pages = document.querySelectorAll('.full_category .radio-select');

        this.makePageVisible();
        this.handlePageCoockie();
    }

    handlePageCoockie(){

        this.#pages.forEach((elem) => {
            elem.addEventListener('change', (el) => {

                if(el.target.checked) this.setCookie('radioboxes', el.target.id, {'max-age': 600 })
            });
        });

    }

    makePageVisible(){
        if(!this.getCookie('radioboxes') && document.querySelector(`.full_category #page-1`)) {
            (document.querySelector(`.full_category #page-1`)).click();

        }

        const getDataFromCookie = this.getCookie('radioboxes');
        if(!getDataFromCookie) return;
        this.#page = document.querySelector(`.full_category #${getDataFromCookie}`);
        if(!this.#page) return;
        this.#page.checked = true;

    }

    removeStorage(){
        super.removeStorage();

        this.setCookie('radioboxes', "", {
            'max-age': -1
          })

    }

}

export default new RadioPageVisible();
