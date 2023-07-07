<template>
    <div class="login-popup" v-if="showPopup">
        <h2>Connexion</h2>
        <div class="textbox">
            <font-awesome-icon :icon="['fas', 'user']" />
            <input type="text" placeholder="Username" v-model="username" required>
        </div>

        <div class="textbox">
            <font-awesome-icon :icon="['fas', 'lock']" />
            <input type="password" placeholder="Password" v-model="password" required>
        </div>
        
        <button class="btn" type="submit"> Sign In</button>
    </div>
</template>

<script>
export default {
    data(){
        return {
            username:'',
            password:'',
            showPopup : true
        }
    },
    methods : {
        submitForm(){
            this.$emit('login', {username : this.username, password : this.password})
        }
    }
}
</script>

<style scoped> 
   

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        
    }
    .login-popup{
        border: 2px solid rgb(49, 49, 49,0.25);
        padding : 1em;
        border-radius: 5%;
        width: 280px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        color: black;
    }
    
    .login-popup h2{
        float: left;
        font-size: 40px;
        border-bottom: 6px solid #4caf50;
        margin-bottom: 50px;
        padding: 13px 0;
    }

    .textbox{
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        margin : 8px 0;
        border-bottom: 1px solid #4caf50;
    }

    .textbox :first-child {
        width: 26px;
        float: left;
        text-align: center;
    }

    .textbox input {
        border: none;
        outline: none;
        background: none;
        font-size: 18px;
        width: 80%;
        float: left;
        margin:  0 10px;
    }

    .btn {
        width: 100%;
        background: none;
        border: 2px solid #4caf50;
        padding: 5px;
        font-size: 18px;
        cursor: pointer;
        margin: 12px 0;
    }
</style>