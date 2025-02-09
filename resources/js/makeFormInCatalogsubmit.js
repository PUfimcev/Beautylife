class MakeFormInCatalogsubmit{

    #selecCheckboxesInCategoryFilter;
    #selectOptionsInOptionGoodsTopNewAll;
    #form;
    #selecPriceInCategoryFilter;


    constructor(){

        this.#selecCheckboxesInCategoryFilter = document.querySelectorAll('.category__filter .subcategory-select');

        this.#selectOptionsInOptionGoodsTopNewAll = document.querySelector('.full_category .select__goods');

        this.#selecPriceInCategoryFilter = document.querySelectorAll('.price__from__to_box input');

        this.#form = document.querySelector('#category__filter-id');

        if(!this.#form) return;

        if((!this.#selecCheckboxesInCategoryFilter && this.#selecCheckboxesInCategoryFilter.length === 0) && !this.#selectOptionsInOptionGoodsTopNewAll && !this.#form &&  this.#selecPriceInCategoryFilter.length === 0) return;

        this.#handleFormCheckbox();
        this.#handleFormSelect();
        this.#handleFormInput();


    }

    #handleFormCheckbox(){
        this.#selecCheckboxesInCategoryFilter.forEach((elem) =>{
            elem.addEventListener('change', () =>{
                this.#form.submit();
            });
        });
    };

    #debounce(func, delay){
        let timeout;
        return (...arg) => {
            clearTimeout(timeout);
            timeout = setTimeout(()=>{func(...arg)}, delay);
        };
    };

    #handleFormInput(){
        this.#selecPriceInCategoryFilter.forEach((elem) =>{
            elem.addEventListener('input', this.#debounce((e) =>{
                this.#form.submit();
            }, 2000));
        });
    };



    #handleFormSelect(){
        this.#selectOptionsInOptionGoodsTopNewAll.addEventListener('change', ()=>{
            this.#form.submit();
        });
    };


}

export default new MakeFormInCatalogsubmit();
