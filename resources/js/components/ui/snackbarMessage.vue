<template>
  <v-card style="display: flex; padding: 8px 12px" :color="message.state.color">
    <div style="display: flex; align-items: center">{{ message.text }}</div>
    <v-spacer></v-spacer>
    <!-- <v-btn class="pa-0" icon="mdi-close" size="x-small" @click="remove()" /> -->
    <v-btn icon variants="flat" size="x-small" @click="remove()">
      <v-icon color="grey">mdi-close</v-icon>
    </v-btn>
    <!-- <v-btn density="compact" icon="mdi-plus" @click="remove()"></v-btn> -->
  </v-card>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useAppStore } from '@/stores/app';
import { IMessage } from '@/types/app';

const props = defineProps({
  message: Object,
});
const emit = defineEmits(['remove']);
const store = useAppStore();
const activeTimeout = ref(-1);

onMounted(() => {
  setTimeout();
});

const setTimeout = () => {
  window.clearTimeout(activeTimeout.value);
  const { timeout } = props.message.state;
  // タイムアウト時間が設定されている場合は
  if (timeout) {
    // 指定時間後にremoveを呼び出す
    activeTimeout.value = window.setTimeout(() => {
      remove();
    }, timeout);
  }
};

const remove = () => {
  emit('remove');
};
</script>
