<template >
    <AuthLayout>
        <v-container>
            <v-row align="center" justify="center" >
                <v-col cols="12" sm="10">
                    <v-card class="elevation-6 mt-5"  >
                        <v-window v-model="step">
                            <v-window-item :value="1">
                                <v-row>
                                    <v-col cols="12" md="6">
                                    <v-card-text class="mt-12">
                                        <h1 class="text-center" >Espace de connexion</h1>
                                        <v-img :src="logo" aspect-ratio="1" max-width="160" max-height="160" class="mx-auto"></v-img>
                                        <span class="v-messages them--dark error--text subtitle-1" v-if="form.errors.email">
                                            {{ form.errors.email }}
                                        </span>
                                        <v-row align="center" justify="center">
                                            <v-col cols="12" sm="8">
                                                <v-text-field
                                                    label="Email"
                                                    outlined
                                                    dense
                                                    color="blue"
                                                    autocomplete="false"
                                                    class="mt-16"
                                                    v-model="form.email"
                                                    :rules="emailRules"
                                                />
                                                <v-text-field
                                                    label="Password"
                                                    outlined
                                                    dense
                                                    color="blue"
                                                    autocomplete="false"
                                                    v-model="form.password"
                                                    :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                                    :rules="passwordRules"
                                                    :type="show ? 'text' : 'password'"
                                                    @click:append="show = !show"
                                                />
                                                <v-row>
                                                    <v-col cols="12" sm="7">
                                                        <v-checkbox
                                                            label="Remember Me"
                                                            class="mt-n1"
                                                            color="blue"
                                                        > </v-checkbox>
                                                    </v-col>
                                                    <v-col cols="12" sm="5">
                                                        <span class="caption blue--text">Forgot password</span>
                                                    </v-col>
                                                </v-row>
                                                <v-btn
                                                    color="blue" dark block tile
                                                    :disabled="form.processing"
                                                    @click.prevent="login"
                                                >Log in</v-btn>
                                                <!--<h5 class="text-center  grey--text mt-4 mb-3">Or Log in using</h5>
                                                    <div class="d-flex  justify-space-between align-center mx-10 mb-16">
                                                    <v-btn depressed outlined color="grey">
                                                    <v-icon color="red">fab fa-google</v-icon>
                                                    </v-btn>
                                                    <v-btn depressed outlined color="grey">
                                                    <v-icon color="blue">fab fa-facebook-f</v-icon>
                                                    </v-btn>
                                                    <v-btn depressed outlined color="grey">
                                                    <v-icon color="light-blue lighten-3">fab fa-twitter</v-icon>
                                                    </v-btn>
                                                    </div>-->
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                    </v-col>
                                    <v-col cols="12" md="6" class="blue rounded-bl-xl" >
                                    <div style="  text-align: center; padding: 180px 0;">
                                    <v-card-text class="white--text" >
                                        <h3 class="text-center ">Don't Have an Account Yet?</h3>
                                        <h6
                                        class="text-center"
                                        >Let's get you all set up so you can start creating your your first<br>  onboarding experience</h6>
                                    </v-card-text>
                                    <div class="text-center">
                                        <v-btn tile outlined dark  class="red lighten-5">
                                            <inertia-link :href="route('register')" ><span>Inscription</span></inertia-link>
                                        </v-btn>
                                        <v-btn tile outlined dark  class="ml-4 grey lighten-5">
                                            <inertia-link :href="route('welcome')" ><span>Accueil</span></inertia-link>
                                        </v-btn>
                                    </div>
                                    </div>
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
    name: 'Login',
    components:{
        AuthLayout
    },
    data() {
        return {
            step: 1,
            logo: require('../../../images/01/logo.jpg'),
            form: this.$inertia.form({
                email: '',
                password: '',
            }),
            show: false,
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            passwordRules: [
                v => !!v || 'Password is required',
            ],
        }
    },
    methods: {
        login() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password', 'email')
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
