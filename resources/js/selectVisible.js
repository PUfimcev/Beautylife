import CheckboxVisible from './checkboxVisible';

class SelectVisible extends CheckboxVisible {

    #selectItems;
    #item;

    constructor(){
        super();

        this.#selectItems = document.querySelector('.full_category .select__goods_top_new_all');
        if(!this.#selectItems) return;
        this.makeSelectVisible();
        this.handleSelectCoockie();
    }

    handleSelectCoockie(){

        this.#selectItems.addEventListener('change', (e)=>{

            if(e.target.value) this.setCookie('selectedGoods', e.target.value, {'max-age': 84600 });
        });
    }

    makeSelectVisible(){
        if(!this.getCookie('selectedGoods')) {
            this.#selectItems.value = 'all-goods';
        }

        this.#selectItems.value = this.getCookie('selectedGoods');

    }

    removeStorage(){
        super.removeStorage();

        this.setCookie('selectedGoods', "", {
            'max-age': -1
          })
    }

}

export default new SelectVisible();
