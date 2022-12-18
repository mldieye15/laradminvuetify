<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>
        <v-card>
            <v-container>
                <!--<v-row class="mb-0 mx-auto pa-1">
                    <v-text-field class="mb-3 mx-auto" v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details ></v-text-field>
                    <v-spacer></v-spacer>
                        <inertia-link  class="mt-4" :href="route('personne.create')">
                        <v-btn color="primary" dark class="mb-0">Nouveau</v-btn>
                    </inertia-link>
                </v-row>-->
                <v-row class="mb-0 mx-auto pa-1">
                    <v-col cols="12" sm="12" md="3" >
                        <v-select v-model="selectedLigue" :items="ligueRegionales" label="Ligue régionale" item-text="sigle" item-value="id" single-line return-object></v-select>
                        <span v-if="errors.ligue_regional" class="font-weight-light red--text">{{ errors.ligue_regional[0] }}</span>
                    </v-col>
                    <v-col cols="12" sm="12" md="3" >
                        <v-select v-model="selectedType" :menu-props="{ top: true, offsetY: true }" :items="typeStrcuture" label="Type de structure" item-text="sigle" item-value="id" return-object @change="getStructures()"></v-select>
                    </v-col>
                    <v-col cols="12" sm="12" md="3" >
                        <v-select v-model="selectedStructure" :menu-props="{ top: true, offsetY: true }" :items="structures" label="Structure" item-text="sigle" item-value="id" return-object></v-select>
                        <span v-if="errors.structure_pratiq" class="font-weight-light red--text">{{ errors.structure_pratiq[0] }}</span>
                    </v-col>
                </v-row>
                <v-data-table
                    :headers="headers"
                    :items="personnes"
                    :search="search"
                    :items-per-page="5"
                    sort-by="calories"
                    class="elevation-1"
                >

                    <template v-slot:item.personne="{ item }">
                        <div class="m-1">
                            {{JSON.parse(item.personne).nom}} {{JSON.parse(item.personne).prenoms}}
                        </div>
                    </template>
                    <template v-slot:item.fonction_pratiquant="{ item }">
                        <div class="m-1">
                            {{JSON.parse(item.fonction_pratiquant).sigle}}
                        </div>
                    </template>
                    <template v-slot:item.type_demande="{ item }">
                        <div class="m-1">
                            {{JSON.parse(item.type_demande).sigle}}
                        </div>
                    </template>
                    <template v-slot:item.cote_pratiquant="{ item }">
                        <div class="m-1">
                            {{JSON.parse(item.cote_pratiquant).sigle}}
                        </div>
                    </template>
                    <template v-slot:item.traite="{ item }">
                        <div class="m-1">
                            {{ item.traite==0 ? 'Non' : 'Oui' }}
                        </div>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <inertia-link class="mx-auto" :href="`/app/effective/autorisation/${item.id}`" ><v-icon small class="mr-2" >mdi-eye</v-icon></inertia-link>
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
    props:  ['personnes', 'errors', 'ligueRegionales', 'typeStructureListe'],
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
                text: 'Autorisation',
                disabled: true,
                route: 'autorisation.index',
            }
        ],
        //
        headers: [
            /*{ text: 'Photo', value: 'photo' },
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
            { text: 'Piéce', value: 'piece_ident' },*/
            { text: 'Concerné', value: 'personne' },
            { text: 'Photo', value: 'photo' },
            { text: 'Demande', value: 'type_demande' },
            { text: 'Poste', value: 'fonction_pratiquant' },
            { text: 'Côté', value: 'cote_pratiquant' },
            { text: 'Traité', value: 'traite' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        tab: null,
        text: 'Contenu',
        selectedLigue:{
            id: 0,
            sigle: 'Selectionnez un ligue'
        },
        selectedType:{
            id: '',
            sigle: 'Séléctionnez'
        },
        structures: [],
        selectedStructure:{
            id: '',
            sigle: 'Séléctionnez'
        },
      }
    },
    computed: {},
    watch: {},
    created () {
        this.typeStrcuture = this.typeStructureListe;
    },
    methods: {
        editItem(item){
            console.log(item);
            Inertia.post(`/app/effective/autorisation/edit`, {
                _method: 'post',
                personne: item,
            });
        },
        deleteItem(item){
            console.log(item);
            //this.$inertia.delete(`/app/fede/lig-regio/${item}`);
            Inertia.post(`/app/effective/autorisation/${item}`, {
                _method: 'delete'
            });
        },
        getStructures(){
            console.log(this.selectedType.id);
            let choix_struct = this.selectedType.id;
            let ligue = this.selectedLigue.id;
            let route = '';
            // Ces vleurs dépend des ids enregistrés dans la base de données
            switch (choix_struct) {
                case 4:
                    route = '/app/fede/structures/ajax-association';
                    break;

                case 3:
                    route = '/app/fede/structures/ajax-centre-formation';
                    break;

                default:
                    //route = '/app/fede/structures/ajax-club';
                    route = `/app/fede/structures/ajax-club/${ligue}`;
                    break;
            }
            axios.post(`${route}`).then((response)=>{
                console.log(response.data);
                console.log(this.personnes);
                this.structures = response.data//.users
            });
        }
    },
}
</script>
