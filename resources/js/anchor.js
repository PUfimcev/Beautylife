/**
 * Create button anchor for returning page top position
 */

class Anchor {
    #bodyElem;
    #button;
    #widthDoc;

    constructor() {
        this.#bodyElem = document.querySelector('body');
        this.#widthDoc = window.innerWidth;
        this.#getScrollDocument(this.#widthDoc);
        this.#UIAnchor();
        this.#getWidthDoc();
    }

    #getScrollDocument(widthElem){

        if(!widthElem) return;

        window.addEventListener('scroll', () => {

            (window.scrollY > 400) ? this.#getHideAnchor(true, widthElem) : this.#getHideAnchor(false);
        })
    }

    #getWidthDoc(){

        window.addEventListener('resize', () => {
            this.#widthDoc  = window.innerWidth;
            this.#getScrollDocument(this.#widthDoc);
        })
    }


    #UIAnchor(){

            this.#button = document.createElement('button');
            this.#button.classList.add('anchor_depict');
            this.#button.style = "display: none";
            this.#bodyElem.insertBefore(this.#button, document.querySelector('#header__searching'));
            this.#button.addEventListener('click', () => {this.#docuTop()});
    }

    #getHideAnchor(bool, width){

        if(bool) {
            this.#button.style = "display: block";
            if(width != undefined) {
                switch(true) {
                    case width >= 1440 && width < 2560:
                        this.#button.style = "right: 13%";
                    break;
                    case (width >= 2560):
                        this.#button.style = "right: 25%";
                    break;
                    default:
                        this.#button.style = "right: 10%";
                    break;
                }
            }
        } else {
            this.#button.style = "display: none";
        }
    }

    #docuTop(){
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: "smooth",});
    }
}

export default new Anchor();
