<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>
        <v-card>
            <v-container>
                <v-row class="mb-0 mx-auto pa-1">
                    <v-text-field class="mb-3 mx-auto" v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details ></v-text-field>
                    <v-spacer></v-spacer>
                        <inertia-link  class="mt-4" :href="route('personne.create')">
                        <v-btn color="primary" dark class="mb-0">Nouveau</v-btn>
                    </inertia-link>
                </v-row>
                <v-data-table
                    :headers="headers"
                    :items="personnes"
                    :search="search"
                    :items-per-page="5"
                    sort-by="calories"
                    class="elevation-1"
                >
                    <template v-slot:item.photo="{ item }">
                        <div class="ma-1">
                            <v-img :src="item.photo" :alt="item.photo" aspect-ratio="1" max-width="110" max-height="110" class="mx-auto"></v-img>
                        </div>
                    </template>
                    <template v-slot:item.pays_natio="{ item }">
                        <div class="m-1">
                            {{JSON.parse(item.pays_natio).sigle}}
                        </div>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <inertia-link class="mx-auto" :href="`/app/effective/personnes/${item.id}`" ><v-icon small class="mr-2" >mdi-eye</v-icon></inertia-link>
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
    props:  ['personnes', 'errors'],
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
                text: 'Ligue régional',
                disabled: false,
                route: 'ligregio.index',
            },
            {
                text: 'Personne',
                disabled: true,
                route: 'personne.index',
            }
        ],
        //
        headers: [
            { text: 'Photo', value: 'photo' },
            {
            text: 'Nom',
            align: 'start',
            sortable: false,
            value: 'nom',
            },
            { text: 'Prénoms', value: 'prenoms' },
            { text: 'Sexe', value: 'sexe' },
            { text: 'Date de naissance', value: 'date_naiss' },
            { text: 'Lieu de naissance', value: 'lieu_naiss' },
            { text: 'Piéce', value: 'piece_ident' },
            { text: 'Nationalité', value: 'pays_natio' },
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
            Inertia.post(`/app/effective/personnes/edit`, {
                _method: 'post',
                personne: item,
            });
        },
        deleteItem(item){
            console.log(item);
            //this.$inertia.delete(`/app/fede/lig-regio/${item}`);
            Inertia.post(`/app/effective/personnes/${item}`, {
                _method: 'delete'
            });
        }
    },
}
</script>
