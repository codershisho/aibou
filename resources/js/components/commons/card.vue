<template>
  <v-card class="pa-4 bg-back-lighten-2">
    <div class="tw-text-base pl-2">
      {{ props.title }}
    </div>
    <v-divider class="my-3"></v-divider>
    <div>
      <slot />
    </div>
  </v-card>
</template>

<script setup lang="ts">
const props = defineProps({
  title: String,
});
</script>

<style scoped></style>
