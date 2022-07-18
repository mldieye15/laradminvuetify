<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>
        <v-card>
            <v-card-title>
                <span class="text-h5">Ajout d'une personne</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <div class="overline mb-4">Information personnelle</div>
                    <v-row>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field v-model="form.prenoms" label="Prénoms"></v-text-field>
                            <span v-if="errors.prenoms" class="font-weight-light red--text">{{ errors.prenoms[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field v-model="form.nom" label="Nom" ></v-text-field>
                            <span v-if="errors.nom" class="font-weight-light red--text">{{ errors.nom[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-menu
                                ref="menu"
                                v-model="menu"
                                :close-on-content-click="false"
                                transition="scale-transition"
                                offset-y
                                min-width="auto"
                            >
                                 <template v-slot:activator="{ on, attrs }">
                                    <v-text-field v-model="form.date_naiss" label="Date de naissance" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                                 </template>
                                 <v-date-picker
                                    v-model="form.date_naiss"
                                    :active-picker.sync="activePicker"
                                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                    min="1950-01-01"
                                    @change="dateNaiss"
                                 ></v-date-picker>
                            </v-menu>
                            <span v-if="errors.date_naiss" class="font-weight-light red--text">{{ errors.date_naiss[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.lieu_naiss" label="Lieu de naissance"></v-text-field>
                            <span v-if="errors.lieu_naiss" class="font-weight-light red--text">{{ errors.lieu_naiss[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >

                            <v-radio-group v-model="form.sexe" row >
                                Sexe&nbsp;&nbsp;&nbsp;<v-radio label="Homme" value="HOMME"></v-radio>
                                <v-radio label="Femme" value="FEMME" class="ml-12"></v-radio>
                                <span v-if="errors.sexe" class="font-weight-light red--text">{{ errors.sexe[0] }}</span>
                            </v-radio-group>
                        </v-col>
                        <v-col cols="12" sm="12" md="3" >
                            <v-select v-model="selectedCivilite" :items="civilites" :menu-props="{ top: true, offsetY: true }" label="Situation matrimoniale" item-text="sigle" item-value="id" return-object></v-select><!-- single-line: enlevé pour avoir le nom du label en haut -->
                             <span v-if="errors.civilite" class="font-weight-light red--text">{{ errors.civilite[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="12" md="3" >
                            <v-select v-model="selectedPaysNaiss" :items="pays" :menu-props="{ top: true, offsetY: true }" label="Pays de naissance" item-text="sigle" item-value="id" return-object></v-select>
                             <span v-if="errors.pays_naiss" class="font-weight-light red--text">{{ errors.pays_naiss[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="12" md="3" >
                            <v-select v-model="selectedPaysNatio" :items="pays" :menu-props="{ top: true, offsetY: true }" label="Pays de nationalité" item-text="sigle" item-value="id" return-object></v-select>
                             <span v-if="errors.pays_natio" class="font-weight-light red--text">{{ errors.pays_natio[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.surnom" label="Surnom"></v-text-field>
                            <span v-if="errors.surnom" class="font-weight-light red--text">{{ errors.surnom[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.fonction" label="Fonction"></v-text-field>
                            <span v-if="errors.fonction" class="font-weight-light red--text">{{ errors.fonction[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.adresse" label="Adresse"></v-text-field>
                            <span v-if="errors.adresse" class="font-weight-light red--text">{{ errors.adresse[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.telephone" label="Téléphone"></v-text-field>
                            <span v-if="errors.telephone" class="font-weight-light red--text">{{ errors.telephone[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="12" md="3" >
                            <v-select v-model="selectedPiece" :menu-props="{ top: true, offsetY: true }" :items="type_piece_ident" label="Type de piéce d'identité" item-text="sigle" item-value="id" return-object></v-select>
                             <span v-if="errors.type_piece_ident" class="font-weight-light red--text">{{ errors.type_piece_ident[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.piece_ident" label="Piéce d'indentification"></v-text-field>
                            <span v-if="errors.piece_ident" class="font-weight-light red--text">{{ errors.piece_ident[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-text-field  v-model="form.email" label="Adress email"></v-text-field>
                            <span v-if="errors.email" class="font-weight-light red--text">{{ errors.email[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="4" md="1" >
                            <v-text-field  v-model="form.taille" label="Taille"></v-text-field>
                            <span v-if="errors.taille" class="font-weight-light red--text">{{ errors.taille[0] }}</span>
                        </v-col>
                         <v-col cols="12" sm="4" md="2" >
                            <v-text-field  v-model="form.poids" label="Poids"></v-text-field>
                            <span v-if="errors.poids" class="font-weight-light red--text">{{ errors.poids[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-file-input v-model="form.photo" label="photo" v-if="editedIndex > -1 && form.photo!= null" @input="form.logo"></v-file-input>
                            <v-file-input v-model="form.photo" label="Photo" v-else @input="form.photo = $event.target.photo[0]"></v-file-input>
                            <!--<v-img :v-show="editedIndex >-1" :src="form.photo" :alt="form.photo" aspect-ratio="1" max-width="90" max-height="90" class="ma-1"></v-img>-->
                            <span v-if="errors.photo" class="font-weight-light red--text">{{ errors.photo[0] }}</span>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" >
                            <v-img :v-show="editedIndex >-1" :src="form.photo" :alt="form.photo" aspect-ratio="1" max-width="90" max-height="90" class="ma-1"></v-img>
                        </v-col>
                    </v-row>
                    <div class="overline ">Information professionnelle</div><br/>
                    <v-row>
                        <v-tabs
                            v-model="tab"
                            background-color="black ligthen-4"
                            centered
                            dark
                            icons-and-text
                        >
                            <v-tabs-slider></v-tabs-slider>
                            <v-tab href="#pratiquant">
                                Pratiquants
                            </v-tab>
                            <v-tab href="#technicien">
                                Techniciens
                            </v-tab>
                            <v-tab href="#medecin">
                                Médecins
                            </v-tab>

                            <v-tabs-items v-model="tab">
                                <v-tab-item value="pratiquant" key="pratiquant">
                                    <v-container>
                                        <v-card flat>
                                            <v-card-text>pratiquant</v-card-text>
                                        </v-card>
                                    </v-container>
                                </v-tab-item>

                                <v-tab-item value="technicien" key="technicien">
                                    <v-container>
                                        <v-card flat>
                                            <v-card-text>Technicien</v-card-text>
                                        </v-card>
                                    </v-container>
                                </v-tab-item>

                                <v-tab-item value="medecin" key="medecin">
                                    <v-container>
                                        <v-card flat>
                                            <v-card-text>Médecin</v-card-text>
                                        </v-card>
                                    </v-container>
                                </v-tab-item>
                            </v-tabs-items>
                        </v-tabs>
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
    props:  ['pays', 'currentPays', 'errors'],
    data () {
      return {
        tab: null,
        searchLigue: '',
        activePicker: null,
        date: null,
        menu: false,
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
                disabled: false,
                route: 'personne.index',
            },
            {
                text: 'Nouveau',
                disabled: true,
                route: 'personne.create',
            }
        ],
        //
        form: this.$inertia.form({
            prenoms: null,
            nom: null,
            sexe: 'HOMME',
            surnom: null,
            taille: null,
            poids: null,
            fonction: null,
            ne_vers: 0,
            date_naiss: null,
            lieu_naiss: null,
            adresse: null,
            photo: null,
            email: null,
            piece_ident: null,
            annee_naiss: null,
            ne_vers_naiss: null,
            cin: null,
            passport:null,
            telephone: null,
            page_web: null,
            facebook: null,
            whatsapp: null,
            telegram: null,
            instagram: null,
            tiktok: null,
            active: true,
            pays_naiss: this.selectedPaysNaiss,
            pays_natio: this.selectedPaysNatio,
            civilite: this.selectedCivilite,
            type_piece_ident: this.selectedPiece
        }),
        selectedPaysNaiss:{
            id: null,
            sigle: null
        },
        selectedPaysNatio:{
            id: null,
            sigle: null
        },
        type_piece_ident: [
            {
                id: 'CIN',
                sigle: 'Carte nationale d\'identité'
            },
            {
                id: 'PASSPORT',
                sigle: 'Passport'
            },
            {
                id: 'APPRENANT',
                sigle: 'Apprenant'
            },
            {
                id: 'PROFESSIONNEL',
                sigle: 'Professionnel'
            },
        ],
        selectedPiece:{
            id: 'CIN',
            sigle: 'Carte nationale d\'identité'
        },
        civilites: [
            {
                id: 'CELIBATAIRE',
                sigle: 'Célibataire'
            },
            {
                id: 'MARIE(E)',
                sigle: 'Marié(e)'
            },
            {
                id: 'DIVORCE(E)',
                sigle: 'Divorcé(e)'
            },
            {
                id: 'VEUF(VE)',
                sigle: 'Veuf(ve)'
            },
        ],
        selectedCivilite:{
            id: 'CELIBATAIRE',
            sigle: 'Célibataire'
        },
        editedIndex: -1,
        //
        testStore: {
            prenoms: 'Lamine',
            nom: 'DIEYE',
            sexe: 'HOMME',
            surnom: 'mldieye',
            taille: '1m 97',
            poids: '82,5 kg',
            fonction: 'Analyste',
            date_naiss: '1992-05-08',
            lieu_naiss: 'Guédiawaye',
            adresse: '246, Parc Guédiawaye',
            ne_vers: 0,
            photo: null,
            email: 'laminedev@gmail.com',
            piece_ident: '1065EOJ',
            annee_naiss: null,
            ne_vers_naiss: null,
            cin: null,
            passport: null,
            telephone: '7797833',
            page_web: null,
            facebook: null,
            whatsapp: null,
            telegram: null,
            instagram: null,
            tiktok: null,
            active: true,
            //
            pays: {
                id: 1,
                sigle: 'Mauritanie'
            },
            nationalite: {
                id: 1,
                sigle: 'Mauritanie'
            },
            type_piece_ident:  {
                id: 'CIN',
                sigle: 'Carte nationale '
            },
            civilite:  {
                id: 'CELIBATAIRE',
                sigle: 'Célibataire'
            },

            pays_naiss: 1,
            pays_natio: 1,
        }
        //
      }
    },
    computed: {},
    watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },
    created () {
        this.selectedPaysNaiss = Object.assign({}, this.currentPays[0]);
        this.selectedPaysNatio = Object.assign({}, this.currentPays[0]);
        //this.form = this.testStore;
    },
    methods: {
        save () {
            console.log(this.form);
            Inertia.post(`/app/effective/personnes`, {
                _method: 'post',
                prenoms: this.form.prenoms,
                nom: this.form.nom,
                sexe: this.form.sexe,
                surnom: this.form.surnom,
                taille: this.form.taille,
                poids: this.form.poids,
                fonction: this.form.fonction,
                ne_vers: this.form.ne_vers,
                date_naiss: this.form.date_naiss,
                lieu_naiss: this.form.lieu_naiss,
                adresse: this.form.adresse,
                photo: this.form.photo,
                email: this.form.email,
                piece_ident: this.form.piece_ident,
                annee_naiss: this.form.annee_naiss,
                ne_vers_naiss: this.form.ne_vers_naiss,
                cin: this.form.cin,
                passport:this.form.passport,
                telephone: this.form.telephone,
                page_web: this.form.page_web,
                facebook: this.form.facebook,
                whatsapp: this.form.whatsapp,
                telegram: this.form.telegram,
                instagram: this.form.instagram,
                tiktok: this.form.tiktok,
                active: this.form.active,
                //
                pays: this.selectedPaysNaiss,
                nationalite: this.selectedPaysNatio,
                type_piece_ident: this.selectedPiece.id,
                civilite: this.selectedCivilite.id,

                pays_naiss: this.selectedPaysNaiss.id,
                pays_natio: this.selectedPaysNatio.id,
            });
        },
        dateNaiss (date) {
            this.$refs.menu.save(this.form.date_naiss)
        },
    },
}
</script>
