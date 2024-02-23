import partnerVue from '@/pages/partner.vue';
<template>
  <div>
    <div class="tw-text-sm py-2">委託先名称</div>
    <o-text v-model="partner.name"></o-text>
  </div>
  <div>
    <div class="tw-text-sm py-2">個人or法人</div>
    <o-auto
      :items="organizationType"
      item-title="name"
      item-value="id"
      v-model="partner.organization_type"
    ></o-auto>
  </div>
  <div>
    <div class="tw-text-sm py-2">委託先担当者</div>
    <o-text v-model="partner.contact_person"></o-text>
  </div>
  <div>
    <div class="tw-text-sm py-2">委託先連絡先</div>
    <o-text v-model="partner.contact"></o-text>
  </div>
  <v-divider class="my-5"></v-divider>
  <div class="tw-flex tw-gap-5 tw-justify-center">
    <o-cancelbtn class="tw-w-1/4" @click="cancel" />
    <o-savebtn class="tw-w-1/4" @click="save">保存する</o-savebtn>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { IProject } from '@/types/project';
import { IPartner } from '@/types/partner';
import { default as service } from '@/services/partner';
import { default as pService } from '@/services/project';

const emit = defineEmits(['close']);
const partner = ref({});
const organizationType = ref([
  { id: 1, name: '個人' },
  { id: 2, name: '法人' },
]);

onMounted(async () => {});

const cancel = () => {
  emit('close');
};
const save = async () => {
  service.store(partner.value);
  emit('close');
};
</script>

<style scoped></style>
