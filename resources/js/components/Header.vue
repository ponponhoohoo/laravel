<template>
    <div>
        <h1>{{ title }}</h1>
        <p>{{ text }}</p>
        <button v-on:click="showMessage">Add 1</button>
        {{ counter }}
         <div class="card text-white bg-dark mb-3" v-for="item in items">
	        <div class="row no-gutters">
	            <div class="card-body">
	                <h3 class="card-title">{{ item.name }}　{{ item.email }}</h3>
	            </div>
	        </div>
	    </div>
   </div>
   


</template>

<script>
export default {
	props: {
        items: {
            type: Object
        },
    },
    data(){
        return {
        	counter: 0,
        	isShow:true,
            title: "Header",
            text: "Hello Vue.js!"
        }
    },
    methods: {
	    showMessage: function () {
	        this.counter++;
	    }
	}
}
</script>

<style scoped>
div{
    border: 1px solid blue
}
h1{
    color: blue
}
p{
    color:blue
}
</style>