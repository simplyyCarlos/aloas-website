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

        closeDialog() {
            this.resetForm();
        },
        handleSubmit() {
            // Vous pouvez ajouter ici la logique pour envoyer les données du formulaire au serveur
            // Réinitialisez le formulaire et fermez la pop-up après la création réussie du compte
            this.closeDialog();
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
  