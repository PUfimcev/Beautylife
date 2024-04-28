// Create possibility to hide and shoe password in field input

class ShowHidePassword {

    #passwordControl = [];
    #passwordInput;

    constructor(){

        let passwordControl = document.querySelectorAll('.password-control');
        let passwordInput = document.getElementById('password');

        if(passwordControl.length == 0 && passwordInput == null) {
            return;
        } else {
            this.#passwordControl = passwordControl;

            this.#passwordInput = passwordInput;

            this.#showHideButtonEye();

        }

    }

    #showHideButtonEye(){
        if(this.#passwordInput.closest('.password_input') == null) return;

        if(this.#passwordInput.closest('.password_input').lastElementChild.classList.contains('invalid-feedback')){
            let alerInvalidFeedback = this.#passwordInput.closest('.password_input').lastElementChild;

            alerInvalidFeedback.previousElementSibling.style.display = 'none';
            if(this.#passwordInput.classList.contains('is-invalid')) {
                this.#passwordInput.addEventListener('focus', () => {
                    this.#passwordInput.classList.remove('is-invalid');
                    alerInvalidFeedback.previousElementSibling.style.display = 'block';
                    alerInvalidFeedback.style.display = 'none';
                })
            }
            this.#viewToggle();
        } else {
            if(this.#passwordControl && this.#passwordControl.length > 0) {
                this.#passwordControl.forEach(elem => {
                    elem.style.display = 'block';
                });
                this.#viewToggle();
            } else {
                return;
            }
        }
    }

    #showHidePassword(){

        if(this.previousElementSibling.type === 'password'
        ){
            this.classList.add('view');
            this.previousElementSibling.setAttribute('type', 'text');
        } else {
            this.classList.remove('view');
            this.previousElementSibling.setAttribute('type', 'password');
        }

    }

    #viewToggle(){

        this.#passwordControl.forEach(elem => {

            elem.addEventListener('click', this.#showHidePassword);
        })
    };
}

export default new ShowHidePassword();
