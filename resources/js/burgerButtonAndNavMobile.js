// Setting the burgerbutton

class BurgerButtonAndNavMobile{

    #button;
    #navMobile;
    #wrapNav;
    #cancelButton;
    #linkSelectLang;
    #navLinksPages = [];

    constructor(){

        this.#button = document.getElementById('burger-button');
        this.#navMobile = document.querySelector('.nav__line-mobile');

        if(this.#button === undefined || this.#navMobile === undefined || this.#button === null || this.#navMobile === null) return;

        this.#cancelButton = document.querySelector('.nav__cancel-icon.mobile');
        this.#wrapNav = document.querySelector('.wrap__nav');
        this.#navLinksPages = document.querySelectorAll('.nav_link.mobile');
        this.#linkSelectLang = document.querySelector('.item-reff-lang.mobile');

        this.#buttonToggle();
        this.#removeButton();
        this.#removeWrap();
        this.#getResize();
        this.#clickNavLinks();
        this.#clickLangLink();

    }

    #getResize(){
        window.addEventListener('resize',() => {
            if(!window.matchMedia("screen and (max-width: 768px)").matches){
                this.#cancelButton.click();
            }
        });
    };

    #clickNavLinks(){
        if(this.#navLinksPages == [] && this.#navLinksPages.length == 0) return;
        this.#navLinksPages.forEach((elem) =>{
            elem.addEventListener('click', (e) => {

                // did such a way to upload a new page after navigation leaves
                e.preventDefault();
                if(this.#removeNavMobile()) {
                    setTimeout(()=>{
                        window.location.href = elem.href;
                    }, 400)
                }
            });
        });
    };

    #clickLangLink(){
        if(this.#linkSelectLang === null || this.#linkSelectLang === undefined) return;

        this.#linkSelectLang.addEventListener('click', (e) => {
            // did such a way to upload a new page after navigation leaves

            e.preventDefault();
            if(this.#removeNavMobile()) {
                setTimeout(()=>{
                    window.location.href = e.target.href;
                }, 400)
            }
        });
    };

    #buttonToggle(){

        this.#button.addEventListener('click', async () => {
            let promis = new Promise((resolve, reject) => {
                resolve(this.#wrapNav.style.display = 'block');
                reject(new Error('Excecution failed'));
            })

            await promis.then(() => {
                setTimeout(()=>{
                    this.#wrapNav.style.opacity = '0.5';
                    this.#navMobile.style.transform = 'translateX(0%)';
                }, 200)
            }).catch((e) => { console.log('Erorr is', e)});
        });
    }

    #removeButton(){

        if(!this.#cancelButton) return;
        this.#cancelButton.onclick = () => {
            this.#removeNavMobile();
        }
    }

    #removeWrap(){

        if(!this.#wrapNav) return;
        this.#wrapNav.onclick = () => {
            this.#removeNavMobile();
        }
    }

    async #removeNavMobile(){

        let promis = new Promise((resolve, reject) => {

            resolve( setTimeout(()=>{
                this.#navMobile.style.transform = 'translateX(300%)';
            }, 200));
            reject(new Error('Excecution failed'));
        })

        try{

            await promis;
            await setTimeout(()=>{ this.#wrapNav.style.opacity = '0'; }, 500);
            await setTimeout(()=>{ this.#wrapNav.style.display = 'none';}, 500);

        } catch (error) {
            console.log(error.message);
        }

        return true;
    }
}

export default new BurgerButtonAndNavMobile();
