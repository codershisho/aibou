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
      <input
        style="display: none"
        ref="file1"
        type="file"
        accept="application/pdf"
        @change="fileSelected"
      />
      <v-divider class="my-2"></v-divider>
      <div class="tw-text-sm py-2">履歴</div>
      <div v-for="(document, i) in documents" :key="i" class="d-flex align-center tw-border-b-2">
        <div class="tw-w-1/12 tw-text-right pr-3">{{ i }}：</div>
        <div class="tw-w-11/12 py-2 tw-cursor-pointer" @click="read(document)">
          {{ document.fileName }}
        </div>
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
const file1 = ref();
const file1Name = ref('');
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
  file1Name.value = event.target.files[0].name;
};

const fileUpload = async () => {
  const formData = new FormData();
  formData.append('file', fileInfo.value);
  document.value = await service.uploadBasic(Number(props.id), formData);
  await search();
  fileInfo.value = '';
  file1Name.value = '';
};

const read = (document: IDocument) => {
  window.open(import.meta.env.VITE_APP_URL + document.basic_path, '_blank');
};
const selectFile = () => {
  file1.value.click();
};
</script>

<style scoped></style>
