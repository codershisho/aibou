<template>
  <v-text-field
    v-bind="$attrs"
    v-model="value"
    variant="outlined"
    density="compact"
    hide-details="auto"
    bg-color="back-lighten-3"
  >
  </v-text-field>
</template>

<script setup lang="ts">
import { computed } from 'vue';

// defineOptions({
//   inheritAttrs: false,
// });

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const value = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit('update:modelValue', value);
  },
});
</script>

<style scoped></style>
