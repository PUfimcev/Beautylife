class SetSearching{

    #headerSearchingSection;
    #headSearchInput;
    #lengthSeachInput;

    #searchInputData = '';
    #token;

    #searchingPopUp;
    #searchingPopupElements;
    #popUpSearchInput;
    #popUpRemoveIcon;
    #searchResult;

    constructor(){

        this.#headerSearchingSection = document.getElementById('header__searching');
        this.#headSearchInput = document.querySelector('.headbar__search-input');

        this.#searchingPopUp = document.querySelector('.searching__popup');
        this.#searchingPopupElements = document.querySelector('.searching__popup_elements');
        this.#popUpSearchInput = document.querySelector('.searching__group__input');
        this.#token = document.getElementById('token');
        this.#popUpRemoveIcon = document.querySelector('.searching__popup__remove-icon');
        this.#searchResult = document.querySelector('.searching__box_result');

        this.#startSearch();
    }

    #startSearch(){
        if(this.#headSearchInput && this.#headSearchInput !== undefined) {

            this.#headSearchInput.addEventListener('input', (event) => {
                this.#searchInputData = event.target.value;
                this.#lengthSeachInput = event.target.value.length;
                if(this.#lengthSeachInput > 0) {
                    this.#headerSearchingSection.style.display = "block";
                    this.#popUpSearchInput.focus();

                    this.#popUpSearchInput.value = this.#searchInputData;
                    this.#getSearchedData(this.#searchInputData);

                }
            });

            this.#headSearchInput.addEventListener('click', (event) => {
                this.#searchInputData = event.target.value;
                this.#lengthSeachInput = event.target.value.length;
                if(this.#lengthSeachInput > 0) {
                    this.#headerSearchingSection.style.display = "block";
                    this.#popUpSearchInput.select();
                    this.#popUpSearchInput.value = this.#searchInputData;

                    this.#getSearchedData(this.#searchInputData);
                }});
            }

            this.#removingElements();
    }

    #removePopUp(){

        this.#headerSearchingSection.style.display = "none";
        this.#headSearchInput.value =  this.#popUpSearchInput.value;
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

        if(query) this.#getData(query);

        if(this.#searchingPopupElements) this.#searchingPopupElements.addEventListener('keyup', (event) => {

            const searchedData = event.target.value;

            if(searchedData !== '') {
                this.#getFullSearchedData(searchedData);
            } else {
                this.#getFullSearchedData(null);
            }
        })
    }

    #getFullSearchedData(query){
        this.#getData(query);
    }

    async #getData(query){

        try {

            const seachData = {
                'popup_searching': query,
                'token': this.#token.value
            }

            const response = await axios.post(headerSearch, seachData);

            if(response.status === 200){
                let data = response.data;
                let { popup_searching, token } = data;

                if(popup_searching !== null) {
                    document.querySelector('.result_not_found').style.display = "none";
                    this.#searchResult.style.display = "block";
                    this.#searchResult.innerHTML = `${popup_searching}`;
                } else {
                    this.#searchResult.innerHTML = ``;
                    this.#searchResult.style = "display: none";
                    document.querySelector('.result_not_found').style.display = "block";
                }
            } else {
                let Spinner = await import('./spinner.js').then(module => module.default.init());
                let div = document.createElement('div'); // создаем div лишь для того, чтобы положить в него результат функции createContentModal
                div.appendChild(Spinner);
                this.#searchResult.innerHTML = div.innerHTML;
            }

        } catch (error) {
            console.log(error.message);

        }
    }
}

export default new SetSearching();
