class GetTimezone {

    #getTimezone;

    constructor(){

        this.#getTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

        if(this.#getTimezone){

            // this.#setCookie('timezone', this.#getTimezone, options = { 'samesite': lax});
            // window.addEventListener('load', ()=>{
                this.#transferJSDataToLaravel();

            // })
        }
    }

    #transferJSDataToLaravel(){
        console.log(this.#getTimezone);

        // let form1 = document.createElement('form');
        // form1.name = "vote";
        // form1.action = mainRoute;
        // form1.action = '/Beautylife/public/';
        // form1.method = 'POST';
        // form1.style = "display:none";
        // form1.innerHTML = `<input id="timezone" type="text" name="timezone" value="${this.#getTimezone}" />`;
        // `<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">`;

        // document.body.append(form1);

        // form['vote'].submit();
        // form1.submit();


        // $('html').html('<form action="/2.php" name="vote" method="post" style="display:none;"><input type="text" name="name" value="яндекс" /></form>');

            //         'timezone': `${this.#getTimezone}`,
            //         // 'token': this.#token.value
            //     }

            //     console.log(seachData)

            //     const response = await axios.post(headerSearch + '/', seachData);

            //     console.log(response.status)
            //     if(response.status === 200){
            //         let data = response.data;
            //         console.log(data)
            //         // let { popup_searching, token } = data;
            //     }

            // } catch (error) {
            //     console.log(error.message);

            // }
    }


}

export default new GetTimezone;
