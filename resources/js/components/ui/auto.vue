<template>
  <v-autocomplete
    v-bind="$attrs"
    density="compact"
    hide-details="auto"
    variant="outlined"
    v-model="value"
    bg-color="back-lighten-3"
  ></v-autocomplete>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const value = computed({
  get: () => props.modelValue,
  set: (v) => {
    emit('update:modelValue', v);
  },
});
</script>
