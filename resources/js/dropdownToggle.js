class DropdownToggle {

    #body;
    #dropDown = [];

    constructor(){
        this.#body = document.querySelector('body');
        this.#dropDown = document.querySelectorAll('.headbar__dropdown');

        if(this.#dropDown != [] && this.#dropDown.length > 0) {

            this.#setClickHandler();
            this.#removeDropdownList();
        }
    }

    #setClickHandler(){
        if(this.#dropDown != [] && this.#dropDown.length > 0) {

            this.#dropDown.forEach((elem) => {

                elem.addEventListener('click', (event) => {
                    let item = event.currentTarget;
                    console.log(item );

                    if (!event.target.matches('li') && !event.target.classList.contains('dropdown__menu') && !event.target.classList.contains('dropdown__item') && !event.target.classList.contains('dropdown_item-reff')){
                        item.classList.toggle('active');
                    }

                    this.#removeDropdownListIfOpend(item);
                })
            })

        }
    }

    #removeDropdownList(){

        this.#body.addEventListener('click', (event) => {

            if(!event.target.classList.contains('dropdown_toggle') && !event.target.classList.contains('dropdown__arrow') && !event.target.classList.contains('dropdown__item') && !event.target.classList.contains('dropdown_item-reff') && !event.target.classList.contains('dropdown__menu')){
                if(this.#dropDown != [] && this.#dropDown.length > 0) {
                    this.#dropDown.forEach((item) =>{

                        item.classList.remove('active');
                    })
                }
            }
        })
    }

    #removeDropdownListIfOpend(item){
        let elemDropdown = document.querySelectorAll('.headbar__dropdown.active');

        if(elemDropdown != [] && elemDropdown.length > 0){
            elemDropdown.forEach((elem) => {
                if(elem !== item) elem.classList.remove('active');
            })
        }

    }

}

export default new DropdownToggle();
