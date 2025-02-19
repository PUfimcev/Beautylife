class Tabs{

    #tabsLis;
    #tabsContentLis;

    constructor() {
        this.#tabsLis = document.querySelectorAll('.tabs_head-list li');

        this.#tabsContentLis = document.querySelectorAll('.tabs_content-list li');

        if(this.#tabsLis.length == 0 || this.#tabsContentLis.length == 0) return;

        this.#handleTabsLis();

    }

    #showHideContent(){

        let id = this.dataset.id;
        console.log(id);

    }

    #handleTabsLis(){
        this.#tabsLis.forEach((elem) =>{
            elem.addEventListener('click', this.#showHideContent)
        });
    }
}

export default new Tabs();
