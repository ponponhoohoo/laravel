<template>
    <div>

<section>
	<div class="card text-white bg-dark mb-3" v-for="item in cat">
	    <div class="row no-gutters">
	        <div class="card-body">
	            <h3 class="card-title">{{ item.email }} {{ item.subject }} </h3>
                <button class="btn" v-on:click="del(item.id)">削除</button>
	        </div>
	    </div>
	</div>
</section>
 s_message:{{ count }}<br>
 db_data:{{ db_datas }}
<button class="my-button" @click="showMessage">CountUp</button>
<button class="my-button" @click="showMessage">Action</button>
<ul v-if=error_message>
<li v-for="mess in error_message">{{mess}}</li>
</ul>
        <span>あああああ</span>{{mess}}
        <input v-model="name" v-bind:class="{ 'red': name_error }">
        <input v-model="email" v-bind:class="{ 'red': email_error }">
        <select v-model="message">
            <option v-for="pref in prefs" v-bind:value="pref.id">{{ pref.name }}</option>
        </select>
        <button class="my-button" @click="add">Default</button>
   </div>
</template>

<script>
import prefs from '../const/pref.vue'
export default {
    mixins: [ prefs ],
	props: {
        mess: {
            type: String,
            default: 'hogehoge'
        },
        items: {
            type: Object
        },
    },
    data() {
        return{
            id:'',
            cat:[],
            error_message:[],
            text:"",
            message:"",
            message_error:false,
            email:"",
            email_error:false,
            name:"",
            name_error:false,
            counter: 0,
            title: "Header",
            text: "Hello Vaaaue.js!"
        }
    } ,
    computed: {
        count () {
            return this.$store.state.s_message
        },
        db_datas () {
            return this.$store.state.db_data
        },
    },
    methods: {
        increment : function(){
            this.$store.commit('Json_Insert',10)
        },
        showAllData:function() {
            axios.get('api/get_data_tbl')
            .then(function(response){
                this.cat = response.data
                this.$store.state.Get_Json;
                this.$store.commit('Get_Json',response.data);
                console.log(this.cat)
            }.bind(this))
            .catch(function(error){
                console.log(error)
            })
        },
	    showMessage: function () {
            this.$store.state.increment;
            this.$store.commit('increment');
        },
        del: function (id) {
            if (id) {
                axios.delete('api/delete/' + id)
                .then(function(response){
                    this.text = response.data;
            
                    this.showAllData();
                    console.log(this.text)
                }.bind(this))
                .catch(function(error){
                    console.log(error)
                })
            }
        } ,
        add: function () {
            this.error_message = [];
            if (this.name != "") {
                this.name_error = false;
                console.log(this.name);
            } else {
                this.name_error = true;
                this.error_message.push(this.name + 'は必須項目です。')
                console.log(this.name_error);
            }
            if (this.email != "") {
                this.email_error = false;
                this.error_message.push(this.email_error + 'は必須項目です。')
                console.log(this.email);
            } else {
                this.email_error = true;
                console.log(this.email_error);
            }

            if (!this.name_error.length) {
                const post = {
                    name: this.name,
                    email: this.email
                }
                axios.post('api/add',post)
                .then(function(response){
                    this.text = response.data;
                    this.showAllData();
                    console.log(this.text)
                }.bind(this))
                .catch(function(error){
                    console.log(error)
                })
            }
            
        },
    },
    mounted() {
        console.log(prefs);
        this.showAllData();
    }
}
</script>

<style scoped>
div{
    border: 1px solid blue
}
.change_red {
  color:red;
}
h1{
    color: blue
}
p{
    color:blue
}
.class-a {
    border: 2px solid #FF0000;
    padding:50px;
}
.red{
    color: red;
    border: 2px solid #FF0000;
}
.bold{
    font-weight: bold;
}
ul.error {
    border:1px solid #FF0000;
}
ul.error li {
    color: #FF0000;
    display: block;
}
</style>