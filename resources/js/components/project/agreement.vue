<template>
  <o-card title="個別契約関連">
    <div class="text-right mb-5">
      <o-savebtn @click="fileUpload">保存する</o-savebtn>
    </div>
    <div>
      <div class="tw-text-sm py-2">書類系</div>
      <div>
        <v-btn
          class="mr-5"
          variant="flat"
          rounded="1"
          color="primary"
          prepend-icon="mdi:mdi-arrow-up-bold-circle-outline"
          @click="onClickUpload"
        >
          アップロード
        </v-btn>
        <input style="display: none" ref="refFile" type="file" @change="fileSelected" />
      </div>
      <div class="tw-text-sm py-2">{{ uploadFileName }}</div>
    </div>
    <div>
      <div class="tw-text-sm py-2">単価</div>
      <o-text type="number" v-model="agreement.price"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">契約金額</div>
      <o-text type="number" v-model="agreement.money"></o-text>
    </div>
    <v-divider class="mt-5"></v-divider>
    <div>
      <div class="tw-text-sm py-2">アップロードされた書類</div>
      <div
        v-for="(fileName, i) in agreement.file_names"
        :key="i"
        class="tw-border-b-2 tw-text-blue-400 py-2 pl-2"
      >
        <div class="tw-cursor-pointer" @click="download(fileName)">{{ i }} : {{ fileName }}</div>
      </div>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';
import { default as service } from '@/services/project';
import { IAgreement } from '@/types/project';

const props = defineProps({
  id: String,
});
const refFile = ref();
const uploadFileName = ref('');
const uploadFile = ref('');
const agreement = ref<IAgreement>({
  id: 0,
  file_names: [],
  price: 0,
  money: 0,
});

onMounted(() => {
  search();
});

const search = async () => {
  const res = await service.showAgreement(Number(props.id));
  agreement.value = res;
};

/**
 * 選択されたファイルを格納
 * @param event
 */
const fileSelected = async (event: any) => {
  uploadFile.value = event.target.files[0];
  uploadFileName.value = event.target.files[0].name;
};

/**
 * 保存処理
 */
const fileUpload = async () => {
  const formData = new FormData();
  formData.append('file', uploadFile.value);
  formData.append('id', String(agreement.value.id));
  formData.append('price', String(agreement.value.price));
  formData.append('money', String(agreement.value.money.replace(/,/g, '')));

  agreement.value = await service.updateAgreement(Number(props.id), formData);
  uploadFile.value = '';
  uploadFileName.value = '';
};

/**
 * 疑似的にinput fileを開く
 */
const onClickUpload = () => {
  refFile.value.click();
};

/**
 * ファイルダウンロード
 */
const download = async (fileName: string) => {
  axios({
    url: `/projects/${props.id}/agreement/download/${fileName}`,
    method: 'GET',
    responseType: 'blob', // important
  }).then((response) => {
    const blob = new Blob([response.data], { type: response.headers['content-type'] });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = fileName;
    link.click();
    URL.revokeObjectURL(link.href);
  });
};
</script>

<style scoped></style>
