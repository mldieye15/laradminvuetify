<template >
    <AppLayout>
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
                icons-and-text
            >
                <v-tabs-slider></v-tabs-slider>

                <v-tab href="#presentation">
                    Présentation
                </v-tab>

                <v-tab href="#tab-2">
                    Missions
                </v-tab>

                <v-tab href="#tab-3">
                    Moyens
                </v-tab>

                <v-tab href="#tab-4">
                    Textes
                </v-tab>

                <v-tab href="#tab-5">
                    Fonction
                </v-tab>

                <v-tab href="#tab-6">
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
                                    <v-card-subtitle>Ligues régionales</v-card-subtitle>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    COntente
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-card-subtitle>Commissions</v-card-subtitle>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    COntente
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-card-subtitle>Activités</v-card-subtitle>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    COntente
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <!--<v-card class="px-2">
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
                        </v-card>-->
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
import AppLayout from '../../Layouts/App/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'Federation',
    components:{
        AppLayout
    },
    props:  ['federation', 'errors'],
    data () {
      return {
        items: [
            {
                text: 'Tableau de bord',
                disabled: false,
                href: '/dashboard',
            },
            {
                text: 'Fédération',
                disabled: true,
                href: '/app/fede',
            },
            {
                text: 'Liste',
                disabled: true,
                href: '/federations',
            },
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
