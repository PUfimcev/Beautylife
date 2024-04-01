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

        // if(this.#mainElemWeb) {
        //     this.#fixElem('web');
        // } else if(this.#mainElemAdmin) {
        //     this.#fixElem('admin');
        // } else {
        //     return
        // }

    }

    #fixElem(place = null){

        window.addEventListener('scroll', () =>{

            if(window.scrollY > this.#headerElem.offsetTop){

                this.#headerElem.classList.add('header_fixed');

                switch(place){
                    case 'web':
                        this.#mainElem.style = 'margin-top: 234px';
                    break;
                    case 'admin':
                        this.#mainElem.style = 'margin-top: 98px';
                    break;
                }
            } else {
                this.#headerElem.classList.remove('header_fixed');
                this.#mainElem.style = 'margin-top: 0px';
            }
        });
    }

}

export default new HeaderFix();
