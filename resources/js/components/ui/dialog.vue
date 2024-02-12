<template>
  <v-dialog v-model="value" width="1000">
    <v-card class="py-4 px-8 bg-back-lighten-2">
      <div>
        <div class="d-flex align-center">
          <div class="tw-text-xl mr-auto">{{ props.title }}</div>
          <v-icon icon="mdi:mdi-close" @click="value = false" />
        </div>
        <v-divider class="my-2"></v-divider>
        <component :is="props.form" @close="value = false" />
      </div>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';

const props = defineProps(['modelValue', 'title', 'form']);
const emit = defineEmits(['update:modelValue', 'close']);

const value = computed({
  get: () => props.modelValue,
  set: (v) => {
    emit('update:modelValue');
    emit('close');
  },
});
</script>
