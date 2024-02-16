<template>
  <o-card title="個別契約関連">
    <div class="text-right mb-5">
      <o-savebtn @click="fileUpload">保存する</o-savebtn>
    </div>
    <div>
      <input type="file" accept="application/pdf" @change="fileSelected" />
    </div>
    <div>
      <div class="tw-text-sm py-2">単価</div>
      <o-text type="number" v-model="agreement.price"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">個別契約書</div>
      <div v-html="agreement.agreement_path ? `アップ済み` : `未`"></div>
      <v-btn
        color="primary"
        variant="flat"
        rounded="1"
        prepend-icon="mdi:mdi-arrow-up-bold-circle-outline"
        :disabled="!isUploaded"
        @click="read"
      >
        参照
      </v-btn>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { default as service } from '@/services/project';
import { IAgreement } from '@/types/project';

const props = defineProps({
  id: String,
});
const fileInfo = ref('');
const agreement = ref<IAgreement>({
  id: 0,
  agreement_path: null,
  price: 0,
});

const isUploaded = computed(() => {
  if (agreement.value.agreement_path != null && agreement.value.agreement_path != '') {
    return true;
  }
  return false;
});

onMounted(() => {
  search();
});

const search = async () => {
  const res = await service.showAgreement(Number(props.id));
  agreement.value = res;
};

const fileSelected = async (event: any) => {
  fileInfo.value = event.target.files[0];
};

const fileUpload = async () => {
  const formData = new FormData();
  formData.append('file', fileInfo.value);
  formData.append('id', String(agreement.value.id));
  formData.append('price', String(agreement.value.price));

  await service.updateAgreement(Number(props.id), formData);
  fileInfo.value = '';
};

const read = () => {
  window.open(import.meta.env.VITE_APP_URL + agreement.value.agreement_path, '_blank');
};
</script>

<style scoped></style>
