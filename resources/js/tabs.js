class Tabs{

    #tabsList;

    constructor() {
        this.#tabsList = document.querySelectorAll('.tabs_head-list li');

        if(this.#tabsList.length == 0) return;

        this.#handleTabsLis();
        this.#tabsList[0].click();

    }

    #showHideContent(){

        let id = this.dataset.id;

        document.querySelectorAll('.tabs_head-list li').forEach((elem) =>{
            elem.classList.remove('show');
        })

        this.classList.add('show');

        let tabsContentList = document.querySelectorAll('.tabs_content-list li');

        if(tabsContentList.length > 0) tabsContentList.forEach((elem) =>{
            elem.classList.remove('show');
        })

        const contentElem = document.querySelector(`.tabs_content-list li[data-id='${id}']`);

        if(contentElem) contentElem.classList.add('show');
    }

    #handleTabsLis(){
        this.#tabsList.forEach((elem) =>{
            elem.addEventListener('click', this.#showHideContent)
        });
    }
}

export default new Tabs();
