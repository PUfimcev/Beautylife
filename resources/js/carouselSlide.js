class CarouselSlide{

    #mainProductImages;
    #barProductImages;
    #widthElemInBar;
    #getArrowSlide;

    constructor(){
        this.#mainProductImages = document.querySelectorAll('.carousel_item-main');
        this.#barProductImages = document.querySelectorAll('.carousel_item-bar');

        this.#getArrowSlide = document.querySelector('.carousel_arrow');

        if(this.#getArrowSlide) this.#handleArrowSlide();

        this.#widthElemInBar = window.getComputedStyle(this.#barProductImages[0]).width;

        if(this.#mainProductImages.length == 0 && this.#barProductImages.length == 0) return;

        this.#showPicture();
    }


    #showMainPicture(data){

        this.#mainProductImages.forEach((elem) => {

            elem.classList.remove('active');

        })

        document.querySelector(`.carousel_item-main[data-id='${data}']`).classList.add('active');

    }

    #showPicture(){
        this.#barProductImages.forEach((elem) => {
            elem.addEventListener('click', (e) =>{
                let dataId = e.currentTarget.dataset.id;

                this.#barProductImages.forEach((elem) =>{
                    elem.classList.remove('active');
                })

                e.currentTarget.classList.add('active');

                this.#showMainPicture(dataId)
            })
        })
    }

    #handleArrowSlide(){
        this.#getArrowSlide.addEventListener('click', () =>{

        })
    };

}

export default new CarouselSlide();
