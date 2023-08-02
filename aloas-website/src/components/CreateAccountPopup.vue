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
    <Toast ref="toast" position="top-right"/>
</template>
  
<script>
import axios from 'axios';
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
            console.log(this.formData);
            if (this.formData.password != this.formData.confirmPassword) {
                console.log("Les mots de passe ne correspondent pas");
                this.showError('Les mots de passe ne correspondent pas');
                return;
            }
            axios.post('http://localhost:8080/src/api/userApi.php', {
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
                        console.log("Email déjà utilisé");
                        this.showWarning('l\'adresse e-mail est déjà utilisée');
                    }
                    else if (response.status == 202) {
                        this.showError('Impossible de créer le compte');
                    }
                    else {
                        this.showError('Une erreur est survenue');
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
        showError(message) {
            this.$toast.add({
                severity: 'error',
                summary: 'Erreur',
                detail: message,
                life: 3000,
            });
        },
        showWarning(message) {
            this.$toast.add({
                severity: 'warn',
                summary: 'Attention',
                detail: message,
                life: 3000,
            });
        },
    },
};
</script>
  
<style scoped>
/* Ajoutez vos styles CSS ici */
</style>
  