<template >
    <v-container>
        <v-toolbar flat>
            <!--<v-app-bar-nav-icon></v-app-bar-nav-icon>-->

            <v-toolbar-title>FB RIM</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-toolbar-items text class="hidden-xs-only">
                <inertia-link :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : ''">
                    <v-btn text class="nav-link">
                        Accueil
                    </v-btn>
                </inertia-link>
            </v-toolbar-items>

            <v-toolbar-items text v-if="$page.props.user" class="hidden-xs-only">
                <inertia-link :href="route('dashboard.index')" :class="route().current('dashboard.index') ? 'nav-current' : ''">
                    <v-btn text class="nav-link">
                        Tableu de bord
                    </v-btn>
                </inertia-link>
                <form @submit.prevent="logout" class="d-inline-flex align-center ">
                    <v-btn text type="submit" class="nav-link">
                        Déconnexion
                    </v-btn>
                </form>
            </v-toolbar-items>

            <v-toolbar-items text v-else class="hidden-xs-only">
                <inertia-link :href="route('login')" :class="route().current('login') ? 'nav-current' : ''">
                    <v-btn text class="nav-link">
                        Mon espace
                    </v-btn>
                </inertia-link>
                <!--<inertia-link :href="route('register')" :class="route().current('register') ? 'nav-current' : ''">
                    <v-btn text class="nav-link">
                        Inscription
                    </v-btn>
                </inertia-link>-->
            </v-toolbar-items>

            <v-toolbar-items text class="hidden-sm-and-up">
                <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            </v-toolbar-items>
            <div class="hidden-sm-and-up" primary>
                <v-navigation-drawer v-model="drawer" temporary app right >
                    <v-list nav dense v-if="$page.props.user" >
                        <v-list-item-group v-model="group" >
                            <v-list-item>
                                <v-btn text class="sideButton">
                                    <v-icon left small>mdi-home-city</v-icon>
                                    <inertia-link :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : ''">Accueil</inertia-link>
                                </v-btn>
                            </v-list-item>
                            <v-list-item>
                                <v-btn text class="sideButton">
                                    <v-icon left small>mdi-speedometer</v-icon>
                                    <inertia-link :href="route('dashboard.index')" :class="route().current('dashboard.index') ? 'nav-current' : ''">Tableau de bord</inertia-link>
                                </v-btn>
                            </v-list-item>
                            <v-list-item>
                                <form @submit.prevent="logout" class="d-inline-flex align-center">
                                    <v-btn text type="submit" class="sideButton">
                                        <v-icon left small>mdi-logout</v-icon>
                                        Déconnexion
                                    </v-btn>
                                </form>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>

                    <v-list nav dense >
                        <v-list-item-group v-model="group">
                            <v-list-item>
                                <v-btn text class="sideButton">
                                    <inertia-link :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : ''">Accueil</inertia-link>
                                </v-btn>
                            </v-list-item>
                            <v-list-item>
                                <v-btn text class="sideButton">
                                    <inertia-link :href="route('login')" :class="route().current('login') ? 'nav-current' : ''">Mon espace</inertia-link>
                                </v-btn>
                            </v-list-item>
                            <!--<v-list-item>
                                <v-btn text class="sideButton">
                                    <inertia-link :href="route('register')" :class="route().current('register') ? 'nav-current' : ''">Inscription</inertia-link>
                                </v-btn>
                            </v-list-item>-->
                        </v-list-item-group>
                    </v-list>
                </v-navigation-drawer>
            </div>
        </v-toolbar>
    </v-container>
</template>

<script>

export default {
    name: 'Header',
    components:{},
    data: () => ({
        drawer: false,
        group: null,
    }),
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        }
    },
    watch: {
        group() {
            this.drawer = false
        }
    }
}
</script>

<style scoped>
    .nav-link{
        height: 100% !important;
        border-radius: 0px;
    }
    .nav-current{
        border-bottom: 2px solid grey;
        font-style: italic;
    }

    .sideButton:hover:before {
        opacity: 0;
    }
</style>
