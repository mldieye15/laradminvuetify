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

        <v-data-table
            :headers="headers"
            :items="communes"
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
                                    <!--<v-alert v-if="$page.props.errors.libelle " v-model="alert" dismissible color="red" border="left" elevation="2" colored-border>
                                        {{ $page.props.errors.libelle }}
                                    </v-alert>-->
                                    <v-row>
                                        <v-col cols="12" sm="12" md="6" >
                                            <v-select v-model="selectedDepartement" :items="departements" label="Département" item-text="sigle" item-value="id" single-line return-object></v-select>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" >
                                            <v-text-field v-model="form.libelle" label="Nom complet" ></v-text-field>
                                            <span v-if="errors.libelle" class="font-weight-light red--text">{{ errors.libelle[0] }}</span>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" >
                                            <v-text-field v-model="form.sigle" label="Nom habituel"></v-text-field>
                                            <span v-if="errors.sigle" class="font-weight-light red--text">{{ errors.sigle[0] }}</span>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.codification" label="Codification"></v-text-field>
                                            <span v-if="errors.codification" class="font-weight-light red--text">{{ errors.codification[0] }}</span>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4" >
                                            <v-text-field  v-model="form.indicatif" label="Indicatif"></v-text-field>
                                            <span v-if="errors.indicatif" class="font-weight-light red--text">{{ errors.indicatif[0] }}</span>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" >
                                            <v-file-input v-model="form.map" label="Carte" v-if="editedIndex > -1 && form.map!= null" @input="form.map"></v-file-input>
                                            <v-file-input v-model="form.map" label="Carte" v-else @input="form.map = $event.target.files[0]"></v-file-input>
                                            <v-img :v-show="editedIndex >-1" :src="form.map" :alt="form.map" aspect-ratio="1" max-width="90" max-height="90" class="ma-1"></v-img>
                                            <span v-if="errors.map" class="font-weight-light red--text">{{ errors.map[0] }}</span>
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
                            <v-card-title class="text-h6">Cette action va supprimer les communes rattachées à ce département.<br>Êtes-vous certains de supprimer le département?</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeDelete">Annuler</v-btn>
                                <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.departement="{ item }">
                <div class="m-1">
                    {{JSON.parse(item.departement).sigle}}
                </div>
            </template>
            <template v-slot:item.map="{ item }">
                <div class="m-1">
                    <v-img :src="item.map" :alt="item.map" aspect-ratio="1" max-width="110" max-height="110" class="mx-auto"></v-img>
                </div>
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
import AppLayout from '../../Layouts/App/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'Commune',
    components:{
        AppLayout
    },
    props:  ['communes', 'errors', 'departements'],
    data () {
      return {
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
            {
                text: 'Communes',
                disabled: true,
                href: 'communes',
            },
        ],
        alert: true,
        search: '',
        dialog: false,
        dialogDelete: false,
        headers: [
            {
            text: 'Nom',
            align: 'start',
            sortable: false,
            value: 'libelle',
            },
            { text: 'Sigle', value: 'sigle' },
            { text: 'Codification', value: 'codification' },
            { text: 'Indicatif', value: 'indicatif' },
            { text: 'Département', value: 'departement' },
            { text: 'Carte', value: 'map' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        listeCommune: [],
        editedIndex: -1,
        form: this.$inertia.form({
            libelle: null,
            sigle: null,
            codification: null,
            indicatif: '',
            map: null,
            departement: this.selectedDepartement
        }),
        selectedDepartement:{
            id: 1,
            sigle: 'Dakar'
        },
        defaultItem: {
            libelle: null,
            sigle: null,
            codification: null,
            indicatif: '',
            indicatif: '',
            map: null,
            departement: null
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
                Object.assign(this.communes[this.editedIndex], this.form);
                Inertia.post(`/app/intial-data/communes/${this.form.id}`, {
                    _method: 'put',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    codification: this.form.codification,
                    indicatif: this.form.indicatif,
                    map: this.form.map,
                    departement: this.selectedDepartement
                })
            } else {
                this.form.departement = this.selectedDepartement
                Inertia.post(`/app/intial-data/communes`, {
                    _method: 'post',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    codification: this.form.codification,
                    indicatif: this.form.indicatif,
                    map: this.form.map,
                    departement: this.selectedDepartement
                })
                this.communes.push(this.form)
            }

            if(this.isErrorEmpty(this.errors)){
                this.close()
            }

        },

        editItem (item) {
            this.editedIndex = this.communes.indexOf(item)
            this.selectedDepartement = JSON.parse(this.communes[this.editedIndex].departement);
            this.form = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
            this.editedIndex = this.communes.indexOf(item)
            this.form = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            this.$inertia.delete(`/app/intial-data/communes/${this.communes[this.editedIndex].id}`);
            this.listeCommune.splice(this.editedIndex, 1)
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
                break;
            }
            return isEmpty;
        }
    },
}
</script>
