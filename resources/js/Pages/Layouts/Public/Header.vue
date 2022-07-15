<template >
    <v-container>
        <v-toolbar flat>
            <!--<v-app-bar-nav-icon></v-app-bar-nav-icon>-->

            <v-toolbar-title text>
                <inertia-link :href="route('welcome')" :class="route().current('welcome') ? 'nav-current-' : ''">
                    <v-btn text class="nav-link-">
                        FB BRIM
                    </v-btn>
                </inertia-link>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <!--<v-toolbar-items text class="hidden-xs-only">
                <inertia-link :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : ''">
                    <v-btn text class="nav-link">
                        Accueil
                    </v-btn>
                </inertia-link>
            </v-toolbar-items>-->
            <v-toolbar-items text class="hidden-xs-only">
                <inertia-link :href="route('welcome')" :class="route().current('welcome') ? 'nav-current-' : ''">
                    <v-menu
                        open-on-hover
                        bottom
                        offset-y
                     >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="black"
                                dark
                                v-bind="attrs"
                                v-on="on"
                                text
                                class="nav-link"
                            >
                            La fédération
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.presentation.index')" :class="route().current('public.presentation.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Présentation
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.organisation.index')" :class="route().current('public.organisation.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Organisation
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.mediateque.index')" :class="route().current('public.mediateque.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Médiathéque
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>

                    <v-menu
                        open-on-hover
                        bottom
                        offset-y
                     >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="black"
                                dark
                                v-bind="attrs"
                                v-on="on"
                                text
                                class="nav-link"
                            >
                            Structures
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.club.index')" :class="route().current('public.club.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Club
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.centreform.index')" :class="route().current('public.centreform.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Centre de formation
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.association.index')" :class="route().current('public.association.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Association
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>

                    <v-menu
                        open-on-hover
                        bottom
                        offset-y
                     >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="black"
                                dark
                                v-bind="attrs"
                                v-on="on"
                                text
                                class="nav-link"
                            >
                            Textes
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.reglement.index')" :class="route().current('public.reglement.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Réglements
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>

                    <v-menu
                        open-on-hover
                        bottom
                        offset-y
                     >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="black"
                                dark
                                v-bind="attrs"
                                v-on="on"
                                text
                                class="nav-link"
                            >
                            Activités
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.calendrier.index')" :class="route().current('public.calendrier.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Calendrier
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.match.index')" :class="route().current('public.match.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Match
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-title>
                                    <inertia-link :href="route('public.resultat.index')" :class="route().current('public.resultat.index') ? 'nav-current-bis' : ''">
                                        <v-btn text class="nav-link-bis">
                                            Résultats
                                        </v-btn>
                                    </inertia-link>
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
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
                                    <v-icon left small>mdi-home-city</v-icon>
                                    <inertia-link :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : ''">La Fédération</inertia-link>
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

    .nav-current-bis{
        border-bottom: 0px solid grey;
        font-style: italic;
    }

    .sideButton:hover:before {
        opacity: 0;
    }
</style>
