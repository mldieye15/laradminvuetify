<template >
    <AppLayout>
       <v-main class="ma-3">
           <v-breadcrumbs :items="items">
                <template v-slot:item="{ item }">
                <v-breadcrumbs-item
                    :href="item.href"
                    :disabled="item.disabled"
                >
                    {{ item.text.toUpperCase() }}
                </v-breadcrumbs-item>
                </template>
            </v-breadcrumbs>
           <v-card>
            <v-tabs
                v-model="tab"
                background-color="green darken-4"
                centered
                dark
            >
            <v-tabs-slider></v-tabs-slider>

                <v-tab href="#pays"> Pays </v-tab>
                <v-tab href="#region"> Region </v-tab>
                <v-tab href="#departement"> Départements </v-tab>
                <v-tab href="#tab-4"> Commune </v-tab>
                <v-tab href="#tab-5"> Quartiers </v-tab>
            </v-tabs>

        <v-tabs-items v-model="tab">
            <v-tab-item value="pays" >
                <v-card flat>
                    <v-card-text>
                        <v-data-table
                            :headers="headers"
                            :items="pays"
                            :items-per-page="5"
                            sort-by="libelle"
                            class="elevation-1 ma-1"
                        ></v-data-table>
                    </v-card-text>
                </v-card>
            </v-tab-item>

            <v-tab-item value="region" >
                <v-card flat>
                    <v-card-text>
                        <v-data-table
                            :headers="headers"
                            :items="regions"
                            :items-per-page="5"
                            class="elevation-1 ma-1"
                        ></v-data-table>
                    </v-card-text>
                </v-card>
            </v-tab-item>

            <v-tab-item value="departement" >
                <v-card flat>
                    <v-card-text>
                        <v-data-table
                            :headers="headers"
                            :items="regions"
                            :items-per-page="5"
                            class="elevation-1 ma-1"
                        ></v-data-table>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <!--<v-tab-item
                v-for="i in 4"
                :key="i"
                :value="'tab-' + i"
            >
                <v-card flat>
                    <v-card-text>
                     {{text}}
                    </v-card-text>

                    </v-card>

                </v-tab-item>-->
            </v-tabs-items>
        </v-card>

       </v-main>
    </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/App/AppLayout.vue';
export default {
    name: 'Localisation',
    components:{
        AppLayout
    },
    /*props: {
        pays: Object
    },*/
    props:  ['pays', 'regions'],
    data () {
      return {
        tab: null,
        headers:[
            { text: 'Nom complet', value: 'libelle' },
            { text: 'Nom', value: 'sigle' },
            { text: 'Indicatif', value: 'indicatif' },
        ],
        items: [
            {
                text: 'Tableau de bord',
                disabled: false,
                href: '/dashboard',
            },
            {
                text: 'Localisation',
                disabled: true,
                href: 'intial-data',
            },
        ],
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
      }
    },
}
</script>
