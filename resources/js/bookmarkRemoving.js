// process of removing the bookmark

class BookmarkRemoving{

    #bookmarkProductElementLi;
    #bookmarkCanselButton;
    #bookmarkProductCheckboxes;

    constructor(){
        this.#bookmarkProductCheckboxes = document.querySelectorAll('.bookmarksProductRemove');

        if(this.#bookmarkProductCheckboxes.length === 0) return;

        window.onload = ()=>{

            this.#isCheckedRemoveButton();
        }

        this.#handlebookmarksProductRemoveButtons();

    }

    #isCheckedRemoveButton(){
        this.#bookmarkProductCheckboxes.forEach((elem) =>{
            if(!elem.checked) return;

            let identifier = elem.dataset.name;
            this.#getRelativeElements(identifier, elem);
        });
    }

    #handlebookmarksProductRemoveButtons(){
        this.#bookmarkProductCheckboxes.forEach((elem) =>{

            elem.addEventListener('change', (e) =>{

                if(!e.target.checked) return;

                let identifier = e.target.dataset.name;

                this.#getRelativeElements(identifier, e.target);
            });
        });
    }

    #getRelativeElements(identifier, checkbox){
        console.lo
        this.#bookmarkProductElementLi = document.querySelector(`li[data-name = "${identifier}"]`);

        this.#bookmarkProductElementLi.classList.add('removing');

        this.#bookmarkCanselButton = document.querySelector(`span[data-name = "${identifier}"]`);

        this.#undoProcess(this.#bookmarkProductElementLi, this.#bookmarkCanselButton, checkbox);
    };

    #undoProcess(nodeElemLi, canselButton, checkbox){

        canselButton.addEventListener('click', ()=>{
            nodeElemLi.classList.remove('removing');
            checkbox.checked = false;

        });
    }

}

export default new BookmarkRemoving;
