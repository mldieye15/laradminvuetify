<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
        app
    >

        <template v-slot:prepend>
            <v-list-item two-line>
            <v-list-item-avatar>
                <img src="https://randomuser.me/api/portraits/women/85.jpg">
            </v-list-item-avatar>

            <v-list-item-content>
                <v-list-item-title>Lamine DIEYE</v-list-item-title>
                <v-list-item-subtitle>Logged In</v-list-item-subtitle>
                <br/>
                <v-btn color="default">
                    Se déconnecter
                </v-btn>
            </v-list-item-content>
            </v-list-item>

      </template>


      <v-list>
            <v-list-group
                v-for="item in items"
                :key="item.title"
                v-model="item.active"
                :prepend-icon="item.action"
                no-action
            >
                <template v-slot:activator>
                <v-list-item-content>
                    <v-list-item-title v-text="item.title"></v-list-item-title>
                </v-list-item-content>
                </template>

                <v-list-item
                v-for="child in item.items"
                :key="child.title"
                >
                <v-list-item-content>
                    <v-list-item-title v-text="child.title"></v-list-item-title>
                </v-list-item-content>
                </v-list-item>
            </v-list-group>
        </v-list>
      <!--  -->
      <v-card
        class="mx-auto"
        max-width="500"
      >

        </v-card>
      <!-- -->
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <!--  -->
    </v-main>

    <v-footer padless>
        <v-col
        class="text-center"
        cols="12"
        >
        {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
        </v-col>
   </v-footer>
  </v-app>
</template>

<script>
  export default {
    //data: () => ({ drawer: null }),
    data: () => ({
        drawer: null,
        items: [
            {
                action: 'mdi-view-dashboard-outline ',
                //items: [{ title: 'List Item' }],
                title: 'Tableau de bord',
            },
            {
                action: 'mdi-ticket',
                items: [{ title: 'List Item' }],
                title: 'Attractions',
            },
            {
                action: 'mdi-silverware-fork-knife',
                active: true,
                items: [
                    { title: 'Breakfast & brunch' },
                    { title: 'New American' },
                    { title: 'Sushi' },
                ],
                title: 'Dining',
            },
            {
                action: 'mdi-school',
                items: [{ title: 'List Item' }],
                title: 'Education',
            },
            {
                action: 'mdi-human-male-female-child',
                items: [{ title: 'List Item' }],
                title: 'Family',
            },
            {
                action: 'mdi-bottle-tonic-plus',
                items: [{ title: 'List Item' }],
                title: 'Health',
            },
            {
                action: 'mdi-briefcase',
                items: [{ title: 'List Item' }],
                title: 'Office',
            },
            {
                action: 'mdi-tag',
                items: [{ title: 'List Item' }],
                title: 'Promotions',
            },
        ],
    }),
  }
</script>
