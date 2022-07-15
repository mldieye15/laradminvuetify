<template>
  <v-footer
    padless
    app
    inset
  >
    <v-card
      class="flex"
      flat
      color="grey lighten-3"
      :elevation="1"
    >

      <v-card-text class="py-2  text-center">
        {{ new Date().getFullYear() }} — <strong>FB RIM</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>
