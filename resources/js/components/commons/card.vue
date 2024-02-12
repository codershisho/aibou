<template>
  <v-card class="pa-4 bg-back-lighten-2">
    <div class="tw-text-base px-2">
      {{ props.title }}
    </div>
    <v-divider class="my-3"></v-divider>
    <div class="px-2">
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
