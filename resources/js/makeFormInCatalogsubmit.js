class MakeFormInCatalogsubmit{

    #selecCheckboxesInCategoryFilter;
    #selectOptionsInOptionGoodsTopNewAll;
    #form;


    constructor(){

        this.#selecCheckboxesInCategoryFilter = document.querySelectorAll('.category__filter .subcategory-select');

        this.#selectOptionsInOptionGoodsTopNewAll = document.querySelector('.full_category .select__goods');

        this.#form = document.querySelector('#category__filter-id');

        if(!this.#form) return;

        if((!this.#selecCheckboxesInCategoryFilter && this.#selecCheckboxesInCategoryFilter.length === 0) && !this.#selectOptionsInOptionGoodsTopNewAll && !this.#form) return;

        this.#handleFormCheckbox();
        this.#handleFormSelect();

    }

    #handleFormCheckbox(){
        this.#selecCheckboxesInCategoryFilter.forEach((elem) =>{
            elem.addEventListener('change', () =>{
                this.#form.submit();
            });
        });
    };

    #handleFormSelect(){
        this.#selectOptionsInOptionGoodsTopNewAll.addEventListener('change', ()=>{
            this.#form.submit();
        });
    };


}

export default new MakeFormInCatalogsubmit();
