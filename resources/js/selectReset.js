// create button to reset data in select form

class ResetSelect {

    #allSelectItems;

    constructor(){
        if(document.querySelectorAll('.form-select').length == 0 && document.querySelectorAll('.form-select') == []) return;

        this.#allSelectItems = document.querySelectorAll('.form-select');
        this.#resetButton();

    }

    #resetButton(){
        this.#allSelectItems.forEach((elem) => {

            let button = elem.closest('div').querySelector('.select_reset-btn');

            if(!button) return;

            button.addEventListener('click', (e) =>{

                let parent = e.currentTarget.closest('.offer__create');
                this.#resetSelect(parent);
            });
        });
    }

    #resetSelect(elem){
        elem.querySelector('select').selectedIndex = -1;
    }

}

export default new ResetSelect();
