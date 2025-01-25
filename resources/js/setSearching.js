class SetSearching{

    #headerSearchingSection;
    #headSearchInput = [];
    #lengthSeachInput;

    #searchInputData = '';
    #token;
    #lang;

    #searchingPopUp;
    #searchingPopupElements;
    #popUpSearchInput;
    #popUpRemoveIcon;
    #searchResult;

    constructor(){
        // header.blade.php & header_mobile.blade.php
        this.#headerSearchingSection = document.getElementById('header__searching');
        this.#headSearchInput = document.querySelectorAll('.headbar__search-input');


        // set_searching.blade.php
        this.#searchingPopUp = document.querySelector('.searching__popup');
        this.#searchingPopupElements = document.querySelector('.searching__popup_elements');
        this.#popUpSearchInput = document.querySelector('.searching__group__input');
        this.#token = document.getElementById('token');
        this.#lang = document.getElementById('search_lang');

        this.#popUpRemoveIcon = document.querySelector('.searching__popup__remove-icon');
        this.#searchResult = document.querySelector('.searching__box_result-list');

        if(!this.#headerSearchingSection) return;

        this.#startSearch();
    }

    #debounce(func, delay){
        let timeout;
        return (...arg) => {
            clearTimeout(timeout);
            timeout = setTimeout(()=>{func(...arg)}, delay);
        };
    };

    #startSearch(){
        if(this.#headSearchInput.length > 0 && this.#headSearchInput !== undefined) {

            this.#headSearchInput.forEach((elem) => {

                elem.addEventListener('input', (event) => {
                    this.#searchInputData = event.target.value;
                    this.#lengthSeachInput = event.target.value.length;
                    if(this.#lengthSeachInput > 0) {
                        this.#headerSearchingSection.style.display = "block";
                        this.#popUpSearchInput.focus();

                        this.#popUpSearchInput.value = this.#searchInputData;
                        this.#getSearchedData(this.#searchInputData);

                    }
                });
            })

            this.#headSearchInput.forEach((elem) => {
                elem.addEventListener('click', (event) => {
                    this.#searchInputData = event.target.value;
                    this.#lengthSeachInput = event.target.value.length;
                    if(this.#lengthSeachInput > 0) {
                        this.#headerSearchingSection.style.display = "block";
                        this.#popUpSearchInput.select();
                        this.#popUpSearchInput.value = this.#searchInputData;

                        this.#getSearchedData(this.#searchInputData);
                    }
                });

            });
        }
        this.#removingElements();
    }

    #removePopUp(){

        this.#headerSearchingSection.style.display = "none";
        this.#headSearchInput.forEach((elem) => {
            elem.value =  this.#popUpSearchInput.value;
        });
    }

    #removingElements(){
        if(this.#popUpRemoveIcon && this.#popUpRemoveIcon !== undefined){
            this.#popUpRemoveIcon.addEventListener('click', ()=>{this.#removePopUp});
        }

        if(this.#searchingPopUp && this.#searchingPopUp !== undefined){
            this.#searchingPopUp.addEventListener('click', (event)=>{
                if(!event.target.classList.contains('searching__popup_elements') && !event.target.classList.contains('searching__box_result') && !event.target.classList.contains('searching__group__magnify-glass') && !event.target.classList.contains('searching__group__input')){
                this.#removePopUp();
                }

            })
        }
    }


    #getSearchedData(query){
        if(!query || query === '') return;

        let searchedData = query;

        if(searchedData.length == 0) return;

        if(searchedData.length <= 1) this.#getFullSearchedData(searchedData);

        if(this.#searchingPopupElements) this.#searchingPopupElements.addEventListener('input', this.#debounce((e) =>{
            searchedData = e.target.value

            if(searchedData == '') {
                this.#searchResult.innerHTML = ``;
                this.#searchResult.style = "display: none";
                document.querySelector('.result_not_found').style.display = "block";

            } else {
                this.#searchResult.style.display = "block";
            }

            if(searchedData !== '') this.#getFullSearchedData(searchedData);

        }, 500));
    }

    #getFullSearchedData(query){

        query = query.trim();

        if(query.length === 0) return;

        this.#getData(query);
    }

    async #getData(query){

        try {

            const seachData = {
                'popup_searching': query,
                'token': this.#token.value,
                'lang': this.#lang.value,
            }


            const response = await axios.post(headerSearch, seachData);

            if(response.status === 200){
                let data = response.data;


                if(data && data.length > 0) {
                    document.querySelector('.result_not_found').style.display = "none";
                    this.#searchResult.style.display = "block";
                    this.#searchResult.innerHTML = '';

                    this.#searchResult.innerHTML = data;
                } else {
                    this.#searchResult.innerHTML = ``;
                    this.#searchResult.style = "display: none";
                    document.querySelector('.result_not_found').style.display = "block";
                }
            } else {
                let Spinner = await import('./spinner.js').then(module => module.default.init());
                let div = document.createElement('div'); // создаем div лишь для того, чтобы положить в него результат функции Spinner
                div.appendChild(Spinner);
                this.#searchResult.innerHTML = div.innerHTML;
            }

        } catch (error) {
            console.log(error.message);

        }
    }
}

export default new SetSearching();
