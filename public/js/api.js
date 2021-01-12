/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex'
 
Vue.use(Vuex)

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

import axios from 'axios'
const app = new Vue({
    el: '#app',
    store  ,
    data: {
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
