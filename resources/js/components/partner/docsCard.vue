<template>
  <o-card title="契約書系">
    <div class="text-right mb-5">
      <o-savebtn @click="fileUpload">保存する</o-savebtn>
    </div>
    <div>
      <v-btn
        variant="flat"
        rounded="1"
        color="primary"
        prepend-icon="mdi:mdi-arrow-up-bold-circle-outline"
        @click="selectFile"
      >
        ファイル選択
      </v-btn>
      <div class="tw-text-sm py-2">{{ file1Name }}</div>
      <input style="display: none" ref="file1" type="file" @change="fileSelected" />
      <v-divider class="my-2"></v-divider>
      <div class="tw-text-sm py-2">履歴</div>
      <div v-for="(doc, i) in documents" :key="i" class="tw-border-b-2 tw-text-blue-400 py-2 pl-2">
        <div class="tw-cursor-pointer" @click="read(doc)">{{ i }} : {{ doc.fileName }}</div>
      </div>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';
import { default as service } from '@/services/partner';
import { IDocument } from '@/types/partner';

const props = defineProps({
  id: String,
});
const file1 = ref();
const file1Name = ref('');
const fileInfo = ref('');
const documents = ref<IDocument[]>();
const doc = ref<IDocument>({
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
  file1Name.value = event.target.files[0].name;
};

const fileUpload = async () => {
  const formData = new FormData();
  formData.append('file', fileInfo.value);
  doc.value = await service.uploadBasic(Number(props.id), formData);
  await search();
  fileInfo.value = '';
  file1Name.value = '';
};

const read = async (doc: IDocument) => {
  axios({
    url: `/partners/${props.id}/documents/download/${doc.fileName}`,
    method: 'GET',
    responseType: 'blob', // important
  }).then((response) => {
    const blob = new Blob([response.data], { type: response.headers['content-type'] });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = doc.fileName;
    link.click();
    URL.revokeObjectURL(link.href);
  });

  // window.location = res;
};
const selectFile = () => {
  file1.value.click();
};
</script>

<style scoped></style>
