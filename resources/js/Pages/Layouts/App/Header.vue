<template>
   <nav>
       <v-app-bar  color="red" dark app >
           <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
           <v-toolbar-title class="text-uppercase ">
               <span class="font-weight-light">FB</span>
               <span>RIM</span>
           </v-toolbar-title>
           <v-spacer></v-spacer>
           <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn
          text
          v-on="on"
        >
          <v-icon left>mdi-chevron-down</v-icon>
            <span>Menu</span>
        </v-btn>
      </template>
      <v-list flat>
        <!--<v-list-item v-for="link in links"  :key="link.text" router :to="link.route" active-class="border">
          <v-list-item-title >{{link.text}}</v-list-item-title>
        </v-list-item>-->
      </v-list>
            </v-menu>
            <form @submit.prevent="logout" class="d-inline-flex align-center">
                <v-btn text type="submit">
                    <span>Déconnexion</span>
                    <v-icon right>mdi-exit-to-app</v-icon>

                </v-btn>
            </form>
            <!--<v-btn text>
                <span>Exit</span>
                <v-icon right>exit_to_app</v-icon>
             </v-btn>-->
       </v-app-bar>
      <v-navigation-drawer v-model="drawer" dark app width="300" class="red darken-4" >
          <v-layout column align-center>
               <v-flex class="mt-5">
                    <v-avatar size="100">
                            <img :src="profile" alt="Photo profile">
                    </v-avatar>
                    <p class="white--text subheading mt-1 text-center" v-if="$page.props.user.name">{{ $page.props.user.name}}</p>
               </v-flex>
               <v-flex class="mt-4 mb-4">
                <!--<Popup />-->
               </v-flex>
          </v-layout>
          <v-list flat>
            <v-list-item key="Dashboard" active-class="border">
                  <v-list-item-action>
                     <v-icon >mdi-view-dashboard</v-icon>
                  </v-list-item-action>
                  <v-list-item-content >
                      <inertia-link :href="route('dashboard.index')" :class="route().current('dashboard.index') ? 'nav-current' : 'no-current'"><v-list-item-title v-text="">Tableau de bord</v-list-item-title></inertia-link>
                  </v-list-item-content>
              </v-list-item>

              <v-list-group  active-class="nav-current"  prepend-icon="mdi-folder-open" no-action>
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Textes & réglements</v-list-item-title>
                    </v-list-item-content>
                </template>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Fédération</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Ligue régional</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
             </v-list-group>

             <v-list-group  active-class="nav-current"  prepend-icon="mdi-ticket" no-action >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Fédération</v-list-item-title>
                    </v-list-item-content>
                </template>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Licences</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Commissions</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Equipe nationale</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >La fédération</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
             </v-list-group>

             <v-list-group  active-class="nav-current"  prepend-icon="mdi-office-building" no-action >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Structures sportive</v-list-item-title>
                    </v-list-item-content>
                </template>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Ligue régionale</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Club</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Centre de formation</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Association</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
             </v-list-group>

             <v-list-group  active-class="nav-current"  prepend-icon="mdi-human-male-female-child" no-action >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Effective</v-list-item-title>
                    </v-list-item-content>
                </template>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Joueurs</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Entraîneurs</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Techniciens</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Mangers</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
             </v-list-group>

             <v-list-group  active-class="nav-current"  prepend-icon="mdi-google-controller" no-action >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Jeux</v-list-item-title>
                    </v-list-item-content>
                </template>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Rencontre</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Résultats</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
             </v-list-group>

             <v-list-group  active-class="nav-current"  prepend-icon="mdi-calendar-clock-outline" no-action >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Planning</v-list-item-title>
                    </v-list-item-content>
                </template>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Calendrier</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('welcome')" :class="route().current('welcome') ? 'nav-current' : 'no-current'"><v-list-item-title >Programmation match</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
             </v-list-group>

             <v-list-group  active-class="nav-current"  prepend-icon="mdi-database-cog" no-action >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Données de base</v-list-item-title>
                    </v-list-item-content>
                </template>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('basicdata.index')" :class="route().current('basicdata.index') ? 'nav-current' : 'no-current'"><v-list-item-title >Localisation</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('pays.index')" :class="route().current('pays.index') ? 'nav-current' : 'no-current'"><v-list-item-title >Pays</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
             </v-list-group>

             <v-list-group  active-class="nav-current"  prepend-icon="mdi-cog-transfer" no-action >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Paramétrage</v-list-item-title>
                    </v-list-item-content>
                </template>
                <v-list-item active-class="nav-current">
                    <v-list-item-content>
                        <inertia-link class="mx-auto" :href="route('basicdata.index')" :class="route().current('basicdata.index') ? 'nav-current' : 'no-current'"><v-list-item-title >Localisation</v-list-item-title></inertia-link>
                    </v-list-item-content>
                </v-list-item>
             </v-list-group>
          </v-list>
      </v-navigation-drawer>
   </nav>
</template>
<script>
//import Popup from './Popup.vue'

export default {
    data() {
        return {
            drawer: true,
            profile: require('../../../../images/02/img1.png'),
        }
    },
    components: {
        //Popup
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        }
    },

}
</script>
<style scoped>
    .border {
        border-left: 4px solid white;
        color: white;
    }
    .nav-current{
        border-right: 4px solid #FFEBEE;
        font-style: italic;
        color: #F3E5F5 !important
    }
    .no-current{
        color: white !important
    }
</style>
