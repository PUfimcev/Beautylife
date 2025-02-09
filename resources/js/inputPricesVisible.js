import CheckboxVisible from './checkboxVisible';

class InputPricesVisible extends CheckboxVisible {

    #selecPriceFromInCategoryFilter;
    #selecPriceToInCategoryFilter;
    #closestToPriceFilterItemsElem;

    constructor(){
        super();

        this.#closestToPriceFilterItemsElem = document.querySelector('.subcategory__names.price');
        this.#selecPriceFromInCategoryFilter = document.getElementById('price_from');
        this.#selecPriceToInCategoryFilter = document.getElementById('price_to');

        if(!this.#selecPriceFromInCategoryFilter && !this.#selecPriceToInCategoryFilter) return;

        // this.handleInputCoockie();
    }

    handleInputCoockie(){

        if(this.#selecPriceFromInCategoryFilter.value !== '' || this.#selecPriceToInCategoryFilter.value !== ''){

            this.#closestToPriceFilterItemsElem.classList.add('open');

        } else {

            this.#closestToPriceFilterItemsElem.classList.remove('open');
        }

    }

}

export default new InputPricesVisible()
