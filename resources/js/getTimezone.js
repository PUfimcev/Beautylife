class GetTimezone {

    #getTimezone;
    #token;

    constructor(){

        this.#getTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        this.#token = document.querySelector('[name="csrf-token"]').content;

        this.#createForm();

        // if(localStorage.getItem('Beautylife-timezone') === 'true'){
        // window.addEventListener('unload', ()=>{
        //         localStorage.removeItem('Beautylife-timezone');
        //     });
        // };
    }

    #createForm (){

        let form = document.createElement('form');
        form.classList.add('timezone');
        form.setAttribute('method','POST');
        form.action = timezoneRoute;
        form.style = "display:none";
        form.innerHTML = `<input id="timezone" type="text" name="timezone" value="${this.#getTimezone}" />
        <input type="hidden" name="_token" id="token" value="${ this.#token }">`;

        document.body.append(form);

        this.#submitForm();
    }

    #submitForm(){
        let form = document.querySelector('.timezone');

        if(sessionStorage.getItem('Beautylife-timezone') !== 'true'){
            sessionStorage.setItem('Beautylife-timezone', 'true');
            form.submit();
        } else {
            return;
        }
    };
}

export default new GetTimezone();
