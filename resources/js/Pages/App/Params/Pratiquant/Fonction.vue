<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>

        <v-data-table
            :headers="headers"
            :items="fonctions"
            :search="search"
            :items-per-page="5"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <!--<v-toolbar-title></v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>-->
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details ></v-text-field>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="600px" >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                            >
                            Nouveau
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h5">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="6" >
                                            <v-text-field v-model="form.libelle" label="Nom complet" ></v-text-field>
                                            <span v-if="errors.libelle" class="font-weight-light red--text">{{ errors.libelle[0] }}</span>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6" >
                                            <v-text-field v-model="form.sigle" label="Sigle" ></v-text-field>
                                            <span v-if="errors.sigle" class="font-weight-light red--text">{{ errors.sigle[0] }}</span>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close" >
                                    Annuler
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="save" >
                                    Enregistrer
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="text-h6">Action trés dangereuse.<br>Êtes-vous certains de supprimer le pays?</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeDelete">Annuler</v-btn>
                                <!--<v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>-->
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn
                    color="primary"
                    @click="initialize"
                >
                    Reset
                </v-btn>
            </template>
        </v-data-table>
    </AppLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '../../../Layouts/App/AppLayout.vue';
import Breadcrumbs from '../../../../components/Breadcrumbs.vue';

export default {
    name: 'Fonction',
    components:{
        AppLayout,
        Breadcrumbs  
    },
    props:  ['fonctions', 'errors', 'continents'],
    data () {
      return {
        items: [
            {
                text: 'Tableau de bord',
                disabled: false,
                route: 'dashboard.index',
            },
            {
                text: 'Pratiquants',
                disabled: true,
                route: 'dashboard.index',
            },
            {
                text: 'Fonction',
                disabled: true,
                route: 'dashboard.index',
            },
        ],
        alert: true,
        search: '',
        dialog: false,
        dialogDelete: false,
        headers: [
            {
            text: 'Nom complet',
            align: 'start',
            sortable: false,
            value: 'libelle',
            },
            { text: 'Abréviation', value: 'sigle' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        listeItem: [],
        editedIndex: -1,
        form: this.$inertia.form({
            libelle: null,
            sigle: null,
            active: true,
        }),
        defaultItem: {
            libelle: null,
            sigle: null,
            active: true,
        },
      }
    },

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nouveau' : 'Modification'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      //this.initialize()
    },

    methods: {
        save () {
            if (this.editedIndex > -1) {
                Object.assign(this.fonctions[this.editedIndex], this.form);
                Inertia.post(`/app/intial-data/pratiquants/fonctions/${this.form.id}`, {
                    _method: 'put',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    active: this.form.active,
                })
            } else {
                Inertia.post(`/app/intial-data/pratiquants/fonctions`, {
                    _method: 'post',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    active: this.form.active,
                })
                this.fonctions.push(this.form)
            }
            if(this.isErrorEmpty(this.errors)){
                this.close()
            }
        },

        editItem (item) {
            this.editedIndex = this.fonctions.indexOf(item)
            //this.selectedContinent = JSON.parse(this.grades[this.editedIndex].continent);
            this.form = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
            this.editedIndex = this.fonctions.indexOf(item)
            this.form = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            this.$inertia.delete(`/app/intial-data/pratiquants/fonctions/${this.fonctions[this.editedIndex].id}`);
            this.listeItem.splice(this.editedIndex, 1)
            this.closeDelete()
        },

        close () {
            this.dialog = false
            this.form = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
        },

        closeDelete () {
            this.dialogDelete = false
            this.form = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
        },

        isErrorEmpty(object) {
            var isEmpty = true;
            for (keys in object) {
                isEmpty = false;
                break; // exiting since we found that the object is not empty
            }
            return isEmpty;
        }
    },
}
</script>
