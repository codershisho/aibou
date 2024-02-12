import { ref } from 'vue';
import { defineStore } from 'pinia';
import { v4 as uuidv4 } from 'uuid';
import { IMessage } from '@/types/app';

export const useAppStore = defineStore('app', () => {
  const sample = ref(0);
  const messages = ref<IMessage[]>([]);

  const addMessages = (payload: any) => {
    messages.value = [...messages.value, Object.assign(payload, { id: uuidv4() })];
  };

  const removeMessage = (payload: any) => {
    const { id } = payload;
    messages.value.forEach((v, index) => {
      if (v.id === id) {
        messages.value.splice(index, 1);
      }
    });
  };

  return {
    sample,
    messages,
    addMessages,
    removeMessage,
  };
});
