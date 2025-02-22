class IncreaseReduceProductAmount{

    #plusButtons;
    #minusButtons;
    #amountOptionInputs;

    constructor(){
        this.#minusButtons = document.querySelectorAll('.minus_product');
        this.#plusButtons =  document.querySelectorAll('.plus_product');

        this.#amountOptionInputs = document.querySelectorAll('.amount_option_value');

        if(this.#minusButtons.length == 0 && this.#plusButtons.length == 0 && this.#amountOptionInputs.length == 0) return;

        this.#handleButtonsMinus();
        this.#handleButtonsPlus();
        this.#checkInputs();
    }


    #checkInputs(){
        this.#amountOptionInputs.forEach((elem) => {

            elem.value = '1';

            elem.addEventListener('input', (e)=>{
                let regExp = /\D/i;

                if(e.target.value == '')  e.target.value = e.target.value.replace( '', '1');
                if (e.target.value == 0) e.target.value = e.target.value.replace( '0', '1');

                e.target.value = e.target.value.replace(regExp, '').slice(0, 3);
            })
        })
    }


    handleInputValue = (e) =>{
        this.#amountOptionInputs.forEach((elem) => {

            let valueTmp = +elem.value;

            let step = (e.target.className === 'plus_product') ? 1 : -1;

            valueTmp += step;

            elem.value = (valueTmp < 1) ? 1 : valueTmp;

        })
    }

    #handleButtonsMinus(){
        this.#minusButtons.forEach((elem) => {
            elem.addEventListener('click',  this.handleInputValue);
        })
    }

    #handleButtonsPlus(){
        this.#plusButtons.forEach((elem) => {
            elem.addEventListener('click',  this.handleInputValue);
        })
    }

}

export default new IncreaseReduceProductAmount();
