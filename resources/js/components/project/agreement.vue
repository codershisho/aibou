<template>
  <o-card title="個別契約関連">
    <div class="text-right mb-5">
      <o-savebtn @click="fileUpload">保存する</o-savebtn>
    </div>
    <div>
      <div class="tw-text-sm py-2">個別契約書</div>
      <div>
        <v-btn
          class="mr-5"
          variant="flat"
          rounded="1"
          color="primary"
          prepend-icon="mdi:mdi-arrow-up-bold-circle-outline"
          @click="selectAgreement"
        >
          ファイル選択
        </v-btn>
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
        <input
          style="display: none"
          ref="file1"
          type="file"
          accept="application/pdf"
          @change="fileSelected"
        />
      </div>
      <div class="tw-text-sm py-2">{{ file1Name }}</div>
    </div>
    <div>
      <div class="tw-text-sm py-2">見積書</div>
      <div>
        <input
          style="display: none"
          ref="file2"
          type="file"
          accept="application/pdf"
          @change="estimateSelected"
        />
        <v-btn
          class="mr-5"
          variant="flat"
          rounded="1"
          color="primary"
          prepend-icon="mdi:mdi-arrow-up-bold-circle-outline"
          @click="selectEstimate"
          >ファイル選択</v-btn
        >
        <v-btn
          color="primary"
          variant="flat"
          rounded="1"
          prepend-icon="mdi:mdi-arrow-up-bold-circle-outline"
          :disabled="!isUploadedEstimate"
          @click="readEstimate"
        >
          参照
        </v-btn>
      </div>
      <div class="tw-text-sm py-2">{{ file2Name }}</div>
    </div>
    <div>
      <div class="tw-text-sm py-2">単価</div>
      <o-text v-model="agreement.price"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">契約金額</div>
      <o-text v-model="agreement.money"></o-text>
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
const file1 = ref();
const file1Name = ref('');
const file2 = ref();
const file2Name = ref('');
const agreementFile = ref('');
const estimateFile = ref('');
const agreement = ref<IAgreement>({
  id: 0,
  agreement_path: null,
  estimate_path: null,
  price: 0,
  money: 0,
});

const isUploaded = computed(() => {
  if (agreement.value.agreement_path != null && agreement.value.agreement_path != '') {
    return true;
  }
  return false;
});
const isUploadedEstimate = computed(() => {
  if (agreement.value.estimate_path != null && agreement.value.estimate_path != '') {
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
  agreementFile.value = event.target.files[0];
  file1Name.value = event.target.files[0].name;
};
const estimateSelected = async (event: any) => {
  estimateFile.value = event.target.files[0];
  file2Name.value = event.target.files[0].name;
};

const fileUpload = async () => {
  const formData = new FormData();
  formData.append('file', agreementFile.value);
  formData.append('file2', estimateFile.value);
  formData.append('id', String(agreement.value.id));
  formData.append('price', String(agreement.value.price));
  formData.append('money', String(agreement.value.money.replace(/,/g, '')));

  agreement.value = await service.updateAgreement(Number(props.id), formData);
  agreementFile.value = '';
  estimateFile.value = '';
  file1Name.value = '';
  file2Name.value = '';
};

const read = () => {
  window.open(import.meta.env.VITE_APP_URL + agreement.value.agreement_path, '_blank');
};
const readEstimate = () => {
  window.open(import.meta.env.VITE_APP_URL + agreement.value.estimate_path, '_blank');
};

const selectAgreement = () => {
  file1.value.click();
};
const selectEstimate = () => {
  file2.value.click();
};
</script>

<style scoped></style>
