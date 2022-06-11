<template >
    <AppLayout>
       <v-main class="ma-4">
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
                    <v-toolbar-title>Liste des pays</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                    ></v-text-field>
                    <v-spacer></v-spacer>
                    <v-dialog
                        v-model="dialog"
                        max-width="600px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
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
                                        <v-col
                                            cols="12"
                                            sm="12"
                                            md="6"
                                        >
                                            <v-text-field
                                                v-model="editedItem.libelle"
                                                label="Nom complet"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="12"
                                            md="6"
                                        >
                                            <v-text-field
                                            v-model="editedItem.sigle"
                                            label="Nom habituel"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                            md="4"
                                        >
                                            <v-text-field
                                            v-model="editedItem.code_alpha2"
                                            label="Code à 2"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                            md="4"
                                        >
                                            <v-text-field
                                            v-model="editedItem.code_alpha3"
                                            label="Code à 3"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                            md="4"
                                        >
                                            <v-text-field
                                            v-model="editedItem.indicatif"
                                            label="Indicatif"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="10"
                                            md="8"
                                        >
                                             <v-file-input
                                                show-size
                                                counter
                                                multiple
                                                v-model="editedItem.flag"
                                                label="Drapeau"
                                            ></v-file-input>

                                        </v-col>

                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="close"
                            >
                                Annuler
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="save"
                            >
                                Ajouter
                            </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                        <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
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
       </v-main>
    </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/App/AppLayout.vue';
export default {
    name: 'Pays',
    components:{
        AppLayout
    },
    props:  ['pays'],
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
        desserts: [],
        editedIndex: -1,
        editedItem: {
            libelle: '',
            sigle: '',
            code_alpha2: '',
            code_alpha3: '',
            indicatif: '',
            flag: '',
        },
        defaultItem: {
            libelle: '',
            sigle: '',
            code_alpha2: '',
            code_alpha3: '',
            indicatif: '',
            flag: '',
        },
        //
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
      this.initialize()
    },

    methods: {
      initialize () {
        this.desserts =pays; /*[
          {
            libelle: 'République du Sénégal',
            sigle: 'Sénégal',
            code_alpha2: 'SN',
            code_alpha3: 'SEN',
            indicatif: '221',
            flag: '',
          },
          {
            libelle: 'République Islamique Mauritanie',
            sigle: 'MAuritanie',
            code_alpha2: 'MR',
            code_alpha3: 'MRT',
            indicatif: '222',
            flag: '',
          },
          {
            libelle: 'République Guinée Conankry',
            sigle: 'Guinné Conakry',
            code_alpha2: 'GC',
            code_alpha3: 'GNY',
            indicatif: '223',
            flag: '',
          },
          {
            libelle: 'République du Mali',
            sigle: 'Mali',
            code_alpha2: 'ML',
            code_alpha3: 'MLI',
            indicatif: '224',
            flag: '',
          },
          {
            libelle: 'République du Mali',
            sigle: 'Mali',
            code_alpha2: 'ML',
            code_alpha3: 'MLI',
            indicatif: '224',
            flag: '',
          },
          {
            libelle: 'République du Mali',
            sigle: 'Mali',
            code_alpha2: 'ML',
            code_alpha3: 'MLI',
            indicatif: '224',
            flag: '',
          },
          {
            libelle: 'République du Mali',
            sigle: 'Mali',
            code_alpha2: 'ML',
            code_alpha3: 'MLI',
            indicatif: '224',
            flag: '',
          },
          {
            libelle: 'République du Mali',
            sigle: 'Mali',
            code_alpha2: 'ML',
            code_alpha3: 'MLI',
            indicatif: '224',
            flag: '',
          },
          {
            libelle: 'République du Mali',
            sigle: 'Mali',
            code_alpha2: 'ML',
            code_alpha3: 'MLI',
            indicatif: '224',
            flag: '',
          },
          {
            libelle: 'République du Mali',
            sigle: 'Mali',
            code_alpha2: 'ML',
            code_alpha3: 'MLI',
            indicatif: '224',
            flag: '',
          },
        ]*/
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
    },
}
</script>
