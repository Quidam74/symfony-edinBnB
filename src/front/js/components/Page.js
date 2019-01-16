
export default class Page {

    constructor() {
        this.$body = document.querySelector(".body");
        this.scroll =0;
        this.bindEvent();
        this.init();
    }

    bindEvent(){
        window.addEventListener("scroll",(data)=>{
            this.scroll = window.scrollY;
            window.scrollTo(this.scroll,this.scroll)
            this.$body.style.transform = "translate(0,"+this.scroll+"px)";
            this.$body.style.height = "calc(400vw - "+this.scroll+"px)";


        })
    }
    init(){

    }


}