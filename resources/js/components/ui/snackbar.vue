<template>
  <!--
      タイムアウトの管理は、大枠ではせずメッセージ毎に行う
      全てのメッセージが消えたら大枠を消す
      大枠を消す処理はStoreに実装する
    -->
  <v-snackbar v-model="isShow" color="white" :timeout="0" top auto-height>
    <!-- メッセージを縦並びにするためdivタグでラップする -->
    <div style="margin: -14px auto; width: 100%">
      <div style="margin: 0 -24px">
        <template v-for="(message, index) in store.messages" :key="message.id">
          <snackbarMessage @remove="store.removeMessage({ id: message.id })" :message="message" />
          <div style="margin: 1px 0" v-if="index != lastIndex" :key="`${message.id}-divider`" />
        </template>
      </div>
    </div>
  </v-snackbar>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import snackbarMessage from './snackbarMessage.vue';
import { useAppStore } from '@/stores/app';

const store = useAppStore();

const isShow = computed(() => store.messages.length !== 0);
const lastIndex = computed(() => store.messages.length - 1);
</script>
