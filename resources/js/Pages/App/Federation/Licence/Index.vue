<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>
        <v-card>
            <v-container>
                <v-row class="mb-0 mx-auto pa-1">
                    <v-text-field class="mb-3 mx-auto" v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details ></v-text-field>
                    <v-spacer></v-spacer>
                        <inertia-link  class="mt-4" :href="route('club.create')">
                        <v-btn color="primary" dark class="mb-0">Nouveau</v-btn>
                    </inertia-link>
                </v-row>
                <v-data-table
                    :headers="headers"
                    :items="associations"
                    :search="search"
                    :items-per-page="5"
                    sort-by="calories"
                    class="elevation-1"
                >
                    <template v-slot:item.ligue_regionale="{ item }">
                        <div class="m-1">
                            {{JSON.parse(item.ligue_regionale).sigle}}
                        </div>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <inertia-link class="mx-auto" :href="`/app/fede/structures/associations/${item.id}`" ><v-icon small class="mr-2" >mdi-eye</v-icon></inertia-link>
                        <v-icon small class="mr-2" @click="editItem(item.id)" color="blue darken">mdi-pencil</v-icon>
                        <v-icon small class="mr-2" @click="deleteItem(item.id)" color="red darken">mdi-delete</v-icon>
                    </template>
                </v-data-table>
            </v-container>
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
    props:  ['associations', 'errors'],
    data () {
      return {
        search: '',
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
                text: 'Licences',
                disabled: true,
                route: 'ligregio.index',
            },
            {
                text: 'Demandes',
                disabled: true,
                route: 'association.index',
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
            { text: 'Ligue', value: 'ligue_regionale' },
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
            Inertia.post(`/app/fede/structures/associations/edit`, {
                _method: 'post',
                club: item,
            });
        },
        deleteItem(item){
            console.log(item);
            //this.$inertia.delete(`/app/fede/lig-regio/${item}`);
            Inertia.post(`/app/fede/structures/associations/${item}`, {
                _method: 'delete'
            });
        }
    },
}
</script>
