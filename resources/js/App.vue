<template>
  <v-app id="inspire">
    <v-app-bar color="back-lighten-3">
      <v-app-bar-title>Aibou</v-app-bar-title>
      <div class="d-flex align-center">
        <div v-for="[icon, text, url] in menus" :key="text">
          <v-btn variants="text" :to="url" :prepend-icon="icon">
            {{ text }}
          </v-btn>
        </div>
      </div>
    </v-app-bar>

    <v-main class="bg-back">
      <v-container class="px-6 pt-5">
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const menus = [
  ['mdi-home', 'Dashboard', '/'],
  ['mdi-account-circle-outline', 'partners', '/partners'],
];
</script>
