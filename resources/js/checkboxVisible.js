class CheckboxVisible {

    #checkboxes;
    #arrayCheckboxes = [];
    #resetBnt;
    #checkboxesContainer;

    constructor(){

        this.#checkboxes = document.querySelectorAll('.category__filter input[type="checkbox"]');

        this.#resetBnt = document.querySelector('.category__subcategory .reset__btn');

        if(!this.#resetBnt && this.#checkboxes.length === 0) return;

        this.handleCookie();
        this.handleCheckbox();
        this.handleResetBnt();
    }

    handleCookie(){

        window.addEventListener('load', ()=>{

            if(!this.getCookie('checkboxes')) return;

            const getDataFromCookie = JSON.parse(this.getCookie('checkboxes'));

            if(!getDataFromCookie && getDataFromCookie.length === 0) return;

            this.#checkboxesContainer = document.querySelectorAll('.subcategory__names');

            this.handleCheckboxesContainer(getDataFromCookie);

            this.makeCheckedCheckbox(getDataFromCookie);
            getDataFromCookie.forEach(elem => {
                this.#arrayCheckboxes.push(elem);
            })

        })

        window.addEventListener('unload', ()=>{
            if(sessionStorage.getItem('checkboxes')){
                this.setCookie('checkboxes', sessionStorage.getItem('checkboxes'), {secure: true, 'max-age': 3600 })
            }
        })

    }

    // keep container with checkboxes open after  reload
    handleCheckboxesContainer(getDataFromCookie){
        const arr = [];

        this.#checkboxes.forEach(elem => {
            if(getDataFromCookie.includes(elem.dataset.id))

                arr.push(elem.closest('ul'));
        });

        [... new Set(arr)].forEach(elem => {
            elem.classList.add('open');
        });

    }

    handleResetBnt(){
        this.#resetBnt.addEventListener('click', ()=>{
            this.removeStorage();
        });
    }

    makeCheckedCheckbox(data){

        if(!data || data.length === 0) return;
        this.#checkboxes.forEach(elem => {
            if(data.includes(elem.dataset.id)) elem.checked = true;
        });
    }

    handleCheckbox(){
        this.#checkboxes.forEach(elem => {
            elem.addEventListener('click', (e)=> {
                if(e.target.checked) {

                    this.#arrayCheckboxes.push(e.target.dataset.id)
                    this.setListCheckboxes();
                } else {

                    this.setListCheckboxes(e.target.dataset.id);
                }


            });
        })
    };

    setListCheckboxes(data){

        if(!this.#arrayCheckboxes || this.#arrayCheckboxes.length === 0) return;

        if(data) {

            this.#arrayCheckboxes = this.#arrayCheckboxes.filter((item) => item !== data );

            this.storeListCheckboxes(this.#arrayCheckboxes);

        } else {

            this.storeListCheckboxes(this.#arrayCheckboxes);
        }
    };

    storeListCheckboxes(array = []){
        if(!array || array.length === 0) {
            this.removeStorage();
            return;
        }

        sessionStorage.setItem('checkboxes', JSON.stringify(array));
    }

    removeStorage(){

        sessionStorage.removeItem('checkboxes');
        this.setCookie('checkboxes', "", {
            'max-age': -1
          })

    }

    getCookie = (name) => { let matches = document.cookie.match(new RegExp( "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)" )); return matches ? decodeURIComponent(matches[1]) : undefined; };

    setCookie(name, value, options = {}) { options = { path: '/', ...options }; if (options.expires instanceof Date) { options.expires = options.expires.toUTCString(); } let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value); for (let optionKey in options) { updatedCookie += "; " + optionKey; let optionValue = options[optionKey]; if (optionValue !== true) { updatedCookie += "=" + optionValue; } } document.cookie = updatedCookie; };


}

export default new CheckboxVisible();
