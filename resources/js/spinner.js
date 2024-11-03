/**
 * Description placeholder
 *
 * @class Spinner
 * @typedef {Spinner}
 */
class Spinner{
    #create(){
        this.spinner = document.createElement('div');
        this.spinner.classList.add('spinner');
        this.spinner.innerHTML = `
            <div class="spinner-img"></div>
            <p>Loading...</p>
        `;

        return this.spinner;
    }


    /**
     * Description placeholder
     *
     * @returns {*}
     */
    init(){
        let spinnerData = this.#create();
        return spinnerData;
    }

}

export default new Spinner();
