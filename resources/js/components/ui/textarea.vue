<template>
  <v-textarea
    v-bind="$attrs"
    v-model="value"
    density="compact"
    hide-details="auto"
    variant="outlined"
    rows="5"
    bg-color="back-lighten-3"
  >
  </v-textarea>
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
