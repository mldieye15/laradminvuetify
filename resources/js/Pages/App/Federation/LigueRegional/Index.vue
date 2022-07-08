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

                <v-tab href="#club">
                    Clubs
                </v-tab>

                <v-tab href="#centre-form">
                    Centre de formation
                </v-tab>

                <v-tab href="#association">
                    Association
                </v-tab>

                <v-tab href="#staff">
                    Staff
                </v-tab>

                <v-tab href="#activites">
                    Activités
                </v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item value="presentation" >
                    <v-expansion-panels>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <v-card-subtitle>Présentation</v-card-subtitle>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <v-row class="mb-0 mx-auto">
                                    <v-text-field class="mb-3 mx-auto" v-model="searchLigue" append-icon="mdi-magnify" label="Search" single-line hide-details ></v-text-field>
                                    <v-spacer></v-spacer>
                                     <inertia-link  class="-mb-40" :href="route('ligregio.create')">
                                        <v-btn color="primary" dark class="mb-0">Nouveau</v-btn>
                                    </inertia-link>


                                </v-row>
                                <v-data-table
                                    :headers="headers"
                                    :items="ligueRegionales"
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
                                        <v-icon small class="mr-2" @click="editItem(item.id)" color="blue darken">mdi-pencil</v-icon>
                                        <v-icon small class="mr-2" @click="deleteItem(item.id)" color="red darken">mdi-delete</v-icon>
                                    </template>
                                </v-data-table>
                            </v-expansion-panel-content>
                        </v-expansion-panel>

                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <v-card-subtitle>Commissions</v-card-subtitle>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                Commissions
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-tab-item>

                <v-tab-item
                    value="club"
                >
                    <v-container>
                        Club
                    </v-container>
                </v-tab-item>

                <v-tab-item
                    value="centre-form"
                >
                    <v-container>
                        Centre de formation
                    </v-container>
                </v-tab-item>

                <v-tab-item
                    value="association"
                >
                    <v-container>
                        Association
                    </v-container>
                </v-tab-item>

                <v-tab-item
                    value="staff"
                >
                    <v-container>
                        Staff
                    </v-container>
                </v-tab-item>

                <v-tab-item
                    value="activites"
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
import AppLayout from '../../../Layouts/App/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import Breadcrumbs from '../../../../components/Breadcrumbs.vue';

export default {
    name: 'Index',
    components:{
    AppLayout,
    Breadcrumbs
},
    props:  ['ligueRegionales', 'errors'],
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
                disabled: true,
                route: 'ligregio.index',
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
      }
    },
    computed: {},
    watch: {},
    created () {},
    methods: {
        editItem(item){
            console.log(item);
            Inertia.post(`/app/fede/lig-regio/edit`, {
                _method: 'post',
                ligue: item,
            });
        },
        deleteItem(item){
            console.log(item);
            //this.$inertia.delete(`/app/fede/lig-regio/${item}`);
            Inertia.post(`/app/fede/lig-regio/${item}`, {
                _method: 'delete'
            });
        }
    },
}
</script>
