// Layout of Header depending on Screensize

class alterStyleDropdown{

    #sw;
    #elemDropDownAuth;

    constructor(){

        this.#sw = window.matchMedia("screen and (max-width: 768px)");

        if(this.#sw.matches){
            this.#elemDropDownAuth = document.querySelector('.dropdown__menu-auth');

            console.log(this.#elemDropDownAuth)
                if(this.#elemDropDownAuth !== null) this.#alterStyleElement();
        } else {
            return;
        }
            //     // location.href = getScreenWidthRoute + '\\' + '?screen=true';
            //     this.#getScreenWidth();
            // } else if (!this.#sw.matches && document.readyState == 'loading'){
            //     this.#getScreenWidth();
            //     // location = getScreenWidthRoute + '\\' + '?screen=false';
            // } else if(document.readyState == 'complete') {
            //     return;
            // }

    }

    #alterStyleElement(){


        this.#elemDropDownAuth.setAttribute('style','0px !important');

    };
}

export default new alterStyleDropdown();

