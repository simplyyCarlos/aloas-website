<template>
    <div>
        <Dialog v-model:visible="showCreateAccountPopup" header="Création de compte" modal>
            <form @submit.prevent="handleSubmit">
                <div class="p-field">
                    <label for="firstName">Prénom</label>
                    <InputText id="firstName" v-model="formData.firstName" required />
                </div>
                <div class="p-field">
                    <label for="lastName">Nom</label>
                    <InputText id="lastName" v-model="formData.lastName" required />
                </div>
                <div class="p-field">
                    <label for="email">Adresse e-mail</label>
                    <InputText id="email" v-model="formData.email" type="email" required />
                </div>
                <div class="p-field">
                    <label for="password">Mot de passe</label>
                    <Password id="password" v-model="formData.password" required />
                </div>
                <div class="p-field">
                    <label for="confirmPassword">Confirmation du mot de passe</label>
                    <Password id="confirmPassword" v-model="formData.confirmPassword" required />
                </div>
                <div class="p-field">
                    <Button type="submit" label="Créer le compte" />
                </div>
            </form>
        </Dialog>
    </div>
</template>
  
<script>
import axios from 'axios';
import { toastSuccess, toastError, toastInfo, toastWarn } from '../toastPlugin.js';
export default {
    data() {
        return {
            showCreateAccountPopup: true,
            formData: {
                firstName: '',
                lastName: '',
                email: '',
                password: '',
                confirmPassword: '',
            },
        };
    },
    methods: {
        handleSubmit() {
            if (this.formData.password != this.formData.confirmPassword) {
                toastError('Les mots de passe ne correspondent pas');
                return;
            }
            axios.post('http://localhost:8080/src/api/createAccountApi.php', {
                prenom: this.formData.firstName,
                nom: this.formData.lastName,
                email: this.formData.email,
                password: this.formData.password,
            }).then((response) => {
                if (response != null) {
                    console.log(response);
                    if (response.status == 200) {
                        this.$emit('create-account-sucess');
                    }
                    else if (response.status == 201) {
                        toastWarn('Un compte existe déjà avec cette adresse e-mail');
                    }
                    else if (response.status == 202) {
                        toastError('Impossible de créer le compte');
                    }
                    else {
                        toastError('Une erreur est survenue');
                    }
                }
            });
        },
        resetForm() {
            this.formData = {
                firstName: '',
                lastName: '',
                email: '',
                password: '',
                confirmPassword: '',
            };
            this.$emit('toggle-create-account-popup');
        },
    },
};
</script>
  
<style scoped>
/* Ajoutez vos styles CSS ici */
</style>
  