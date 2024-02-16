<template>
  <o-card title="基本情報">
    <div class="text-right mb-5">
      <o-savebtn @click="onSave">保存する</o-savebtn>
    </div>
    <div class="tw-flex tw-items-center tw-gap-5">
      <div class="tw-w-1/2">
        <div class="tw-text-sm py-2">委託先名称</div>
        <o-text v-model="partner.name"></o-text>
      </div>
      <div class="tw-w-1/2 tw-flex tw-items-center">
        <div class="tw-w-1/2">
          <div class="tw-text-sm py-2">基本契約</div>
          <v-switch
            :label="partner.basic_contract_flag ? `あり` : `なし`"
            density="compact"
            inset
            color="primary"
            hide-details="auto"
            v-model="partner.basic_contract_flag"
          ></v-switch>
        </div>
        <div class="tw-w-1/2">
          <div class="tw-text-sm py-2">評価</div>
          <v-rating
            hover
            density="compact"
            :length="5"
            :size="32"
            v-model="partner.rating"
            active-color="primary"
          />
        </div>
      </div>
    </div>
    <div class="tw-flex tw-items-center tw-gap-5">
      <div class="tw-w-1/3">
        <div class="tw-text-sm py-2">委託先担当者</div>
        <o-text v-model="partner.contact_person"></o-text>
      </div>
      <div class="tw-w-2/3">
        <div class="tw-text-sm py-2">委託先連絡先</div>
        <o-text v-model="partner.contact"></o-text>
      </div>
    </div>
    <div>
      <div class="tw-text-sm py-2">得意分野</div>
      <o-area v-model="partner.specialty"></o-area>
    </div>
    <div>
      <div class="tw-text-sm py-2">メモ</div>
      <o-area v-model="partner.memo"></o-area>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { default as service } from '@/services/partner';
import { IPartner } from '@/types/partner';

const props = defineProps({
  id: String,
});

const partner = ref<IPartner>({
  id: 0,
  name: '',
  organization_type: 0,
  organization_type_name: '',
  basic_contract_flag: false,
  contact_person: '',
  contact: '',
  rating: 0,
  specialty: '',
  memo: '',
});

onMounted(async () => {
  partner.value = await service.show(Number(props.id));
});

const onSave = async () => {
  const res = await service.update(Number(props.id), partner.value);
  partner.value = res;
};
</script>

<style scoped></style>
