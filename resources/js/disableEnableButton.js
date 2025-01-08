
/**
 * Description placeholder
 *
 * @class DisableEnableButton
 * @typedef {DisableEnableButton}
 */
class DisableEnableButton{

    /**
     * Description placeholder
     *
     * @type {*}
     */
    #button;


    /**
     * Description placeholder
     *
     * @type {{}}
     */
    #checkboxes = [];

    /**
     * Creates an instance of DisableEnableButton.
     *
     * @constructor
     */

    constructor(){

        this.#button = document.getElementById('btn__product_img_remove');
        this.#checkboxes = document.querySelectorAll('.product__image_checkbox');

        if(this.#button === undefined || this.#checkboxes === undefined || this.#button === null || this.#checkboxes === null) return;


        this.#watchCheckboxes();

    }

    #watchCheckboxes(){

        let arrayInputs = [];


        this.#checkboxes.forEach(element => {

            element.addEventListener('change', (e) => {
                if(e.target.checked == true) {
                    arrayInputs.push(e.target);
                } else {
                    arrayInputs = arrayInputs.filter((e) =>{
                        return e.checked == true;
                    })
                };

                this.#button.disabled = (arrayInputs.length > 0) ? false : true;
            });

        });

    };

}

export default new DisableEnableButton();
