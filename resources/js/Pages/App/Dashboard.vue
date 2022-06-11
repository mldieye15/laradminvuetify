<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
        app
    >

        <template v-slot:prepend>
            <v-list-item two-line>
            <v-list-item-avatar>
                <img src="https://randomuser.me/api/portraits/women/85.jpg">
            </v-list-item-avatar>

            <v-list-item-content>
                <v-list-item-title>Lamine DIEYE</v-list-item-title>
                <v-list-item-subtitle>Logged In</v-list-item-subtitle>
                <br/>
                <v-btn color="default">
                    Se déconnecter
                </v-btn>
            </v-list-item-content>
            </v-list-item>

      </template>


      <v-list>
            <v-list-group
                v-for="item in items"
                :key="item.title"
                v-model="item.active"
                :prepend-icon="item.action"
                no-action
            >
                <template v-slot:activator>
                <v-list-item-content>
                    <v-list-item-title v-text="item.title"></v-list-item-title>
                </v-list-item-content>
                </template>

                <v-list-item
                v-for="child in item.items"
                :key="child.title"
                >
                <v-list-item-content>
                    <v-list-item-title v-text="child.title"></v-list-item-title>
                </v-list-item-content>
                </v-list-item>
            </v-list-group>
        </v-list>
      <!--  -->
      <v-card
        class="mx-auto"
        max-width="500"
      >

        </v-card>
      <!-- -->
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <!--  -->
    </v-main>

    <v-footer padless>
        <v-col
        class="text-center"
        cols="12"
        >
        {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
        </v-col>
   </v-footer>
  </v-app>
</template>

<script>
  export default {
    name: "Dashboard",
    //data: () => ({ drawer: null }),
    data: () => ({
        drawer: null,
        items: [
            {
                action: 'mdi-view-dashboard-outline ',
                //items: [{ title: 'List Item' }],
                title: 'Tableau de bord',
            },
            {
                action: 'mdi-ticket',
                items: [{ title: 'List Item' }],
                title: 'Attractions',
            },
            {
                action: 'mdi-silverware-fork-knife',
                active: true,
                items: [
                    { title: 'Breakfast & brunch' },
                    { title: 'New American' },
                    { title: 'Sushi' },
                ],
                title: 'Dining',
            },
            {
                action: 'mdi-school',
                items: [{ title: 'List Item' }],
                title: 'Education',
            },
            {
                action: 'mdi-human-male-female-child',
                items: [{ title: 'List Item' }],
                title: 'Family',
            },
            {
                action: 'mdi-bottle-tonic-plus',
                items: [{ title: 'List Item' }],
                title: 'Health',
            },
            {
                action: 'mdi-briefcase',
                items: [{ title: 'List Item' }],
                title: 'Office',
            },
            {
                action: 'mdi-tag',
                items: [{ title: 'List Item' }],
                title: 'Promotions',
            },
        ],
        /*items: [
                {
                    action: 'mdi-folder-open',
                    items: [
                        { 
                            title: 'Fédération',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Ligue régional',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Centre de formation',
                            route: 'basicdata.index'
                        },
                    ],
                    title: 'Textes & réglements',
                },
                {
                    action: 'mdi-ticket',
                    items: [
                        { 
                            title: 'Licences',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Commissions',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Equipe nationale',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'La fédération',
                            route: 'basicdata.index'
                        },
                    ],
                    title: 'Fédération',
                },

                {
                    action: 'mdi-briefcase',
                    items: [
                        { 
                            title: 'Ligue régionale',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Club',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Centre de formation',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Association',
                            route: 'basicdata.index'
                        },
                    ],
                    title: 'Structures sportive',
                },
                {
                    action: 'mdi-human-male-female-child',
                    items: [
                        { title: 'Joueurs',
                            route: 'basicdata.index'
                        },
                        { title: 'Médecins',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Entraîneurs',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Techniciens',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Mangers',
                            route: 'basicdata.index'
                        }
                    ],
                    title: 'Effective',
                },
                {
                    action: 'mdi-google-controller',
                    items: [
                        { 
                            title: 'Rencontre',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Résultats',
                            route: 'basicdata.index'
                        },
                    ],
                    title: 'Jeux',
                },
                {
                    action: 'mdi-calendar-clock-outline',
                    items: [
                        {
                            title: 'Calendrier',
                            route: 'basicdata.index'
                        },
                        { title: 'Programmation match' },
                    ],
                    title: 'Planning',
                },
                {
                    action: 'mdi-database-cog',
                    items: [
                        { 
                            title: 'Localisation',
                            route: 'app/intial-data/',
                            
                        },
                    ],
                    title: 'Données de base',
                },
                {
                    action: 'mdi-cog-transfer',
                    items: [
                        { 
                            title: 'Calendrier',
                            route: 'basicdata.index'
                        },
                        { 
                            title: 'Programmation match',
                            route: 'basicdata.index'
                        },
                    ],
                    title: 'Paramétrage',
                },
            ],*/
    }),
  }
</script>
