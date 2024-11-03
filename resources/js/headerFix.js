/**
 * To transfix header as page gets scrolled
 */

class HeaderFix {
    #body = null;
    #headerElem = null;
    #mainElem = null;
    #mainElemWeb = null;
    #mainElemAdmin = null;

    constructor(){
        this.#body = document.querySelector('body');
        this.#headerElem = document.querySelector('header');
        this.#mainElem = document.querySelector('main');
        this.#mainElemWeb = document.querySelector('.main-web');
        this.#mainElemAdmin = document.querySelector('.main-admin');


        if(this.#headerElem == null || this.#mainElem == null) return;

       ((this.#mainElemWeb && this.#fixElem('web')) || (this.#mainElemAdmin && this.#fixElem('admin')));

    }

    /**
     * Description placeholder
     *
     * @param {*} [place=null]
     */
    #fixElem(place = null){

        window.addEventListener('scroll', () =>{

            if(window.scrollY > this.#headerElem.offsetTop){

                this.#headerElem.classList.add('header_fixed');

                if(place == 'web'){

                    if(window.matchMedia("screen and (min-width: 769px) and (max-width: 1023px)").matches){
                            this.#mainElem.style = 'margin-top: 166px';
                    } else if(window.matchMedia("screen and (max-width: 768px)").matches) {
                            this.#mainElem.style = 'margin-top: 170px';
                    } else {
                            // console.log('margin-top: 0px');
                            this.#mainElem.style = 'margin-top: 174px';
                    }
                }
                if(place == 'admin') this.#mainElem.style = 'margin-top: 164px';

            } else {
                this.#headerElem.classList.remove('header_fixed');
                this.#mainElem.style = 'margin-top: 0px';
            }
        });
    }

}

export default new HeaderFix();
