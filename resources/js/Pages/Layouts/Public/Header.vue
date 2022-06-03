<template >
    <v-container>
        <v-toolbar flat>
            <!--<v-app-bar-nav-icon></v-app-bar-nav-icon>-->

            <v-toolbar-title>FB RIM</v-toolbar-title>

            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn text>
                    Accueil
                </v-btn>

                <v-btn text>
                    A propos
                </v-btn>

                <v-btn text>
                    Contact
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>
    </v-container>
</template>

<script>

export default {
    name: 'Header',
    components:{},
    data: () => ({

    }),
}
</script>
