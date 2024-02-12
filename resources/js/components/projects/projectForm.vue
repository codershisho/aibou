<template>
  <div>
    <div class="tw-text-sm py-2">案件コード</div>
    <o-text v-model="project.code"></o-text>
  </div>
  <div>
    <div class="tw-text-sm py-2">案件名</div>
    <o-text v-model="project.name"></o-text>
  </div>
  <div>
    <div class="tw-text-sm py-2">対応委託先</div>
    <o-auto
      :items="partners"
      item-title="name"
      item-value="id"
      v-model="project.partner_id"
    ></o-auto>
  </div>
  <div>
    <div class="tw-text-sm py-2">対応期間</div>
    <o-text v-model="project.dates"></o-text>
  </div>
  <div>
    <div class="tw-text-sm py-2">ステータス</div>
    <o-auto :items="statuses" item-title="name" item-value="id" v-model="project.status"></o-auto>
  </div>
  <v-divider class="my-5"></v-divider>
  <div class="tw-flex tw-gap-5 tw-justify-center">
    <o-cancelbtn class="tw-w-1/4" @click="cancel" />
    <o-savebtn class="tw-w-1/4" @click="save" />
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { IProject } from '@/types/project';
import { IPartner } from '@/types/partner';
import { default as service } from '@/services/partner';
import { default as pService } from '@/services/project';

const emit = defineEmits(['close']);
const project = ref<IProject>({
  id: 0,
  code: '',
  name: '',
  partner_id: 0,
  status: 1,
  dates: '',
});

const statuses = ref([
  { id: 1, name: '新規' },
  { id: 2, name: '進行中' },
  { id: 3, name: '保留中' },
  { id: 4, name: '終了' },
]);
const partners = ref<IPartner[] | null>([]);

onMounted(async () => {
  partners.value = await service.index();
});

const cancel = () => {
  emit('close');
};
const save = async () => {
  await pService.store(project.value);
  emit('close');
};
</script>

<style scoped></style>
