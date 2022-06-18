<template>
    <app-layout :public-site="true">
        <div v-if="status === 404">
            <div class="container">
                <div>
                    <div>
                        <h1>404</h1>
                        <h2>Vous êtes perdu... ?</h2><br>
                        <p>Ne vous inquiétez pas...<br/>
                            <b>Nous pouvons tout de même vous aider à trouver une maison !</b></p>
                        <a :href="route('find-a-home')" class="mt-4">Trouver une maison maintenant !</a>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h1>{{ title }}</h1>
            <div>{{ description }}</div>
        </div>
    </app-layout>
</template>

<script>
//import AppLayout from "@/Layouts/AppLayout";
export default {
    //components: {AppLayout},
    props: {
        status: Number,
    },
    computed: {
        title() {
            return {
                503: '503: Service Indisponible',
                500: '500: Erreur',
                403: '403: Accès refusé',
            }[this.status]
        },
        description() {
            return {
                503: "Désolé, nous sommes en train d'effectuer une maintenance. Revenez plus tard.",
                500: 'Oups, une erreur est survenue.',
                403: "Désolé, vous n'avez pas accès à cette page.",
            }[this.status]
        },
    },
}
</script>
