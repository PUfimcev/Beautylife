/**
 * To create mask for input field of type tel
 */

class MaskInputTel{

    #inputTypeTel = null;

    constructor(){
        const inputField = document.querySelector('#phone');

        if(inputField !== null){

            this.#inputTypeTel = inputField;
        }
        this.#transfigureInputValue();
    }

    #transfigureInputValue(){

        if( this.#inputTypeTel !== null){

            this.#inputTypeTel.addEventListener('input', (e) => {this.#handleInput(e)});
        }
    }

    #handleInput(e){

        e.currentTarget.value = this.#useMaskPhone(e.currentTarget.value).slice(0, 17);
    }

    #useMaskPhone(data){
        return data.replace(/\D/g, '')
        .replace(/^(\d)/g, '+$1')
        .replace(/^(\+\d{3})(\d)/g, '$1 $2')
        .replace(/^(\+\d{3}\s\d{2})(\d)/g, '$1 $2')
        .replace(/^(\+\d{3}\s\d{2}\s\d{3})(\d)/g, '$1 $2')
        .replace(/^(\+\d{3}\s\d{2}\s\d{3}\s\d{2})(\d)/g, '$1 $2')
        .replace(/^(\+\d{3}\s\d{2}\s\d{3}\s\d{2}\s\d{2})(\d+?)/g, '$1');
    }
}

export default new MaskInputTel();
