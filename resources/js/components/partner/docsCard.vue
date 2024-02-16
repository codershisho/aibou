<template>
  <o-card title="契約書系">
    <div class="text-right mb-5">
      <o-savebtn @click="fileUpload">保存する</o-savebtn>
    </div>
    <div>
      <input type="file" accept="application/pdf" @change="fileSelected" />
      <div v-for="(document, i) in documents" :key="i">
        <div class="py-2 tw-cursor-pointer" @click="read(document)">{{ document.fileName }}</div>
      </div>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { default as service } from '@/services/partner';
import { IDocument } from '@/types/partner';

const props = defineProps({
  id: String,
});
const fileInfo = ref('');
const documents = ref<IDocument[]>();
const document = ref<IDocument>({
  id: 0,
  partner_id: 0,
  basic_path: '',
  fileName: '',
});

onMounted(() => {
  search();
});

const search = async () => {
  const res = await service.searchDocuments(Number(props.id));
  documents.value = res;
};

const fileSelected = async (event: any) => {
  fileInfo.value = event.target.files[0];
};

const fileUpload = async () => {
  const formData = new FormData();
  formData.append('file', fileInfo.value);
  document.value = await service.uploadBasic(Number(props.id), formData);
  fileInfo.value = '';
};

const read = (document: IDocument) => {
  window.open(import.meta.env.VITE_APP_URL + document.basic_path, '_blank');
};
</script>

<style scoped></style>
