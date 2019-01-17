
import Example from './components/Example'
import Listing from './components/Listing'
import {getBrowser} from './utils/environment'

const App = {

    init(){
        document.addEventListener('DOMContentLoaded', this.ready.bind(this), false);
    },

    ready(){
        this.initComponents();
        this.bindEvent();


        new Listing();
    },

    bindEvent(){

    },

    initComponents(){


    }

};


App.init();