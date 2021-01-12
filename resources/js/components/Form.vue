<template>
<div>
    <div class="form-group">
        <label for="InputSubject">名前</label>
        <input type="text" name="name" class="form-control" id="InputSubject" v-model="name">
    </div>
    <div class="form-group">
        <label for="InputEmail">メールアドレス</label>
        <input type="email" name="email" class="form-control" id="InputEmail" v-model="email">
    </div>
    <div class="form-group">
        <label for="InputSubject">件名</label>
        <input type="text" name="subject" class="form-control" id="InputSubject" v-model="subject">
    </div>
    <div class="form-group">
        <label for="InputMessage">メッセージ</label>
        <textarea name="message" id="InputMessage" class="form-control" cols="40" rows="4" v-model="message">
        </textarea>
    </div>

    <button type="submit" name="action" class="btn btn-primary" value="sent" @click="add">送信する</button>
</div>

</template>

<script>
export default {
    props:  {
      csrf: {
        type: String,
        required: true,
      }
    },
    data(){
        return {
        	counter: 0,
        	isShow:true,
            name: "",
            email: "",
            subject: "",
            message: "",
            post:[],
        }
    },
    methods: {
	   add:function() {
            let url  = '/api/form_js_add'
            let post = { name: this.name,email: this.email,subject: this.subject, message: this.message }
       console.log(post)      
            axios.post(url, post)
            .then(res => {
            console.log('success', res.data)
            })
            .catch(e => {
            console.log(e.response.data.errors)
          
            })
        },
	}
}
</script>