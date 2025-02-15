class ShowHideMobileFilterBlock{

    #showHideMobileFilterButton;
    #mobileFilterBlock;
    #fullCategoryTopMobile;
    #fullCategory;
    #cancelCategoryButton;
    #applyCategoryButton;

    constructor(){
        this.#showHideMobileFilterButton = document.getElementById('category__filter-top-mobile');
        this.#mobileFilterBlock = document.querySelector('.filer__mobile');
        this.#fullCategory = document.querySelector('.full_category') || null;
        this.#fullCategoryTopMobile = document.querySelector('.full_category-top-mobile') || null;
        this.#cancelCategoryButton = document.querySelector('.navbar__cancel-icon.category_mobile') || null;
        this.#applyCategoryButton = document.querySelector('.apply__btn') || null;

        if(!this.#showHideMobileFilterButton || !this.#mobileFilterBlock) return;

        if(window.matchMedia("screen and (max-width: 768px)").matches)  setTimeout(()=>{

            this.#showHideMobileFilterButton.style.display = 'block';
        }, 100)

        this.#handleButton();
        this.#handleCancelButton();
        this.#handleApplyButton();
        this.#windowResize();

    }

    #handleButton(){
        this.#showHideMobileFilterButton.addEventListener('click', async (e)=>{
            e.target.style.display = 'none';

            this.#mobileFilterBlock.style.display = 'block';
            window.scrollTo({
                top: this.#fullCategory.scrollHeight,
                left: 0,
                behavior: "smooth",
            });

            setTimeout(async ()=>{
                this.#showHideProductsElements(false);
            }, 1000)

            sessionStorage.setItem('mobile-filter', 'open');

        })
    }

    #handleCancelButton(){
        if(this.#cancelCategoryButton !== null) {

            this.#cancelCategoryButton.addEventListener('click', ()=>{

                sessionStorage.removeItem('mobile-filter');

            })
        }
    }

    #handleApplyButton(){

        if(this.#applyCategoryButton !== null) {

            this.#applyCategoryButton.addEventListener('click', ()=>{

                sessionStorage.removeItem('mobile-filter');

            })
        }
    }

    #windowResize(){
        window.addEventListener('resize', () => {
            if(innerWidth <= 768) {

                if(sessionStorage.getItem('mobile-filter') === 'open') {


                    this.#showHideProductsElements(false);
                    this.#mobileFilterBlock.style.display = 'block';
                    window.scrollTo(0, 0);
                    // this.#showHideMobileFilterButton.style.display = 'none';
                    this.#mobileFilterBlock.classList.add('open');

                } else {
                    this.#mobileFilterBlock.style.display = 'none';
                    this.#mobileFilterBlock.classList.remove('open');
                    if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'block';
                }

                if(this.#mobileFilterBlock.classList.contains('open')){
                    this.#showHideMobileFilterButton.style.display = 'none';
                } else {
                    setTimeout(()=>{

                        this.#showHideMobileFilterButton.style.display = 'block';
                    }, 100)
                }


            } else {
                this.#mobileFilterBlock.style.display = 'none';
                this.#mobileFilterBlock.classList.remove('open');
                this.#showHideMobileFilterButton.style.display = 'none';
                this.#showHideProductsElements(true);
            }

        });
    }

    #showHideProductsElements(bool){
        if(bool){

            if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'none';
            if(this.#fullCategory) {
                window.scrollTo(0, 0);
                this.#fullCategory.style.transform = '';
                this.#fullCategory.style.display = 'block';

            }

        } else {

            if(this.#fullCategoryTopMobile) this.#fullCategoryTopMobile.style.display = 'none';
            if(this.#fullCategory) this.#fullCategory.style.display = 'none';
        }
    }
}

export default new ShowHideMobileFilterBlock();
