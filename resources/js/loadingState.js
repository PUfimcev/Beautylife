class LoadingState{

    #productsElements;

    constructor(){

        this.#productsElements = document.querySelectorAll('.product__elements');

        this.#useLoading();
    }

    #useLoading(){
        this.#productsElements.forEach(async (e)=>{

            if(e.children.length == 0) {
                let Spinner = await import('./spinner.js').then(module => module.default.init());
                let div = document.createElement('div'); // создаем div лишь для того, чтобы положить в него результат функции Spinner
                div.appendChild(Spinner);
                e.innerHTML = div.innerHTML;
            }
        })
    };
}

export default new LoadingState();
