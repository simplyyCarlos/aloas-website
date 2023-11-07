<template>
    <div>
        <Dialog v-model:visible="localShowCreateAccountPopUp" class="title" header="Création de compte" modal>
            <form @submit.prevent="handleSubmit">
                <div class="p-fluid">
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
                        <Button type="submit" label="Créer le compte"/>
                    </div>
                </div>
            </form>
        </Dialog>
    </div>
</template>

<script>
import axios from 'axios';
import { showError, showWarn } from '../toastService';
import { mapState, mapActions, mapMutations } from 'vuex';

export default {
    data() {
        return {
            formData: {
                firstName: '',
                lastName: '',
                email: '',
                password: '',
                confirmPassword: '',
            },
        };
    },
    computed: {
        ...mapState(["showCreateAccountPopUp"]),
        localShowCreateAccountPopUp: {
            get() {
                return this.showCreateAccountPopUp;
            },
            set(value) {
                this.mutationToggleCreateAccountPopUp();
            },
        },
    },
    methods: {
        ...mapActions(["actionToggleCreateAccountPopUp"]),
        ...mapMutations(["mutationToggleCreateAccountPopUp"]),
        handleSubmit() {
            if (this.formData.password != this.formData.confirmPassword) {
                showWarn('Les mots de passe ne correspondent pas');
                return;
            }
            axios.post('http://localhost:8080/api/createAccountApi.php', {
                prenom: this.formData.firstName,
                nom: this.formData.lastName,
                email: this.formData.email,
                password: this.formData.password,
            }).then((response) => {
                if (response != null) {
                    console.log(response);
                    if (response.status == 200) {
                        this.$emit('create-account-sucess');
                    } else if (response.status == 201) {
                        showWarn('Adresse e-mail déjà utilisée');
                    } else if (response.status == 202) {
                        showError('Impossible de créer le compte');
                    } else {
                        showError('Une erreur est survenue');
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
/* Apply the same styles used in the second code */
/* Styles for the dialog and form container */
.p-dialog {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    margin: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.419);
}

/* Styles for form fields */
.p-field {
    margin-bottom: 20px;
}

/* Styles for labels */
.p-field label {
    font-weight: bold;
}

/* Styles for the submit button */


/* Add more styles as needed */
</style>
