<template >
    <AuthLayout>
        <v-container>
            <v-row align="center" justify="center" >
                <v-col cols="12" sm="10">
                    <v-card class="elevation-6 mt-5"  >
                        <v-window v-model="step">
                            <v-window-item :value="2">
                                <v-row >
                                    <v-col cols="12" md="6" class="blue rounded-br-xl">
                                        <div style="  text-align: center; padding: 180px 0;">
                                            <v-card-text class="white--text" >
                                                <h1 class="text-center ">Vous avez déja un compte?</h1>
                                                <h6 class="text-center" >Vous utilisez votre compte pour collaborer avec l'ensemble des acteurs du basket mauritanien</h6>
                                            </v-card-text>
                                            <div class="text-center">
                                                <v-btn tile outlined dark  class="mr-4 grey lighten-5">
                                                    <inertia-link :href="route('welcome')" ><span>Accueil</span></inertia-link>
                                                </v-btn>
                                                <v-btn tile outlined dark  class="red lighten-5">
                                                    <inertia-link :href="route('login')" ><span>Connexion</span></inertia-link>
                                                </v-btn>
                                            </div>
                                        </div>
                                    </v-col>
                                    <v-col cols="12" md="6">
                                        <v-card-text class="mt-5">
                                            <h1 class="text-center" >Espace d'inscription</h1>
                                            <v-img :src="logo" aspect-ratio="1" max-width="160" max-height="160" class="mx-auto"></v-img>
                                            <v-row align="center" justify="center">
                                                <span class="v-messages them--dark error--text subtitle-1" v-if="form.errors.email">
                                                    {{ form.errors.email }}
                                                </span>
                                            <v-col cols="12" sm="8">
                                                <v-row>
                                                    <v-col >
                                                        <v-text-field
                                                            label="Nom complet"
                                                            outlined
                                                            dense
                                                            color="blue"
                                                            autocomplete="false"
                                                            class="mt-4"
                                                            v-model="form.name"
                                                            :counter="80"
                                                            :rules="nameRules"
                                                        />
                                                    </v-col>
                                                </v-row>
                                                <v-text-field
                                                    label="Email"
                                                    outlined
                                                    dense
                                                    color="blue"
                                                    v-model="form.email"
                                                    autocomplete="false"
                                                    :rules="emailRules"
                                                />
                                                <v-text-field
                                                    label="Mot de passe"
                                                    outlined
                                                    dense
                                                    color="blue"
                                                    autocomplete="false"
                                                    v-model="form.password"
                                                    append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                                    :rules="passwordRules"
                                                    :type="show1 ? 'text' : 'password'"
                                                    name="input-10-2"
                                                    @click:append="show1 = !show1"
                                                />
                                                <v-text-field
                                                    label="Confirmation mot de passe"
                                                    outlined
                                                    dense
                                                    color="blue"
                                                    autocomplete="false"
                                                    v-model="form.password_confirmation"
                                                    rules="passwordConfirmationRule"
                                                    :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                                                    :type="show2 ? 'text' : 'password'"
                                                    name="input-10-2"
                                                    @click:append="show2 = !show2"
                                                />
                                                <v-row>
                                                    <v-col cols="12" sm="7">
                                                        <v-checkbox
                                                            label="I Accept Terms"
                                                            class="mt-n1"
                                                            color="blue"
                                                        > </v-checkbox>
                                                    </v-col>
                                                    <v-col cols="12" sm="5">
                                                        <span class="caption blue--text ml-n4">Terms &Conditions</span>
                                                    </v-col>
                                                </v-row>
                                                <v-btn color="blue" dark block tile
                                                    @click.prevent="register"
                                                >S'inscrire</v-btn>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-col>
                            </v-row>
                        </v-window-item>
                    </v-window>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    </AuthLayout>
</template>

<script>
import AuthLayout from '../Layouts/Auth/AuthLayout'

export default {
    name: 'Register',
    components:{
        AuthLayout
    },
    data() {
        return {
            step: 2,
            logo: require('../../../images/01/logo.jpg'),
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }),
            show1: false,
            show2: false,
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 50) || 'Name must be less than 50 characters',
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            passwordRules: [
                v => !!v || 'Password is required',
                v => (v && v.length >= 6) || 'Password must be greater than 6 characters',
            ],
        }
    },
    computed: {
        passwordConfirmationRule() {
            return [
                this.form.password === this.form.password_confirmation || "Password must match",
                v => !!v || 'You must confirm your password.'
            ]
        }
    },
    methods: {
        register() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation')
            })
        }
    },
    props: {
        source: String
    }
}
</script>

<style scoped>
.v-application .rounded-bl-xl {
    border-bottom-left-radius: 300px !important;
}
.v-application .rounded-br-xl {
    border-bottom-right-radius: 300px !important;
}
</style>
