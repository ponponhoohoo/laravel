/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex'
 
Vue.use(Vuex)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header-top', require('./components/Header.vue').default);
Vue.component('footer-tmp', require('./components/Footer.vue').default);

Vue.component('hello-world',{
  template : '<h1>Hello Worldxxx</h1>'
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const store = new Vuex.Store({
    state: {
        s_message: 0,
        db_data:[]
    },
    mutations: {
        increment : function(state) {		
            state.s_message++;
        },
        Get_Json : function(state, json) {
            state.db_data = json;
        }
    },
    actions: {
        incrementOne: function(context){
            context.commit('increment')
        },
        Json_Insert: function(context){
            context.commit('Get_Json')
        },
    }
})

Vue.component('form-tmp', require('./components/Form.vue').default);

import axios from 'axios'
const app = new Vue({
    el: '#app',
    store  ,
    props: {
        mess: {
            type: String,
            default: 'hogehoge'
        }
    },
    data: {
        message: 'こんにちは',
        data1: "data1",
        data2: "data2",
        data3: "propテスト",
        show: false,
        cat:[]
    },
    methods: {
	    showdata() {
	    	this.show = true;
        },

    },
    mounted : function(){
        axios.get('api/test')
        .then(function(response){
            this.cat = response.data
            console.log(this.cat)
        }.bind(this))
        .catch(function(error){
            console.log(error)
        })
    },
});
