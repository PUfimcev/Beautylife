import CheckboxVisible from './checkboxVisible';

class InputPricesVisible extends CheckboxVisible {

    #selecPriceFromInCategoryFilter;
    #selecPriceToInCategoryFilter;

    constructor(){
        super();

        this.#selecPriceFromInCategoryFilter = document.getElementById('price_from');
        this.#selecPriceToInCategoryFilter = document.getElementById('price_to');

        if(!this.#selecPriceFromInCategoryFilter && !this.#selecPriceToInCategoryFilter) return;

        this.handleInputCoockie();
    }

    handleInputCoockie(){

        if(this.#selecPriceFromInCategoryFilter.value !== '' || this.#selecPriceToInCategoryFilter.value !== ''){
            this.#selecPriceFromInCategoryFilter.closest('.subcategory__names.price').classList.add('open');
        } else {
            this.#selecPriceFromInCategoryFilter.closest('.subcategory__names.price').classList.remove('open');
        }

    }

}

export default new InputPricesVisible();
