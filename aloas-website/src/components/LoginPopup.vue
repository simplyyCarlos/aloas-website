<template>
    <div>
        <div class="blur-overlay"></div>
        <div class="login-popup">
            <form @submit.prevent="handleLogin">
                <h2>Connexion</h2>
                <div class="close-popup" @click="this.$emit('toggle-login-popup')">
                    <font-awesome-icon :icon="['fas', 'xmark']" size="xl" />
                </div>
                <div class="textbox">
                    <font-awesome-icon :icon="['fas', 'user']" />
                    <input type="text" placeholder="Email" v-model="email" required>
                </div>

                <div class="textbox">
                    <font-awesome-icon :icon="['fas', 'lock']" />
                    <input type="password" placeholder="Mot de passe" v-model="password" required>
                </div>

                <button class="btn" type="submit">Connexion</button>
            </form>
            <a @click="actionToggleCreateAccountPopUp()" class="create-account">Pas encore inscrit ? Crée un compte</a>
        </div>
    </div>
    <CreateAccountPopup :showCreateAccountPopup="showCreateAccountPopUp"
        @toggle-create-account-popup="toggleCreateAccountPopup" @create-account-sucess="onCreateAccountSucess"
        v-if="showCreateAccountPopUp" />
</template>

<script>
import CreateAccountPopup from './CreateAccountPopup.vue'
import {mapState, mapActions} from 'vuex';
import {showSucess} from '../toastService';
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    computed: {
        ...mapState(["showCreateAccountPopUp"]),
    },
    methods: {
        async handleLogin() {
            try {
                await this.$store.dispatch("login", {
                    email: this.email,
                    password: this.password,
                });
                this.$emit("toggle-login-popup");
            } catch (error) {
                console.error(error);
            }
        },
        ...mapActions(["actionToggleCreateAccountPopUp"]),
        onCreateAccountSucess() {
            showSucess('Compte créé avec succès');
        },
    },
    components: {
        CreateAccountPopup,
    },
}
</script>

<style scoped> * {
     margin: 0;
     padding: 0;
     box-sizing: border-box;
     font-family: sans-serif;

 }

 .blur-overlay {
     position: fixed;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background-color: rgba(255, 255, 255, 0);
     backdrop-filter: blur(5px);
     z-index: 999;
 }

 .login-popup {
     position: fixed;
     top: 50%;
     left: 50%;
     min-width: 350px;
     max-width: 500px;
     width: 70%;
     transform: translate(-50%, -50%);
     z-index: 1000;
     background-color: white;
     padding: 1em;
     border-radius: 5px;
     box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
 }

 .login-popup h2 {
     float: left;
     font-size: 40px;
     border-bottom: 6px solid #4caf50;
     margin-bottom: 50px;
     padding: 13px 0;
 }

 .login-popup .btn:hover {
     background-color: #4caf50;
     color: white;
 }

 .textbox {
     width: 100%;
     overflow: hidden;
     font-size: 20px;
     padding: 8px 0;
     margin: 8px 0;
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
     margin: 0 10px;
 }

 .close-popup {
     cursor: pointer;
     position: fixed;
     padding: 1em;
     right: 0;
     top: 0;
     transition: transform 0.3s, box-shadow 0.3s;

 }

 .close-popup:hover {
     transform: scale(1.1);
     box-shadow: 0 2px 8px rgba (0, 0, 0, 0.3);
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

 .create-account {
     text-decoration: underline;
     color: #4caf50;
     font-size: 14px;
     margin: 10px 0;
     display: block;
     text-align: center;
     cursor: pointer;
 }
</style>