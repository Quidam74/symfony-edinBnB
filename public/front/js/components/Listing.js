export default class Listing {

    constructor() {
        this.$properties = document.querySelectorAll(".listing-div");
        this.bindEvent();
        this.init();
    }

    bindEvent() {
        if (this.$properties) {
            this.$properties.forEach((property, index) => {
                property.addEventListener("click", (event) => {
                    window.location.pathname = '/property/' + event.currentTarget.dataset.idproperty;
                    console.log(event.currentTarget)
                })

            })

        }
    }

    init() {

    }


}