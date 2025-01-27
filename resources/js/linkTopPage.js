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
        if(this.#allLinks.length > 0) {

            this.#allLinks.forEach(element => {
                element.addEventListener('click', function(){

                    document.top = 0;

                });
            });
        } else {
            return;
        }
    }
}

// export default new LinkTopPage();
