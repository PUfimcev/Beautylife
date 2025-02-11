class ShowHideMobileFilterBlock{

    #showHideMobileFilterButton;
    #mobileFilterBlock;
    #fullCategoryTopMobile;
    #fullCategoryBody;
    #categoryViewAllProductButton;
    #categoryPagination;
    #fullCategoryBottom;
    #cancelCategoryBottom;


    constructor(){
        this.#showHideMobileFilterButton = document.getElementById('category__filter-top-mobile');
        this.#mobileFilterBlock = document.getElementById('category__filter-mobile');
        this.#fullCategoryTopMobile = document.querySelector('.full_category-top-mobile') || null;
        this.#fullCategoryBody = document.querySelector('.full_category-body') || null;
        this.#categoryViewAllProductButton = document.querySelector('.view-all__btn') || null;
        this.#categoryPagination = document.querySelector('.pagination') || null;
        this.#fullCategoryBottom = document.querySelector('.full_category-bottom') || null;
        this.#cancelCategoryBottom = document.querySelector('.navbar__cancel-icon.category_mobile') || null;

        if(!this.#showHideMobileFilterButton || !this.#mobileFilterBlock) return;

        if(window.matchMedia("screen and (max-width: 768px)").matches) this.#showHideMobileFilterButton.style.display = 'block';


        this.#handleButton();
        // this.#handleCancelButton();
        this.#windowResize();

    }

    #handleButton(){
        this.#showHideMobileFilterButton.addEventListener('click', (e)=>{
            e.target.style.display = 'none';

            this.#mobileFilterBlock.classList.add('open');

            if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'none';
            if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'none';
            if(this.#fullCategoryBody) this.#fullCategoryBody.style.display = 'none';
            if(this.#categoryViewAllProductButton) this.#categoryViewAllProductButton.style.display = 'none';
            if(this.#categoryPagination) this.#categoryPagination.style.display = 'none';
            if(this.#fullCategoryBottom) this.#fullCategoryBottom.style.display = 'none';

        })
    }

    // #handleCancelButton(){
    //     this.#cancelCategoryBottom.addEventListener('click', ()=>{
    //         this.#mobileFilterBlock.classList.remove('open');

    //         this.#showHideMobileFilterButton.style.display = 'block';

    //         if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'block';
    //         if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'block';
    //         if(this.#fullCategoryBody) this.#fullCategoryBody.style.display = 'flex';
    //         if(this.#categoryViewAllProductButton) this.#categoryViewAllProductButton.style.display = 'block';
    //         if(this.#categoryPagination) this.#categoryPagination.style.display = 'block';
    //         if(this.#fullCategoryBottom) this.#fullCategoryBottom.style.display = 'flex';

    //     })
    // }

    #windowResize(){
        window.addEventListener('resize', () => {
        if(window.matchMedia("screen and (max-width: 768px)").matches) {

            if(this.#mobileFilterBlock.className !== 'open') this.#showHideMobileFilterButton.style.display = 'block';

        } else if(window.matchMedia("screen and (min-width: 769px)").matches){
            this.#mobileFilterBlock.classList.remove('open');
            this.#showHideMobileFilterButton.style.display = 'none';
            if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'block';
            if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'block';
            if(this.#fullCategoryBody) this.#fullCategoryBody.style.display = 'flex';
            if(this.#categoryViewAllProductButton) this.#categoryViewAllProductButton.style.display = 'block';
            if(this.#categoryPagination) this.#categoryPagination.style.display = 'block';
            if(this.#fullCategoryBottom) this.#fullCategoryBottom.style.display = 'flex';
        }

        });
    }

}

export default new ShowHideMobileFilterBlock();
