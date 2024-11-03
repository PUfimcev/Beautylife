// Get Screensize

class GetScreensize{

    #token;
    /**
     * Description placeholder
     *
     * @type {string}
     */
    #applianceType = 'desk';

    /**
     * Creates an instance of GetScreensize.
     *
     * @constructor
     */
    constructor(){

        this.#token = document.querySelector('[name="csrf-token"]').content;

        if(sessionStorage.getItem('Beautylife-screenWidth')) sessionStorage.removeItem('Beautylife-screenWidth');

        this.#startGetScreenWidth();
        this.#watchScreenWidth();

    }

    #startGetScreenWidth(){


        if(window.innerWidth <= 1023){
            this.#applianceType = 'mobile';
            sessionStorage.setItem('Beautylife-screenWidth', 'mobile');

        } else {
            this.#applianceType = 'desk';
            sessionStorage.setItem('Beautylife-screenWidth', 'desk');
        }

        this.#sendDataToShowReviews(this.#applianceType);

    };

    #watchScreenWidth(){

        window.addEventListener('resize', () => {

            this.#handleScreenWidth();

        });

    };

    async #getScreenWidth() {

        return new Promise((resolve)=>{

            setTimeout(()=>{
                resolve(window.innerWidth);
            })
            }
        );
    }


    #sendDataToShowReviews(dataWidth){

        if(!dataWidth) return;

        this.#sendData(dataWidth);

    }

    async #handleScreenWidth(){

        try {
            let width = await this.#getScreenWidth();

            if(width) this.#applianceType = (width <= 1023) ? 'mobile' : 'desk';

            if((this.#applianceType === 'mobile' && sessionStorage.getItem('Beautylife-screenWidth') === 'mobile') || (this.#applianceType === 'desk' && sessionStorage.getItem('Beautylife-screenWidth') === 'desk')) return;

            this.#sendDataToShowReviews(this.#applianceType);
            sessionStorage.setItem('Beautylife-screenWidth', this.#applianceType);

        } catch (error) {
            console.error(error);
        }
    };

    async #sendData(dataWidth){

        if(!dataWidth)  return;

        if(location.pathname.includes('admin') || location.pathname.includes('login') || location.pathname.includes('register') ||location.pathname.includes('password')) return;

        const screenWidthData = {
            'screenWidth': dataWidth,
            'token': this.#token
            };


        if(sessionStorage.getItem('Beautylife-screenWidth')){

            try {

                const response = await axios.post(screenWidthRoute, screenWidthData);

                if(response.status === 500){

                    let data = response.data;
                // console.log(data);
                    }


            } catch (error) {
                console.log(error.message);

            }

        } else {
            return;
        }
    };

}

export default new GetScreensize();

