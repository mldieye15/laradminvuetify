<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>

        <v-card>
            <v-tabs
                v-model="tab"
                background-color="green darken-4"
                centered
                dark
                icons-and-text
            >
                <v-tabs-slider></v-tabs-slider>

                <v-tab href="#presentation">
                    Présentation
                </v-tab>

                <v-tab href="#tab-2">
                    Carriére
                </v-tab>

                <v-tab href="#tab-3">
                    Licences
                </v-tab>

                <v-tab href="#tab-4">
                    Médecins
                </v-tab>

                <v-tab href="#tab-5">
                    Statistique
                </v-tab>

                <v-tab href="#tab-6">
                    Activités
                </v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item
                    value="presentation"
                    v-for='item in personne'
                    :key='item._id'
                >
                    <v-container>
                        <v-expansion-panels>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-card-subtitle>Présentation</v-card-subtitle>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-card class="px-1 py-1 mx-auto" elevation="1">
                                        <v-row cols="8">
                                            <v-col >
                                                <v-list-item-content class="ma-5 pa-10">
                                                    <!--<v-avatar size="110" class="mx-auto">
                                                    <img :src="item.photo" alt="photo pr">
                                                </v-avatar>-->
                                                    <v-list-item-title class="text-h5 ">
                                                        <v-row>
                                                            <v-col cols="12" sm="12" md="8">
                                                                <LogoFederation />
                                                            </v-col>
                                                            <v-col cols="12" sm="12" md="4">
                                                                <v-avatar size="110" class="mx-auto">
                                                                    <img :src="item.photo" alt="Photo profile">
                                                                </v-avatar>
                                                            </v-col>
                                                        </v-row>
                                                        
                                                    </v-list-item-title>
                                                    <v-list-item-subtitle>Nom et Prénoms: <span class="subtitle-2">{{item.nom}} {{item.prenoms}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Numéro CIN: <span class="subtitle-2">{{item.piece_ident}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Date de naissance: <span class="subtitle-2">{{item.date_naiss}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Lieu de naissance: <span class="subtitle-2">{{item.lieu_naiss}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Nationalité: <span class="subtitle-2">{{JSON.parse(item.pays_natio).sigle}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Sexe: <span class="subtitle-2">{{item.sexe}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Fonction: <span class="subtitle-2">{{item.fonction}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Téléphone: <span class="subtitle-2">{{item.telephone}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Date de Adresse: <span class="subtitle-2">{{item.adresse}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Catégorie: <span class="subtitle-2">En cours</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Taille: <span class="subtitle-2">{{item.taille}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Poids: <span class="subtitle-2">{{item.poids}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Ligue: <span class="subtitle-2">En cours</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Club: <span class="subtitle-2">En cours</span></v-list-item-subtitle>
                                                </v-list-item-content>
                                                
                                                <v-list-item-content>
                                                    <v-list-item-subtitle>Communauté: <span><v-icon>mdi-twitter</v-icon></span> &nbsp;&nbsp;<span><v-icon>mdi-facebook</v-icon></span> &nbsp;</v-list-item-subtitle>
                                                </v-list-item-content>
                                            </v-col>
                                            
                                        </v-row>
                                    </v-card>
                                </v-expansion-panel-content>
                            </v-expansion-panel>

                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-card-subtitle>Organisation</v-card-subtitle>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-card>
                                        <v-card-text>
                                        <p class="text-lg-right">Right align on large viewport sizes</p>
                                        <p class="text-md-center">Center align on medium viewport sizes</p>
                                        <p class="text-sm-left">Left align on small viewport sizes</p>
                                        <p class="text-xs-center">Center align on all viewport sizes</p>
                                        <p class="text-xs-right">Right align on all viewport sizes</p>
                                        </v-card-text>
                                    </v-card>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-container>
                </v-tab-item>
                <v-tab-item
                    v-for="i in 5"
                    :key="i"
                    :value="'tab-' + i"
                >
                    <v-card flat>
                        <v-card-text>{{ text }}</v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </v-card>
    </AppLayout>
</template>

<script>
import AppLayout from '../../../Layouts/App/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import Breadcrumbs from '../../../../components/Breadcrumbs.vue';
import LogoFederation from '../../../../components/LogoFederation.vue';

export default {
    name: 'Details',
    components:{
        AppLayout,
        Breadcrumbs,
        LogoFederation
    },
    props:  ['personne', 'errors'],
    data () {
      return {
        searchLigue: '',
        
        items: [
            {
                text: 'Tableau de bord',
                disabled: false,
                route: 'dashboard.index',
            },
            {
                text: 'Fédération',
                disabled: false,
                route: 'federations.index',
            },
            {
                text: 'Ligue régional',
                disabled: false,
                route: 'ligregio.index',
            },
            {
                text: 'Personne',
                disabled: false,
                route: 'personne.index',
            },
            {
                text: 'Détails',
                disabled: true,
                route: 'personne.index',
            }
        ],
        //
        headers: [
            {
            text: 'Sigle',
            align: 'start',
            sortable: false,
            value: 'sigle',
            },
            { text: 'Email', value: 'email' },
            { text: 'Adresse', value: 'adresse' },
            { text: 'Région', value: 'region' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        tab: null,
        text: 'Contenu',

        form: this.$inertia.form({
            libelle: null,
            sigle: null,
            email: null,
            adresse: '',
            telephone: '',
            sologan: null,
            fax: null,
            date_creation: null,
            recipisse_numero: null,
            recipisse_date: null,
            recipisse_url: null,
            reglement_int_url: null,
            page_web: null,
            facebook: null,
            whatsapp: null,
            telegram: null,
            instagram: null,
            tiktok: null,
            logo: null,
        }),
      }
    },

    computed: {},

    watch: {},

    created () {},

    methods: {

    },
}
</script>
