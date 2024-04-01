/**
 * Set timer of notification appearance
 */

class SetTimeNotifications {

    #notification;
    #cancelButton;

    constructor(){
        this.#notification = document.getElementById('notifications') || null;
        this.#cancelButton = document.getElementById('notifications__cancel_button') || null;

        if(this.#notification !== null){
            this.#resetNotification();
        }

        if(this.#cancelButton !== null){
            this.#canselNotification();
        }
    }

    async #setMoveNotification() {

        return new Promise((resolve)=>{
            setTimeout(()=>{
                if(this.#notification !== null){

                    resolve(this.#notification.style.top = "-45%");
                }
            }, 2500)}
        );
    }

    async #resetNotification() {
        try {
            await this.#setMoveNotification();
            setTimeout(()=>{
                this.#notification.remove();
            }, 500);
        } catch(error) {
            console.error(error);
          }
    };

    #canselNotification(){
        this.#cancelButton.addEventListener('click', function(){
            location.reload();
        });
    }
}

export default new SetTimeNotifications();
