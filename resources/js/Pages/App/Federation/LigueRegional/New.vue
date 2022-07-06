<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>
        <v-card>
ggg
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
            }
            ,
            {
                text: 'Nouveau',
                disabled: true,
                route: 'ligregio.create',
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
        }),
      }
    },

    computed: {},

    watch: {},

    created () {},

    methods: {
        save () {
            if (this.editedIndex > -1) {
                Object.assign(this.quartiers[this.editedIndex], this.form);
                Inertia.post(`/app/intial-data/quartiers/${this.form.id}`, {
                    _method: 'put',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    codification: this.form.codification,
                    indicatif: this.form.indicatif,
                    map: this.form.map,
                    commune: this.selectedCommune
                })
            } else {
                this.form.commune = this.selectedCommune
                Inertia.post(`/app/intial-data/quartiers`, {
                    _method: 'post',
                    libelle: this.form.libelle,
                    sigle: this.form.sigle,
                    codification: this.form.codification,
                    indicatif: this.form.indicatif,
                    map: this.form.map,
                    commune: this.selectedCommune
                })
                this.quartiers.push(this.form)
            }

            if(this.isErrorEmpty(this.errors)){
                this.close()
            }

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
