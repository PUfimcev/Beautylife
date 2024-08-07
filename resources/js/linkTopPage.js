// Bring page contents to top

class LinkTopPage{

    #allLinks = [];

    constructor(){
        this.#allLinks = document.querySelectorAll('a');

        window.addEventListener('load', function(){
            window.scrollTo({
                top: 0,
                left: 0});
        });

        this.#docuTop();

    }


    #docuTop(){
        if(this.#allLinks.length > 0) this.#allLinks.forEach(element => {
            element.addEventListener('click', function(){

                window.top = 0;

            });
        });
    }
}

export default new LinkTopPage();
