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

                <v-tab href="#ligue-regio">
                    Ligue Régionales
                </v-tab>

                <v-tab href="#struct-sport">
                    Structures sportive
                </v-tab>

                <v-tab href="#staff">
                    Staffs
                </v-tab>

                <v-tab href="#activites">
                    Activités
                </v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item
                    value="presentation"
                    v-for='item in federation'
                    :key='item._id'
                >
                    <v-container>
                        <v-expansion-panels>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-card-subtitle>Présentation</v-card-subtitle>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-card class="px-1 py-1" elevation="0">
                                        <v-row>
                                            <v-col cols="6">
                                                <v-list-item-content>
                                                    <v-list-item-title class="text-h5">
                                                    {{item.libelle}} <span class="subtitle-1">({{item.sigle}})</span>
                                                    </v-list-item-title>
                                                    <v-list-item-subtitle>Adresse: <span class="subtitle-2">{{item.adresse}}</span>. -- Email: <span class="subtitle-2">{{item.email}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Téléphone: <span class="subtitle-2">{{item.telephone}}</span>. -- Fax: <span class="subtitle-2">{{item.fax}}</span></v-list-item-subtitle>
                                                </v-list-item-content>
                                                <v-avatar size="110" class="mx-auto">
                                                    <img :src="item.logo" alt="Logo FB RIM">
                                                </v-avatar>
                                                <v-list-item-content>
                                                    <v-list-item-subtitle>Communauté: <span><v-icon>mdi-twitter</v-icon></span> &nbsp;&nbsp;<span><v-icon>mdi-facebook</v-icon></span> &nbsp;</v-list-item-subtitle>
                                                </v-list-item-content>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-list-item-content>
                                                    <v-list-item-title class="text-h5">
                                                    {{item.libelle}} <span class="subtitle-1">({{item.sigle}})</span>
                                                    </v-list-item-title>
                                                    <v-list-item-subtitle>Adresse: <span class="subtitle-2">{{item.adresse}}</span>. -- Email: <span class="subtitle-2">{{item.email}}</span></v-list-item-subtitle>
                                                    <v-list-item-subtitle>Téléphone: <span class="subtitle-2">{{item.telephone}}</span>. -- Fax: <span class="subtitle-2">{{item.fax}}</span></v-list-item-subtitle>
                                                </v-list-item-content>
                                                <v-card-text></v-card-text>
                                                <v-avatar size="110" class="mx-auto">
                                                    <img :src="item.logo" alt="Logo FB RIM">
                                                </v-avatar>
                                            </v-col>
                                        </v-row>
                                    </v-card>
                                </v-expansion-panel-content>
                            </v-expansion-panel>

                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-card-subtitle>Commissions</v-card-subtitle>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-data-table
                                        :headers="headers"
                                        :items="ligueRegionale"
                                        :search="searchLigue"
                                        :items-per-page="5"
                                        sort-by="calories"
                                        class="elevation-1"
                                    >
                                        <template v-slot:item.region="{ item }">
                                            <div class="m-1">
                                                {{JSON.parse(item.region).sigle}}
                                            </div>
                                        </template>
                                        <template v-slot:item.actions="{ item }">
                                            <inertia-link class="mx-auto" :href="`/app/fede/lig-regio/${item.id}`" ><v-icon small class="mr-2" >mdi-eye</v-icon></inertia-link>
                                        </template>
                                    </v-data-table>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-container>
                </v-tab-item>

                <v-tab-item
                    value="ligue-regio"
                    v-for='item in federation'
                    :key='item._id'
                >
                    <v-container>
                        <v-data-table
                            :headers="headers"
                            :items="ligueRegionale"
                            :search="searchLigue"
                            :items-per-page="5"
                            sort-by="calories"
                            class="elevation-1"
                        >
                            <template v-slot:item.region="{ item }">
                                <div class="m-1">
                                    {{JSON.parse(item.region).sigle}}
                                </div>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <inertia-link class="mx-auto" :href="`/app/fede/lig-regio/${item.id}`" ><v-icon small class="mr-2" >mdi-eye</v-icon></inertia-link>
                            </template>
                        </v-data-table>
                    </v-container>
                </v-tab-item>

                <v-tab-item
                    value="struct-sport"
                    v-for='item in federation'
                    :key='item._id'
                >
                    <v-container>
                        Club<br/>Centre de formation<br/>Association
                    </v-container>
                </v-tab-item>

                <v-tab-item
                    value="staff"
                    v-for='item in federation'
                    :key='item._id'
                >
                    <v-container>
                        Staff
                    </v-container>
                </v-tab-item>

                <v-tab-item
                    value="activites"
                    v-for='item in federation'
                    :key='item._id'
                >
                    <v-container>
                        Activités
                    </v-container>
                </v-tab-item>
            </v-tabs-items>
        </v-card>
    </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/App/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import Breadcrumbs from '../../../components/Breadcrumbs.vue';

export default {
    name: 'Federation',
    components:{
    AppLayout,
    Breadcrumbs
},
    props:  ['federation', 'ligueRegionale', 'errors'],
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
                disabled: true,
                route: 'federations.index',
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
        save () {
            if (this.editedIndex > -1) {
                Object.assign(this.quartiers[this.editedIndex], this.form);
                Inertia.post(`/app/intial-data/quartiers/${this.form.id}`, {
                    _method: 'put',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    codification: this.form.codification,
                    indicatif: this.form.indicatif,
                    map: this.form.map,
                    commune: this.selectedCommune
                })
            } else {
                this.form.commune = this.selectedCommune
                Inertia.post(`/app/intial-data/quartiers`, {
                    _method: 'post',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    codification: this.form.codification,
                    indicatif: this.form.indicatif,
                    map: this.form.map,
                    commune: this.selectedCommune
                })
                this.quartiers.push(this.form)
            }

            if(this.isErrorEmpty(this.errors)){
                this.close()
            }

        },

        isErrorEmpty(object) {
            var isEmpty = true;
            for (keys in object) {
                isEmpty = false;
                break;
            }
            return isEmpty;
        }
    },
}
</script>
