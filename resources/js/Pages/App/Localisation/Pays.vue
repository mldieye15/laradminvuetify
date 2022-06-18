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
            :items="pays"
            :search="search"
            :items-per-page="5"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title></v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
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
                                    <v-alert v-if="$page.props.errors.libelle" v-model="alert" dismissible color="red" border="left" elevation="2" colored-border>
                                        {{ $page.props.errors.libelle }}
                                    </v-alert>
                                    <!-- <v-from> -->
                                    <v-row>
                                        <v-col cols="12" sm="12" md="6" >
                                            <v-select  v-model="form.continent" :items="continents" label="Cotinents" item-text="libelle" item-value="id" single-line return-object></v-select>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" >
                                            <v-text-field v-model="form.libelle" label="Nom complet" ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" >
                                            <v-text-field v-model="form.sigle" label="Nom habituel"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.code_alpha2" label="Code à 2"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4" >
                                            <v-text-field v-model="form.code_alpha3" label="Code à 3" ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4" >
                                            <v-text-field  v-model="form.indicatif" label="Indicatif"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" >
                                            <v-file-input v-model="form.flag" label="Drapeau" v-if="editedIndex > -1 && form.flag!= null" @input="form.flag"></v-file-input>
                                            <v-file-input v-model="form.flag" label="Drapeau" v-else @input="form.flag = $event.target.files[0]"></v-file-input>
                                            <v-img :v-show="editedIndex >-1" :src="form.flag" :alt="form.flag" aspect-ratio="1" max-width="90" max-height="90" class="ma-1"></v-img>
                                        </v-col>
                                    </v-row>
                                    <!-- </v-from> -->
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
                            <v-card-title class="text-h5">Êtes-vous certains de supprimer le pays?</v-card-title>
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
            <template v-slot:item.flag="{ item }">
                <div class="m-1">
                    <v-img :src="item.flag" :alt="item.flag" aspect-ratio="1" max-width="110" max-height="110" class="mx-auto"></v-img>
                </div>
          </template>
            <template v-slot:item.actions="{ item }">
                <!--<v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-eye
                </v-icon>-->
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
    name: 'Pays',
    components:{
        AppLayout
    },
    props:  ['pays', 'data', 'continents'],
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
                text: 'Pays',
                disabled: true,
                href: 'pays',
            },
        ],
        //
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
            { text: 'Nom courante', value: 'sigle' },
            { text: 'Code à 2', value: 'code_alpha2' },
            { text: 'Code à 3', value: 'code_alpha3' },
            { text: 'Indicatif', value: 'indicatif' },
            { text: 'Drapeau', value: 'flag' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        listePays: [],
        editedIndex: -1,
        form: this.$inertia.form({
            libelle: null,
            sigle: null,
            code_alpha2: null,
            code_alpha3: '',
            indicatif: '',
            flag: null,
            continent: this.selectedContinent
        }),
        selectedContinent:{
            id: 1,
            libelle: 'Afrique'
        },
        defaultItem: {
            libelle: null,
            sigle: null,
            code_alpha2: null,
            code_alpha3: '',
            indicatif: '',
            flag: null,
            continent: null
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
                //this.form._method = 'PUT';
                //this.$inertia.post('/app/intial-data/pays/' + this.form.id, this.form)
                //Object.assign(this.pays[this.editedIndex], this.form);
                Object.assign(this.pays[this.editedIndex], this.form);
                Inertia.post(`/app/intial-data/pays/${this.form.id}`, {
                    _method: 'put',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    code_alpha2: this.form.code_alpha2,
                    code_alpha3: this.form.code_alpha3,
                    indicatif: this.form.indicatif,
                    flag: this.form.flag,
                    continent: this.form.continent //this.selectedContinent
                })
            } else {
                //this.form.post('/app/intial-data/pays'); // this.route('login')
                this.form.continent = this.selectedContinent
                this.form.post(this.route('pays.store') );
                this.pays.push(this.form)
            }
            this.close()
        },

        editItem (item) {
            this.editedIndex = this.pays.indexOf(item)
            this.selectedContinent = this.pays[this.editedIndex].continent;
            console.log(this.selectedContinent);
            this.form = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
            this.editedIndex = this.pays.indexOf(item)
            this.form = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            //this.$inertia.delete(this.route('users.destroy'), user))
            this.$inertia.delete(`/app/intial-data/pays/${this.pays[this.editedIndex].id}`);
            this.listePays.splice(this.editedIndex, 1)
            this.closeDelete()
        },

        close () {
            this.dialog = false
            this.$nextTick(() => {
                this.form = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.form = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },
    },
}
</script>
