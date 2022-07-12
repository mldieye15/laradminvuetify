<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>
        <v-card>
            <v-card-title>
                <span class="text-h5">Ajout centre de formation</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="4" >
                            <v-select v-model="selectedLigue" :items="ligueRegionales" label="Ligue régionale" item-text="sigle" item-value="id" single-line return-object></v-select>
                             <span v-if="errors.ligue_regional" class="font-weight-light red--text">{{ errors.ligue_regional[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="12" md="8" >
                            <v-text-field v-model="form.adresse" label="Adresse"></v-text-field>
                            <span v-if="errors.adresse" class="font-weight-light red--text">{{ errors.adresse[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="12" md="4">
                            <v-text-field v-model="form.sigle" label="Sigle"></v-text-field>
                            <span v-if="errors.sigle" class="font-weight-light red--text">{{ errors.sigle[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="12" md="8" >
                            <v-text-field v-model="form.libelle" label="Nom complet" ></v-text-field>
                            <span v-if="errors.libelle" class="font-weight-light red--text">{{ errors.libelle[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field v-model="form.telephone" label="Téléphone"></v-text-field>
                            <span v-if="errors.telephone" class="font-weight-light red--text">{{ errors.telephone[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field v-model="form.email" label="E-mail" ></v-text-field>
                            <span v-if="errors.email" class="font-weight-light red--text">{{ errors.email[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.date_creation" label="Date création"></v-text-field>
                            <span v-if="errors.date_creation" class="font-weight-light red--text">{{ errors.date_creation[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.page_web" label="Page web"></v-text-field>
                            <span v-if="errors.page_web" class="font-weight-light red--text">{{ errors.page_web[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.instagram" label="Instagram"></v-text-field>
                            <span v-if="errors.instagram" class="font-weight-light red--text">{{ errors.instagram[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-file-input v-model="form.logo" label="Logo" v-if="editedIndex > -1 && form.logo!= null" @input="form.logo"></v-file-input>
                            <v-file-input v-model="form.logo" label="Logo" v-else @input="form.logo = $event.target.logo[0]"></v-file-input>
                            <v-img :v-show="editedIndex >-1" :src="form.logo" :alt="form.logo" aspect-ratio="1" max-width="90" max-height="90" class="ma-1"></v-img>
                            <span v-if="errors.logo" class="font-weight-light red--text">{{ errors.logo[0] }}</span>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions class="btn-to-top">
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="save" submit >
                    Enregistrer
                </v-btn>
                <!-- <v-btn color="blue darken-1" text @click="close" >
                    Annuler
                </v-btn> -->
            </v-card-actions>
        </v-card>
    </AppLayout>
</template>

<script>
import AppLayout from '../../../Layouts/App/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import Breadcrumbs from '../../../../components/Breadcrumbs.vue';

export default {
    name: 'New',
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
                disabled: false,
                route: 'ligregio.index',
            },
            {
                text: 'Centre de formation',
                disabled: false,
                route: 'centreform.index',
            },
            {
                text: 'Nouveau',
                disabled: true,
                route: 'ligregio.create',
            }
        ],
        //
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
            ligue: this.selectedLigue
        }),
        selectedLigue:{
            id: 0,
            sigle: 'Selectionnez un ligue'
        },
        editedIndex: -1,
      }
    },
    computed: {},
    watch: {},
    created () {},
    methods: {
        save () {
            Inertia.post(`/app/fede/structures/centre-formation`, {
                _method: 'post',
                libelle: this.form.libelle,
                sigle: this.form.sigle,
                adresse: this.form.adresse,
                telephone: this.form.telephone,
                email: this.form.email,
                date_creation: this.form.date_creation,
                page_web: this.form.page_web,
                instagram: this.form.instagram,
                logo: this.form.logo,
                ligue: this.selectedLigue,
                ligue_regional: this.selectedLigue.id // utilise pour la validation
            });
        },
    },
}
</script>
