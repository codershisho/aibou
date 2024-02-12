<template>
  <div class="">
    <v-tabs v-model="tab" color="primary">
      <v-tab value="1">
        <v-icon start> mdi-account-outline </v-icon>
        案件詳細
      </v-tab>
      <v-tab value="2">
        <v-icon start> mdi-file-document-multiple-outline </v-icon>
        工数
      </v-tab>
      <v-tab value="3">
        <v-icon start> mdi-file-document-multiple-outline </v-icon>
        KPT
      </v-tab>
    </v-tabs>
    <v-window class="" v-model="tab">
      <v-window-item value="1">
        <projectDetail :id="props.id"></projectDetail>
      </v-window-item>
      <v-window-item value="2">
        <worktime :id="props.id"></worktime>
      </v-window-item>
      <v-window-item value="3">
        <kpt :id="props.id"></kpt>
      </v-window-item>
    </v-window>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import projectDetail from './details.vue';
import worktime from './worktime.vue';
import kpt from './kpt.vue';

const props = defineProps({
  id: String,
});

const tab = ref(null);
</script>

<style scoped></style>
