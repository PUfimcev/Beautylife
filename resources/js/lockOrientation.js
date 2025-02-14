class LockOrientation{

    #bool;
    #orientation;
    #meta;
    #metaContent;

    constructor(){

        this.#bool = window.innerWidth <= 768 ? true : false;

        this.#orientation = screen.orientation.type.startsWith('portrait');

        this.#meta = document.querySelector('[name="viewport"]');
        this.#metaContent = document.querySelector('[name="viewport"]').content;

        window.addEventListener('load', ()=>{

            if(this.#bool && this.#orientation) {

                this.#orientationScreen();
            } else {
                return;
            }

        })


        this.#resizeScreen();

    }

    #resizeScreen(){
        window.addEventListener('resize', () => {

            this.#bool = window.innerWidth <= 768 ? true : false;

            this.#orientation = screen.orientation.type.startsWith('portrait');

            if(this.#bool && this.#orientation) {
                this.#meta.setAttribute('content', this.#metaContent + `, user-scalable=no`);
                this.#orientationScreen();
            } else {
                this.#meta.setAttribute('content', this.#metaContent);
                return;
            }
        })
    }

    #orientationScreen(){

            window.addEventListener('orientationchange', ()=>{

                screen.orientation.lock('landscape').then((data)=>{
                    console.log(data);

                }).catch((error)=>{
                    // console.log(error);
                });
            })
    };

}

export default new LockOrientation();
