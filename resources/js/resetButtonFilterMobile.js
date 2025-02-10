class ResetButtonFilterMobile{

    #resetButton;

    constructor(){
        this.#resetButton = document.querySelector('.reset__btn-mobile');

        if(!this.#resetButton) return;

        this.#resetElements();

    }

    #resetElements(){

        this.#resetButton.addEventListener('click', ()=>{


            const allMobileInputs = document.querySelectorAll('.filter__products-mobile input[type="checkbox"]');

            const allMobileRadio = document.querySelectorAll('.select_goods_wrap-mobile input[type="radio"]');

            allMobileInputs.forEach((elem) => {
                if(elem.checked) elem.checked = false;
            });

            allMobileRadio.forEach((elem) => {
                if(elem.checked) elem.checked = false;
            });

            allMobileRadio[0].checked = true;

            const priceFrom = document.querySelector('.price__from__to_box-mobile .price_from-elem input[type="text"]');

            if(priceFrom) priceFrom.value = '';

            const priceTo = document.querySelector('.price__from__to_box-mobile .price_to-elem input[type="text"]');

            if(priceTo) priceTo.value = '';

        })
    }
}

export default new ResetButtonFilterMobile();
